<?
$aux = '[';
$aux2 = '[';
foreach ($meses as $mes => $valor) {
    $aux .= "'$mes',";
    $aux2 .= $valor . ',';
}
$aux = substr($aux, 0, -1);
$aux .= ']';

$aux2 = substr($aux2, 0, -1);
$aux2 .= ']';
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si el contenedor existe
        const container = document.getElementById('ventasMensualesChart2');
        if (!container) {
            console.error('El contenedor del gráfico no existe');
            return;
        }

        // Configura el gráfico
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
                categories:<?=$aux?> ,
                labels: {
                    style: {
                        color: '#8791a3',
                        fontSize: '12px'
                    }
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
                    return '<b>' + this.key + '</b><br/>Ventas: $' +
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
                data: <?=$aux2?>
            }],
            credits: {
                enabled: false
            }
        });
    });
</script>