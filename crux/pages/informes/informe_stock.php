<?php
$nivel_directorio = "../../";
require "../../carga.php";
// CONSULTAS A LA BBDD
require "datos/datos_stock.php";
// JAVASCRIPT
require "js/stock.php";
?>
<!-- Solo incluir la librería básica de Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Gráfico Circular -->
            <div class="col-md-7 col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Distribución de Stock</h5>
                    </div>
                    <div class="card-body">
                        <div id="chartError" class="alert alert-danger" style="display: none;"></div>
                        <div id="stockChart" style="min-height: 400px;"></div>
                    </div>
                </div>
            </div>
            <!-- Estadísticas -->
            <div class="col-md-5 col-12">
                <!-- Resumen General -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Resumen General</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Productos</h6>
                                    <small class="text-muted">Productos únicos en inventario</small>
                                </div>
                                <h4 class="mb-0"><?= number_format($stats['total_productos']) ?></h4>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Ingresos</h6>
                                    <small class="text-muted">Unidades ingresadas</small>
                                </div>
                                <h4 class="text-success mb-0"><?= number_format($stats['total_ingresos']) ?></h4>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Salidas</h6>
                                    <small class="text-muted">Unidades retiradas</small>
                                </div>
                                <h4 class="text-danger mb-0"><?= number_format($stats['total_salidas']) ?></h4>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Balance de Stock</h6>
                                    <small class="text-muted">Ingresos - Salidas</small>
                                </div>
                                <h4 class="mb-0">
                                    <?= number_format($stats['total_ingresos'] - $stats['total_salidas']) ?>
                                </h4>
                            </div>
                            <hr class="my-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Movimientos</h6>
                                    <small class="text-muted">Operaciones realizadas</small>
                                </div>
                                <h4 class="mb-0">
                                    <?= number_format($stats['total_movimientos_ingreso'] + $stats['total_movimientos_salida']) ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicadores de Stock -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Indicadores de Stock</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">Rotación de Inventario</h6>
                                    <span class="badge bg-label-primary">
                                        <?= number_format($stats['total_salidas'] / max(1, $stats['total_productos']), 1) ?>
                                    </span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <?php
                                    $rotacion_porcentaje = min(100, ($stats['total_salidas'] / max(1, $stats['total_productos'])) * 10);
                                    ?>
                                    <div class="progress-bar bg-primary" style="width: <?= $rotacion_porcentaje ?>%;" role="progressbar"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">Eficiencia de Stock</h6>
                                    <span class="badge bg-label-success">
                                        <?php
                                        $eficiencia = ($stats['total_ingresos'] > 0) 
                                            ? (($stats['total_ingresos'] - $stats['total_salidas']) / $stats['total_ingresos'] * 100) 
                                            : 0;
                                        echo number_format($eficiencia, 1) . '%';
                                        ?>
                                    </span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: <?= max(0, min(100, $eficiencia)) ?>%;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>