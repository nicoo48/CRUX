<script>
    Highcharts.chart('ventasChart', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Productos más Vendidos'
        },
        xAxis: {
            categories: <?= json_encode($nombres) ?>,
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Unidades Vendidas'
            }
        },
        plotOptions: {
            series: {
                borderRadius: 8,  // Añade bordes redondeados a las barras
                pointWidth: 40,   // Hace las barras más delgadas (ajusta este valor según necesites)
                borderWidth: 0    // Elimina el borde de las barras
            }
        },
        series: [{
            name: 'Unidades',
            data: <?= json_encode($cantidades) ?>
        }]
    });

    // Función para exportar a Excel
    document.getElementById('exportExcel').addEventListener('click', function() {
        // Implementar la exportación a Excel
        alert('Función de exportación a Excel pendiente de implementar');
    });

    // Función para imprimir
    document.getElementById('printList').addEventListener('click', function() {
        window.print();
    });
</script>