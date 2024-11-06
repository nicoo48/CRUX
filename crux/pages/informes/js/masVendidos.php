<script>
// Configuración del gráfico de productos más vendidos
Highcharts.chart('ventasChart', {
    chart: {
        type: 'bar',
        style: {
            fontFamily: 'Inter, sans-serif'
        },
        backgroundColor: 'transparent'
    },
    title: {
        text: null
    },
    xAxis: {
        categories: <?= json_encode($nombres) ?>,
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
            text: 'Cantidad Vendida',
            style: {
                color: '#8791a3'
            }
        },
        gridLineColor: '#eee',
        gridLineDashStyle: 'Dash'
    },
    legend: {
        enabled: false
    },
    tooltip: {
        backgroundColor: '#fff',
        borderWidth: 0,
        borderRadius: 15,
        shadow: true,
        style: {
            fontSize: '12px'
        },
        formatter: function() {
            return '<b>' + this.x + '</b><br/>' +
                   'Cantidad: ' + Highcharts.numberFormat(this.y, 0) + ' unidades';
        }
    },
    plotOptions: {
        bar: {
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
        }
    },
    series: [{
        name: 'Ventas',
        data: <?= json_encode($cantidades) ?>
    }],
    credits: {
        enabled: false
    }
});
</script>