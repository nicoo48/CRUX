<?php
// Verificar conexión
if (!isset($conexion)) {
    require ('config.php');
}

// Configurar el idioma para los meses en español
mysqli_query($conexion, "SET NAMES 'utf8'");
mysqli_query($conexion, "SET lc_time_names = 'es_ES'");

// Consulta para estadísticas rápidas
$query_stats = "SELECT
    (SELECT COUNT(*) FROM productos) as total_productos,
    COALESCE(SUM(CASE 
        WHEN mov.mov_tipo = 'ING' THEN mdet.mdet_cantidad * pro.pro_precio
        ELSE 0 
    END), 0) as total_ingresos,
    COALESCE(SUM(CASE 
        WHEN mov.mov_tipo = 'SAL' AND mdet.mdet_clase = 'VNT' 
        THEN mdet.mdet_cantidad * pro.pro_precio
        ELSE 0 
    END), 0) as total_salidas
FROM movimientos_detalle mdet
JOIN movimientos mov ON mov.mov_id = mdet.mdet_mov_id
JOIN productos pro ON pro.pro_id = mdet.mdet_pro_id
WHERE 
    MONTH(mov.mov_fecha) = MONTH(CURRENT_DATE())
    AND YEAR(mov.mov_fecha) = YEAR(CURRENT_DATE())";

$result_stats = mysqli_query($conexion, $query_stats);
$stats = mysqli_fetch_assoc($result_stats);

// Meta Mensual
$meta = select("tiendas", "tnd_meta_mensual");
$m = $meta["datos"][0]["tnd_meta_mensual"];

// Consulta para ventas mensuales con meses en español
$query_ventas_mensuales = "WITH meses_calendario AS (
    SELECT 
        DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL n MONTH), '%Y-%m') as mes,
        CONCAT(
            UPPER(LEFT(DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL n MONTH), '%M'), 1)),
            LOWER(SUBSTRING(DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL n MONTH), '%M'), 2)),
            ' ',
            DATE_FORMAT(DATE_SUB(CURRENT_DATE(), INTERVAL n MONTH), '%Y')
        ) as mes_nombre
    FROM (
        SELECT 0 as n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 
        UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11
    ) nums
)
SELECT 
    mc.mes,
    mc.mes_nombre,
    COUNT(DISTINCT mov.mov_id) as total_transacciones,
    COALESCE(SUM(mdet.mdet_cantidad), 0) as total_unidades,
    COALESCE(SUM(mdet.mdet_cantidad * pro.pro_precio), 0) as total_ventas,
    COALESCE(AVG(mdet.mdet_cantidad * pro.pro_precio), 0) as promedio_venta
FROM 
    meses_calendario mc
LEFT JOIN movimientos AS mov 
    ON DATE_FORMAT(mov.mov_fecha, '%Y-%m') = mc.mes
    AND mov.mov_tipo = 'SAL'
LEFT JOIN movimientos_detalle AS mdet 
    ON mov.mov_id = mdet.mdet_mov_id 
    AND mdet.mdet_clase = 'VNT'
LEFT JOIN productos AS pro 
    ON mdet.mdet_pro_id = pro.pro_id
GROUP BY 
    mc.mes, mc.mes_nombre
ORDER BY 
    mc.mes ASC";

$result_mensual = mysqli_query($conexion, $query_ventas_mensuales);

// Preparar datos para el gráfico
$meses = array();
$ventas = array();
$total_ventas = 0;
$max_ventas = 0;
$min_ventas = PHP_FLOAT_MAX;
$total_unidades = 0;

if ($result_mensual) {
    while ($row = mysqli_fetch_assoc($result_mensual)) {
        $meses[] = $row['mes_nombre'];
        $ventas[] = (float)$row['total_ventas'];
        $total_ventas += $row['total_ventas'];
        $max_ventas = max($max_ventas, $row['total_ventas']);
        $min_ventas = min($min_ventas, $row['total_ventas']);
        $total_unidades += $row['total_unidades'];
    }
}

// Calcular porcentaje para el dashboard
$porcentaje = ($stats['total_salidas'] / $m) * 100;
$colorClase = $porcentaje >= 100 ? 'success' : ($porcentaje <= 40 ? 'danger' : 'warning');
$statusText = $porcentaje >= 100 ? 'Meta Alcanzada' : ($porcentaje <= 40 ? 'Meta Baja' : 'En Progreso');
$statusIcon = $porcentaje >= 100 ? 'check-circle' : ($porcentaje <= 40 ? 'exclamation-circle' : 'arrow-up-circle');

// Calcular promedios y tendencias
$promedio_ventas = count($ventas) > 0 ? $total_ventas / count($ventas) : 0;
$tendencia = count($ventas) >= 2 ? (end($ventas) > $ventas[count($ventas)-2] ? 'up' : 'down') : 'neutral';

// Consulta de stock
$query_stock = "SELECT 
    pro.pro_nombre AS nombre,
    pro.pro_codigo,
    COALESCE(SUM(CASE WHEN mov.mov_tipo = 'ING' THEN mdet.mdet_cantidad ELSE 0 END), 0) AS total_ingresos,
    COALESCE(SUM(CASE 
        WHEN mov.mov_tipo = 'SAL' AND mdet.mdet_clase = 'VNT' 
        THEN mdet.mdet_cantidad 
        ELSE 0 
    END), 0) AS total_salidas,
    COALESCE(SUM(CASE 
        WHEN mov.mov_tipo = 'SAL' AND mdet.mdet_clase = 'VNT' 
        THEN mdet.mdet_cantidad * pro.pro_precio
        ELSE 0 
    END), 0) AS total_ventas
FROM 
    productos AS pro
LEFT JOIN 
    movimientos_detalle AS mdet ON pro.pro_id = mdet.mdet_pro_id
LEFT JOIN 
    movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
    AND mov.mov_fecha >= DATE_SUB(CURRENT_DATE(), INTERVAL 12 MONTH)
GROUP BY 
    pro.pro_codigo, pro.pro_nombre
ORDER BY 
    total_ventas DESC";

$result_stock = mysqli_query($conexion, $query_stock);

// Datos para el gráfico
$data_chart = [
    'labels' => $meses,
    'datasets' => [[
        'name' => 'Ventas',
        'data' => $ventas
    ]]
];

// Convertir a JSON para el gráfico
$chart_data = json_encode($data_chart);
?>