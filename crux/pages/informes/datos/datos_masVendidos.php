<?php
// Verificar conexión
if (!isset($conexion)) {
    require ('../../config.php');
}

// Query para productos más vendidos con más detalles
$query_ventas = "SELECT 
    pro.pro_id,
    pro.pro_nombre,
    pro.pro_codigo,
    pro.pro_precio,
    COALESCE(SUM(mdet.mdet_cantidad), 0) as total_vendido,
    COALESCE(SUM(mdet.mdet_cantidad * pro.pro_precio), 0) as total_ingresos,
    COUNT(DISTINCT mov.mov_id) as total_transacciones,
    COALESCE(AVG(mdet.mdet_cantidad), 0) as promedio_unidades
FROM 
    productos AS pro
LEFT JOIN 
    movimientos_detalle AS mdet ON pro.pro_id = mdet.mdet_pro_id
LEFT JOIN 
    movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
WHERE 
    mov.mov_tipo = 'SAL' 
    AND mdet.mdet_clase = 'VNT'
    AND MONTH(mov.mov_fecha) = MONTH(CURRENT_DATE())
GROUP BY 
    pro.pro_id, 
    pro.pro_nombre,
    pro.pro_codigo,
    pro.pro_precio
ORDER BY 
    total_vendido DESC
LIMIT 10";

$result_ventas = mysqli_query($conexion, $query_ventas);

// Procesar datos para el gráfico
$data_productos = [];
$nombres = [];
$cantidades = [];
$ingresos = [];

while ($row = mysqli_fetch_assoc($result_ventas)) {
    $data_productos[] = $row;
    $nombres[] = $row['pro_nombre'];
    $cantidades[] = (float)$row['total_vendido'];
    $ingresos[] = (float)$row['total_ingresos'];
}

// Consulta para obtener comparativa con mes anterior
$query_comparativa = "SELECT 
    MONTH(mov.mov_fecha) as mes,
    COALESCE(SUM(mdet.mdet_cantidad * pro.pro_precio), 0) as total_ventas
FROM movimientos_detalle AS mdet
JOIN movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
JOIN productos AS pro ON mdet.mdet_pro_id = pro.pro_id
WHERE mov.mov_tipo = 'SAL' 
    AND mdet.mdet_clase = 'VNT'
    AND mov.mov_fecha >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)
GROUP BY MONTH(mov.mov_fecha)";

$result_comparativa = mysqli_query($conexion, $query_comparativa);
$comparativa = [];
while ($row = mysqli_fetch_assoc($result_comparativa)) {
    $comparativa[$row['mes']] = $row['total_ventas'];
}

// Calcular variación porcentual
$mes_actual = date('n');
$mes_anterior = $mes_actual - 1 <= 0 ? 12 : $mes_actual - 1;

$ventas_mes_actual = isset($comparativa[$mes_actual]) ? $comparativa[$mes_actual] : 0;
$ventas_mes_anterior = isset($comparativa[$mes_anterior]) ? $comparativa[$mes_anterior] : 0;

$variacion_porcentual = $ventas_mes_anterior > 0 
    ? (($ventas_mes_actual - $ventas_mes_anterior) / $ventas_mes_anterior) * 100 
    : 0;

// Estadísticas generales actualizadas
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
    END), 0) as total_salidas,
    COUNT(DISTINCT CASE WHEN mov.mov_tipo = 'SAL' AND mdet.mdet_clase = 'VNT' THEN mov.mov_id END) as total_transacciones
FROM movimientos_detalle mdet
JOIN movimientos mov ON mov.mov_id = mdet.mdet_mov_id
JOIN productos pro ON pro.pro_id = mdet.mdet_pro_id
WHERE MONTH(mov.mov_fecha) = MONTH(CURRENT_DATE())";

$result_stats = mysqli_query($conexion, $query_stats);
$stats = mysqli_fetch_assoc($result_stats);