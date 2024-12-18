<?php
function obtenerHistoricoVentas($conexion)
{
    $query = "
        SELECT 
            pro.pro_nombre AS nombre_producto,
            SUM(mdet.mdet_cantidad) AS total_ventas,
            COUNT(DISTINCT MONTH(mov.mov_fecha)) AS meses_activos,
            GROUP_CONCAT(DATE_FORMAT(mov.mov_fecha, '%Y-%m')) AS meses,
            GROUP_CONCAT(mdet.mdet_cantidad ORDER BY mov.mov_fecha ASC) AS ventas_mensuales
        FROM 
            productos AS pro
        JOIN 
            movimientos_detalle AS mdet ON pro.pro_id = mdet.mdet_pro_id
        JOIN 
            movimientos AS mov ON mov.mov_id = mdet.mdet_mov_id
        WHERE 
            mov.mov_tipo = 'SAL' 
            AND mdet.mdet_clase = 'VNT'
        GROUP BY 
            pro.pro_nombre
    ";

    $result = mysqli_query($conexion, $query);
    $historico = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ventasMensuales = array_map('intval', explode(',', $row['ventas_mensuales']));
            $meses = explode(',', $row['meses']);

            $historico[] = [
                'nombre_producto' => $row['nombre_producto'],
                'total_ventas' => (int) $row['total_ventas'],
                'meses_activos' => (int) $row['meses_activos'],
                'ventas_mensuales' => $ventasMensuales,
                'meses' => $meses
            ];
        }
    }

    return $historico;
}

function predecirVentasBasadoEnHistorico($historicoVentas)
{
    $predicciones = [];

    foreach ($historicoVentas as $producto) {
        $nombre = $producto['nombre_producto'];
        $ventasMensuales = $producto['ventas_mensuales'];
        $meses = $producto['meses'];
        $totalVentas = $producto['total_ventas'];
        $mesesActivos = $producto['meses_activos'];

        // Calcular promedio mensual
        $promedioMensual = ($mesesActivos > 0) ? ($totalVentas / $mesesActivos) : 0;

        // Calcular tasa de crecimiento mensual dinámica
        $tasaCrecimiento = calcularTasaCrecimiento($ventasMensuales);

        // Calcular estacionalidad (ajuste basado en los últimos meses)
        $factorEstacional = calcularFactorEstacionalidad($meses);

        // Predicción final ajustada
        $prediccion = $promedioMensual * (1 + $tasaCrecimiento) * $factorEstacional;

        // Ventas totales predichas
        $ventasTotalesPredichas = $prediccion * ($mesesActivos + 1);  

        $predicciones[] = [
            'nombre' => $nombre,
            'ventas_totales' => $totalVentas,
            'ventas_totales_predichas' => $ventasTotalesPredichas,
            'promedio_mensual' => $promedioMensual,
            'tasa_crecimiento' => $tasaCrecimiento,
            'factor_estacionalidad' => $factorEstacional,
            'prediccion_siguiente_mes' => $prediccion
        ];
    }

    return $predicciones;
}

function calcularTasaCrecimiento($ventasMensuales)
{
    $n = count($ventasMensuales);
    if ($n <= 1) return 0; // No hay suficientes datos para calcular

    $cambios = [];
    for ($i = 1; $i < $n; $i++) {
        if ($ventasMensuales[$i - 1] > 0) {
            $cambios[] = ($ventasMensuales[$i] - $ventasMensuales[$i - 1]) / $ventasMensuales[$i - 1];
        }
    }
    return (count($cambios) > 0) ? array_sum($cambios) / count($cambios) : 0;
}

function calcularFactorEstacionalidad($meses)
{
    // Contar ocurrencias de cada mes
    $mesesDistribucion = array_count_values(array_map(function ($fecha) {
        return (int) date('m', strtotime($fecha));
    }, $meses));

    // Determinar el mes actual
    $mesActual = (int) date('m');

    // Ajustar el factor con base en el mes actual
    $factor = isset($mesesDistribucion[$mesActual]) ? 
        (1 + ($mesesDistribucion[$mesActual] / array_sum($mesesDistribucion))) : 1.0;

    return $factor;
}

// Ejecutar flujo
$historicoVentas = obtenerHistoricoVentas($conexion);

$ventasHistoricas = [];
$ventasPredichas = [];
$fechas = [];
$tasaCrecimiento = [];
$totalVentasReales = 0;
$totalVentasPredichas = 0;

if (!empty($historicoVentas)) {
    $predicciones = predecirVentasBasadoEnHistorico($historicoVentas);
    
    foreach ($predicciones as $producto) {
        // Para las ventas históricas
        $ventasHistoricas[] = $producto['ventas_totales'];

        // Para las ventas predichas
        $ventasPredichas[] = $producto['prediccion_siguiente_mes'];

        // Para los meses (fechas)
        $fechas = array_merge($fechas, $producto['meses']);

        // Para la tasa de crecimiento
        $tasaCrecimiento[] = $producto['tasa_crecimiento'] * 100; // en porcentaje

        // Sumar ventas reales y predichas
        $totalVentasReales += $producto['ventas_totales'];
        $totalVentasPredichas += $producto['ventas_totales_predichas'];
    }

    // Eliminar meses duplicados
    $fechas = array_unique($fechas);
} else {
    $ventasHistoricas = [];
    $ventasPredichas = [];
    $fechas = [];
    $tasaCrecimiento = [];
    $totalVentasReales = 0;
    $totalVentasPredichas = 0;
}

?>
