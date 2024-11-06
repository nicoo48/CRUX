<?
// Verificar conexión
if (!isset($conexion)) {
    require ('../../config.php');
}

// Query para productos más vendidos
$query_ventas = "SELECT 
    pro.pro_id,
    pro.pro_nombre,
    pro.pro_codigo,
    COALESCE(SUM(mdet.mdet_cantidad), 0) as total_vendido
FROM 
    productos AS pro
LEFT JOIN 
    movimientos_detalle AS mdet ON pro.pro_id = mdet.mdet_pro_id
LEFT JOIN 
    movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
WHERE 
    mov.mov_tipo = 'SAL' 
    AND mdet.mdet_clase = 'VNT'
GROUP BY 
    pro.pro_id, 
    pro.pro_nombre
ORDER BY 
    total_vendido DESC";

$result_ventas = mysqli_query($conexion, $query_ventas);

// Procesar datos para el gráfico
$nombres = array();
$cantidades = array();


while ($row = mysqli_fetch_assoc($result_ventas)) {
    $nombres[] = $row['pro_nombre'];
    $codigos[] = $row['pro_codigo'];
    $cantidades[] = (float)$row['total_vendido'];
}

// Consulta para obtener el total de ventas del mes
$query_total_mes = "SELECT 
    SUM(mdet.mdet_cantidad * pro.pro_precio) as total_ventas
FROM movimientos_detalle AS mdet
JOIN movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
JOIN productos AS pro ON mdet.mdet_pro_id = pro.pro_id
WHERE mov.mov_tipo = 'SAL' 
    AND mdet.mdet_clase = 'VNT'
    AND MONTH(mov.mov_fecha) = MONTH(CURRENT_DATE())";

$result_total = mysqli_query($conexion, $query_total_mes);
$total_mes = mysqli_fetch_assoc($result_total);

// Consulta para estadísticas rápidas
$query_stats = "SELECT
    (SELECT COUNT(*) FROM productos) as total_productos,
    COALESCE(SUM(CASE 
        WHEN mov.mov_tipo = 'ING' THEN mdet.mdet_cantidad * pro.pro_precio
        ELSE 0 
    END), 0) as total_ingresos,
    COALESCE(SUM(CASE 
        WHEN mov.mov_tipo = 'SAL' THEN mdet.mdet_cantidad * pro.pro_precio
        ELSE 0 
    END), 0) as total_salidas
FROM movimientos_detalle mdet
JOIN movimientos mov ON mov.mov_id = mdet.mdet_mov_id
JOIN productos pro ON pro.pro_id = mdet.mdet_pro_id
WHERE MONTH(mov.mov_fecha) = MONTH(CURRENT_DATE())";

$result_stats = mysqli_query($conexion, $query_stats);
$stats = mysqli_fetch_assoc($result_stats);
?>