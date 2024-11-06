<?php
// Consulta para ventas mensuales
$query_ventas_mensuales = "SELECT 
    DATE_FORMAT(mov.mov_fecha, '%Y-%m') as mes,
    DATE_FORMAT(mov.mov_fecha, '%M %Y') as mes_nombre,
    COUNT(DISTINCT mov.mov_id) as total_transacciones,
    SUM(mdet.mdet_cantidad) as total_unidades,
    SUM(mdet.mdet_cantidad * pro.pro_precio) as total_ventas,
    AVG(mdet.mdet_cantidad * pro.pro_precio) as promedio_venta
FROM 
    movimientos AS mov
JOIN 
    movimientos_detalle AS mdet ON mov.mov_id = mdet.mdet_mov_id
JOIN
	productos AS pro ON mdet.mdet_pro_id = pro.pro_id
    
WHERE 
    mov.mov_tipo = 'SAL' 
    AND mdet.mdet_clase = 'VNT'
    AND mov.mov_fecha >= DATE_SUB(CURRENT_DATE, INTERVAL 12 MONTH)
GROUP BY 
    mes
ORDER BY 
    mes ASC";

$result_mensual = mysqli_query($conexion, $query_ventas_mensuales);

// Preparar datos para el gráfico
$meses = array();
$ventas = array();
$total_ventas = 0;
$max_ventas = 0;
$min_ventas = PHP_FLOAT_MAX;
$total_unidades = 0;

while ($row = mysqli_fetch_assoc($result_mensual)) {
    $meses[] = $row['mes_nombre'];
    $ventas[] = (float)$row['total_ventas'];
    $total_ventas += $row['total_ventas'];
    $max_ventas = max($max_ventas, $row['total_ventas']);
    $min_ventas = min($min_ventas, $row['total_ventas']);
    $total_unidades += $row['total_unidades'];
}

// Calcular promedios y tendencias
$promedio_ventas = $total_ventas / count($ventas);
$tendencia = end($ventas) > $ventas[count($ventas)-2] ? 'up' : 'down';

?>