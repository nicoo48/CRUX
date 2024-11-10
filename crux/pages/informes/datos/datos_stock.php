<?php
// Verificar conexión
if (!isset($conexion)) {
    require ('../../config.php');
}

// Preparar la condición WHERE para filtrar por producto
$where_producto = "";
if (isset($_REQUEST["producto"]) && !empty($_REQUEST["producto"])) {
    $producto_id = mysqli_real_escape_string($conexion, $_REQUEST["producto"]);
    $where_producto = "WHERE pro.pro_id = '$producto_id'";
}

// Consulta para obtener estadísticas generales
$query_stats = "SELECT 
    COUNT(DISTINCT pro.pro_id) as total_productos,
    COALESCE(SUM(CASE WHEN mov.mov_tipo = 'ING' THEN mdet.mdet_cantidad ELSE 0 END), 0) AS total_ingresos,
    COALESCE(SUM(CASE WHEN mov.mov_tipo = 'SAL' THEN mdet.mdet_cantidad ELSE 0 END), 0) AS total_salidas,
    COUNT(DISTINCT CASE WHEN mov.mov_tipo = 'ING' THEN mov.mov_id END) as total_movimientos_ingreso,
    COUNT(DISTINCT CASE WHEN mov.mov_tipo = 'SAL' THEN mov.mov_id END) as total_movimientos_salida
FROM 
    productos AS pro
LEFT JOIN 
    movimientos_detalle AS mdet ON pro.pro_id = mdet.mdet_pro_id
LEFT JOIN 
    movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
$where_producto";

$result_stats = mysqli_query($conexion, $query_stats);
$stats = mysqli_fetch_assoc($result_stats);

// Consulta de stock con filtro de producto
$query_stock = "SELECT 
    pro.pro_nombre AS nombre,
    COALESCE(SUM(CASE WHEN mov.mov_tipo = 'ING' THEN mdet.mdet_cantidad ELSE 0 END), 0) AS total_ingresos,
    COALESCE(SUM(CASE WHEN mov.mov_tipo = 'SAL' THEN mdet.mdet_cantidad ELSE 0 END), 0) AS total_salidas
FROM 
    productos AS pro
LEFT JOIN 
    movimientos_detalle AS mdet ON pro.pro_id = mdet.mdet_pro_id
LEFT JOIN 
    movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id 
$where_producto
GROUP BY 
    pro.pro_codigo, pro.pro_nombre";

$result_stock = mysqli_query($conexion, $query_stock);

// Procesar datos para el gráfico
$nombres = array();
$ingresos = array();
$salidas = array();

while ($row = mysqli_fetch_assoc($result_stock)) {
    $nombres[] = $row['nombre'];
    $ingresos[] = (float)$row['total_ingresos'];
    $salidas[] = (float)$row['total_salidas'];
}

// Preparar datos para el gráfico
$data_ingresos = array();
$data_salidas = array();

for ($i = 0; $i < count($nombres); $i++) {
    $data_ingresos[] = array(
        'name' => $nombres[$i],
        'y' => $ingresos[$i]
    );
    $data_salidas[] = array(
        'name' => $nombres[$i],
        'y' => $salidas[$i]
    );
}

$jsonIngresos = json_encode($data_ingresos);
$jsonSalidas = json_encode($data_salidas);
?>