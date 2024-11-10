<script>
Highcharts.chart('stockChart', {
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
        categories: <?= json_encode($nombres) ?>,
        crosshair: true,
        labels: {
            rotation: -45,
            style: {
                color: '#8791a3',
                fontSize: '12px'
            }
        },
        lineColor: '#eee',
        tickLength: 0
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cantidad',
            style: {
                color: '#8791a3'
            }
        },
        gridLineColor: '#eee',
        gridLineDashStyle: 'Dash',
        labels: {
            style: {
                color: '#8791a3',
                fontSize: '12px'
            }
        }
    },
    legend: {
        itemStyle: {
            color: '#8791a3',
            fontSize: '12px'
        },
        itemHoverStyle: {
            color: '#666'
        }
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
        formatter: function() {
            return '<b>' + this.x + '</b><br/>' +
                   this.series.name + ': ' + Highcharts.numberFormat(this.y, 0) + ' unidades';
        },
        shared: true
    },
    plotOptions: {
        column: {
            borderRadius: 5,
            borderWidth: 0,
            groupPadding: 0.2,
            pointPadding: 0.1
        },
        series: {
            states: {
                hover: {
                    brightness: 0.1
                }
            }
        }
    },
    series: [{
        name: 'Ingresos',
        color: {
            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
            stops: [
                [0, '#34d399'], // Verde más claro
                [1, '#10b981']  // Verde más oscuro
            ]
        },
        data: <?= $jsonIngresos ?>
    }, {
        name: 'Salidas',
        color: {
            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
            stops: [
                [0, '#f87171'], // Rojo más claro
                [1, '#ef4444']  // Rojo más oscuro
            ]
        },
        data: <?= $jsonSalidas ?>
    }],
    credits: {
        enabled: false
    }
});

function buscarProducto(){
    var campos = $(".campos").serialize();
    AJAXPOST(urlBase + "pages/informes/informe_stock.php", campos, document.getElementById("pagina_central"));
}
</script>