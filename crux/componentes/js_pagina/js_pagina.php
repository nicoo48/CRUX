<?php
// Array de meses en español
$meses_esp = [
    '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo',
    '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
    '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre',
    '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
];

// Inicializar arrays para los últimos 12 meses con valores 0
$datos_ventas = [];
$fecha_actual = new DateTime();
for ($i = 11; $i >= 0; $i--) {
    $fecha = clone $fecha_actual;
    $fecha->modify("-$i months");
    $mes_key = $fecha->format('Y-m');
    $datos_ventas[$mes_key] = 0;
}

// Configurar fechas para la consulta
$fecha_inicio = date('Y-m-d', strtotime('-11 months'));
$fecha_inicio = date('Y-m-01', strtotime($fecha_inicio)) . " 00:00:00";
$fecha_fin = date('Y-m-t') . " 23:59:59";

// Consultar movimientos usando la función select
unset($filtros);
$filtros["where"] = "mov_fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$movimientos_12_meses = select("movimientos", "*", $filtros);

// Procesar los movimientos
foreach ($movimientos_12_meses["datos"] as $mov) {
    $movimientos_detalle = select("movimientos_detalle", "*", ["mdet_mov_id" => $mov["mov_id"]]);
    $mes = date('Y-m', strtotime($mov["mov_fecha"]));
    
    foreach ($movimientos_detalle["datos"] as $mdet) {
        if ($mdet["mdet_clase"] == "VNT") {
            if (!isset($datos_ventas[$mes])) {
                $datos_ventas[$mes] = 0;
            }
            $datos_ventas[$mes] += floatval($mdet["mdet_total"]);
        }
    }
}

// Preparar datos para el gráfico
$categorias = [];
$valores = [];

// Ordenar por fecha
ksort($datos_ventas);

foreach ($datos_ventas as $fecha => $valor) {
    $mes = $meses_esp[date('m', strtotime($fecha))];
    $anio = date('Y', strtotime($fecha));
    $categorias[] = $mes . "\n" . $anio;
    $valores[] = round($valor, 2);
}

// Convertir a JSON para JavaScript
$categorias_json = json_encode($categorias);
$valores_json = json_encode($valores);

// Debug para verificar datos
echo "<!-- Debug Info:\n";
echo "Categorías: " . print_r($categorias, true) . "\n";
echo "Valores: " . print_r($valores, true) . "\n";
echo "-->";
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('ventasMensualesChart2');
    if (!container) {
        console.error('Container ventasMensualesChart2 not found');
        return;
    }

    // Debug - verificar datos
    console.log('Categorías:', <?= $categorias_json ?>);
    console.log('Valores:', <?= $valores_json ?>);

    Highcharts.chart('ventasMensualesChart2', {
        chart: {
            type: 'column',
            backgroundColor: 'transparent',
            style: {
                fontFamily: 'Inter, sans-serif'
            }
        },
        title: {
            text: null
        },
        xAxis: {
            categories: <?= $categorias_json ?>,
            labels: {
                style: {
                    color: '#8791a3',
                    fontSize: '12px'
                },
                rotation: -45,
                useHTML: true
            },
            lineColor: '#eee',
            tickLength: 0
        },
        yAxis: {
            title: {
                text: null
            },
            gridLineColor: '#eee',
            gridLineDashStyle: 'Dash',
            labels: {
                style: {
                    color: '#8791a3',
                    fontSize: '12px'
                },
                formatter: function () {
                    return '$' + Highcharts.numberFormat(this.value, 0);
                }
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            backgroundColor: '#fff',
            borderWidth: 0,
            borderRadius: 15,
            shadow: true,
            padding: 12,
            style: {
                fontSize: '12px'
            },
            formatter: function () {
                return '<b>' + this.x.replace("\n", " ") + '</b><br/>Ventas: $' +
                    Highcharts.numberFormat(this.y, 0);
            }
        },
        plotOptions: {
            column: {
                borderRadius: 5,
                borderWidth: 0,
                color: {
                    linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                    stops: [
                        [0, '#3b82f6'],
                        [1, '#60a5fa']
                    ]
                },
                states: {
                    hover: {
                        brightness: 0.1
                    }
                }
            },
            series: {
                pointPadding: 0.2,
                groupPadding: 0.2
            }
        },
        series: [{
            name: 'Ventas',
            data: <?= $valores_json ?>
        }],
        credits: {
            enabled: false
        }
    });
});
</script>