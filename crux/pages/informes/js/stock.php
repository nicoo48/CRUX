
<script>
    Highcharts.chart('stockChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Ingresos y Salidas por Producto'
        },
        xAxis: {
            categories: <?= json_encode($nombres) ?>,
            crosshair: true,
            labels: {
                rotation: -45,
                style: {
                    fontSize: '11px'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Cantidad'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:9px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0>{series.name}: </td>' +
                '<td style="padding:0 font-size:8px"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingresos',
            color: '#28a745', // Verde para ingresos
            data: <?= $jsonIngresos ?>
        }, {
            name: 'Salidas',
            color: '#dc3545', // Rojo para salidas
            data: <?= $jsonSalidas ?>
        }]
    });
</script>