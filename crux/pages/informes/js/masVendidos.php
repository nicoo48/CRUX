<script>
Highcharts.setOptions({
    lang: {
        months: [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        shortMonths: [
            'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
        ],
        numericSymbols: ['k', 'M', 'G', 'T', 'P', 'E']
    }
});

Highcharts.chart('ventasChart', {
    chart: {
        type: 'bar',
        style: {
            fontFamily: 'Inter, sans-serif'
        },
        backgroundColor: 'transparent',
        height: '400px'
    },
    title: {
        text: null
    },
    xAxis: {
        categories: <?= json_encode($nombres) ?>,
        labels: {
            style: {
                color: '#4b5563',
                fontSize: '13px',
                fontWeight: '500'
            }
        },
        lineWidth: 0,
        gridLineWidth: 1,
        gridLineColor: 'rgba(0,0,0,0.05)'
    },
    yAxis: [{
        min: 0,
        title: {
            text: 'Unidades Vendidas',
            style: {
                color: '#6b7280'
            }
        },
        labels: {
            style: {
                color: '#6b7280'
            },
            formatter: function() {
                return Highcharts.numberFormat(this.value, 0, ',', '.');
            }
        },
        gridLineColor: 'rgba(0,0,0,0.05)'
    }, {
        min: 0,
        title: {
            text: 'Ingresos',
            style: {
                color: '#6b7280'
            }
        },
        labels: {
            style: {
                color: '#6b7280'
            },
            formatter: function() {
                return '$' + Highcharts.numberFormat(this.value, 0, ',', '.');
            }
        },
        opposite: true
    }],
    legend: {
        align: 'right',
        verticalAlign: 'top',
        backgroundColor: 'transparent',
        borderWidth: 0,
        symbolRadius: 2,
        symbolHeight: 10,
        symbolWidth: 10,
        itemStyle: {
            color: '#4b5563',
            fontWeight: '500',
            fontSize: '12px'
        },
        itemHoverStyle: {
            color: '#000'
        }
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            borderWidth: 0,
            grouping: false,
            shadow: false,
            dataLabels: {
                enabled: true,
                formatter: function() {
                    if (this.series.name === 'Ventas') {
                        return Highcharts.numberFormat(this.y, 0, ',', '.') + ' un';
                    }
                    return '$' + Highcharts.numberFormat(this.y, 0, ',', '.');
                },
                style: {
                    fontSize: '11px',
                    fontWeight: '500'
                }
            }
        },
        series: {
            pointWidth: 18
        }
    },
    tooltip: {
        shared: true,
        backgroundColor: '#fff',
        borderWidth: 0,
        borderRadius: 8,
        shadow: true,
        padding: 12,
        useHTML: true,
        headerFormat: '<div style="font-size: 12px; font-weight: 600; padding-bottom: 8px;">{point.key}</div>',
        pointFormatter: function() {
            return `<div style="color: ${this.color}; font-size: 12px; padding: 2px 0;">
                <span style="font-weight: 500;">${this.series.name}:</span> 
                <span style="font-weight: 600;">${
                    this.series.name === 'Ventas' 
                        ? Highcharts.numberFormat(this.y, 0, ',', '.') + ' unidades'
                        : '$' + Highcharts.numberFormat(this.y, 0, ',', '.')
                }</span>
            </div>`;
        },
        style: {
            fontSize: '12px'
        }
    },
    series: [{
        name: 'Ventas',
        data: <?= json_encode($cantidades) ?>,
        color: {
            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
            stops: [
                [0, '#3b82f6'],
                [1, '#60a5fa']
            ]
        },
        pointPadding: 0.3
    }, {
        name: 'Ingresos',
        data: <?= json_encode($ingresos) ?>,
        color: {
            linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
            stops: [
                [0, '#10b981'],
                [1, '#34d399']
            ]
        },
        pointPadding: 0.4,
        yAxis: 1
    }],
    credits: {
        enabled: false
    },
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom'
                },
                yAxis: [{
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    }
                }, {
                    labels: {
                        align: 'right',
                        x: 0,
                        y: -5
                    }
                }]
            }
        }]
    }
});
</script>