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
            text: 'Entradas y Salidas del Producto'
        },
        xAxis: {
            categories: ['<?=$nombre?>'], // Usar un array para las categorías
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
            shared: true, // Hacer el tooltip compartido entre las series
            formatter: function() {
                var tooltip = "";
                this.points.forEach(function(point) {
                    tooltip += point.series.name + ': ' + Highcharts.numberFormat(point.y, 0) + ' unidades<br/>';
                });
                return tooltip;
            }
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
            name: 'Entradas',
            color: {
                linearGradient: {
                    x1: 0,
                    x2: 0,
                    y1: 0,
                    y2: 1
                },
                stops: [
                    [0, '#34d399'], // Verde más claro
                    [1, '#10b981'] // Verde más oscuro
                ]
            },
            data: [<?=$stats["total_entradas"]?>] // Aquí deberías pasar los datos de las entradas
        }, {
            name: 'Salidas',
            color: {
                linearGradient: {
                    x1: 0,
                    x2: 0,
                    y1: 0,
                    y2: 1
                },
                stops: [
                    [0, '#f87171'], // Rojo más claro
                    [1, '#ef4444'] // Rojo más oscuro
                ]
            },
            data: [<?=$stats["total_salidas"]?>] // Aquí deberías pasar los datos de las salidas
        }],
        credits: {
            enabled: false
        }
    });


</script>
