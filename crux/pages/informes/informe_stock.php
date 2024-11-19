<?php
$nivel_directorio = "../../";
require "../../carga.php";
// CONSULTAS A LA BBDD
require "datos/datos_stock.php";
// JAVASCRIPT
require "js/stock.php";

// Inicializar variables
$mostrar_contenido = false;
$mensaje = "";

// Validar si hay un producto seleccionado
if (isset($_REQUEST['producto']) && !empty($_REQUEST['producto'])) {
    // Calcular el stock actual
    $stock_actual = $stats['total_ingresos'] - $stats['total_salidas'];
    
    // Si hay movimientos (ingresos o salidas diferentes de 0)
    if ($stats['total_ingresos'] !== 0 || $stats['total_salidas'] !== 0) {
        if ($stock_actual === 0) {
            $mensaje = "El producto seleccionado no tiene stock disponible.";
            $mostrar_contenido = false;
        } else {
            $mostrar_contenido = true;
        }
    } else {
        $mensaje = "El producto seleccionado no tiene movimientos registrados.";
        $mostrar_contenido = false;
    }
}

// Si hay producto seleccionado pero no debe mostrar el contenido, mostrar mensaje
if (isset($_REQUEST['producto']) && !empty($_REQUEST['producto']) && !$mostrar_contenido) {
    mensaje(
        "Sin Información Disponible, Consulte Otro Producto",
        $mensaje,
        "info"
    );
}
?>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Buscador de Producto -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Consulta el Stock de otro Producto</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <div class="buscador">
                                    <?php selector([
                                        'campo' => 'producto',
                                        'tabla' => 'productos',
                                        'id' => 'pro_id',
                                        'campos' => ['pro_codigo', 'pro_nombre'],
                                        'todos' => 'Seleccione un producto',
                                        'order_by' => 'pro_codigo ASC'
                                    ]); ?>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-primary" onclick="buscarProducto()">
                                    <i class="bx bx-search me-1"></i>
                                    Consultar Stock
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($mostrar_contenido): ?>
        <div class="row">
            <!-- Información del Producto -->
            <div class="col-md-5 col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Detalles del Producto</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Stock Actual</h6>
                                    <small class="text-muted">Balance actual en inventario</small>
                                </div>
                                <h4 class="mb-0"><?= number_format($stats['total_ingresos'] - $stats['total_salidas']) ?></h4>
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
                                    <h6 class="mb-0">Movimientos Totales</h6>
                                    <small class="text-muted">Cantidad de operaciones</small>
                                </div>
                                <h4 class="mb-0">
                                    <?= number_format($stats['total_movimientos_ingreso'] + $stats['total_movimientos_salida']) ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indicadores -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Métricas del Producto</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">Rotación</h6>
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
                                <small class="text-muted">Frecuencia de movimiento del producto</small>
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
                                <small class="text-muted">Relación entre ingresos y salidas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Movimientos -->
            <div class="col-md-7 col-12 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Historial de Movimientos</h5>
                    </div>
                    <div class="card-body">
                        <div id="chartError" class="alert alert-danger" style="display: none;"></div>
                        <div id="stockChart" style="min-height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>