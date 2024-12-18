<script>
Highcharts.chart('graficoProyeccionVentas', {
    chart: { type: 'line' },
    title: { text: 'Proyección de Ventas por Producto' },
    subtitle: { text: 'Comparación de ventas históricas vs predicciones' },
    xAxis: {
        categories: <?= json_encode($fechas) ?>, 
        title: { text: 'Meses' }
    },
    yAxis: { title: { text: 'Cantidad de Ventas' } },
    tooltip: { shared: true },
    series: [
        {
            name: 'Ventas Históricas',
            data: <?= json_encode($ventasHistoricas) ?>, // Valores reales
            color: '#4caf50'
        },
        {
            name: 'Ventas Predichas',
            data: <?= json_encode($ventasPredichas) ?>, // Valores predichos
            color: '#ff9800',
            dashStyle: 'ShortDash'
        }
    ]
});


Highcharts.chart('graficoTortaPrediccion', {
    chart: { type: 'pie' },
    title: { text: 'Distribución de Ventas Predichas vs Reales' },
    tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
    series: [{
        name: 'Ventas',
        colorByPoint: true,
        data: [
            { name: 'Ventas Reales', y: <?= $totalVentasReales ?>, color: '#4caf50' },
            { name: 'Ventas Predichas', y: <?= $totalVentasPredichas ?>, color: '#2196f3' }
        ]
    }]
});


Highcharts.chart('graficoCrecimiento', {
    chart: { type: 'area' },
    title: { text: 'Tasa de Crecimiento Acumulada' },
    xAxis: {
        categories: <?= json_encode($fechas) ?>,
        title: { text: 'Meses' }
    },
    yAxis: {
        title: { text: 'Crecimiento (%)' },
        labels: { format: '{value}%' }
    },
    series: [{
        name: 'Crecimiento Acumulado',
        data: <?= json_encode($tasaCrecimiento) ?>,
        color: '#ff5722'
    }]
});



</script>
