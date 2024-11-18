<?php
$nivel_directorio = "../../";
require "../../carga.php";
require "datos/datos_masVendidos.php";
require "js/masVendidos.php";
$meta = select("tiendas", "tnd_meta_mensual");
$m = $meta["datos"][0]["tnd_meta_mensual"];

?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Fila Superior - KPIs -->
        <div class="row">
            <!-- Meta Mensual -->
            <div class="col-md-6 col-xl-8 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <br>
                                <h5 class="mb-0"><i class="bi bi-currency-dollar"></i> Meta Mensual</h5>
                                <p class="text-muted small mb-0">Progreso actual del mes</p>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <h4 class="mb-0 me-2">
                                    $<?= number_format($stats['total_salidas'], 0) . " / $" . $m ?>
                                </h4>
                            </div>
                        </div>
                        <?php
                        $porcentaje = ($stats['total_salidas'] / $m) * 100;

                        // Determinar el color según el porcentaje
                        if ($porcentaje >= 100) {
                            $colorClase = 'bg-success';
                        } elseif ($porcentaje <= 40) {
                            $colorClase = 'bg-danger';
                        } else {
                            $colorClase = 'bg-warning';
                        }
                        ?>
                        <div class="progress rounded-pill mb-2" style="height: 8px">
                            <div class="progress-bar <?= $colorClase ?>" role="progressbar"
                                style="width: <?= min($porcentaje, 100) ?>%" aria-valuenow="<?= $porcentaje ?>"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <!-- Opcional: Mostrar el porcentaje debajo de la barra -->
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Progreso: <?= number_format($porcentaje, 1) ?>%</small>
                            <?php if ($porcentaje >= 100): ?>
                                <span class="badge bg-success">Meta Alcanzada</span>
                            <?php elseif ($porcentaje <= 40): ?>
                                <span class="badge bg-danger">Meta Baja</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Meta en Progreso</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KPI - Total Ventas -->
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="fw-medium d-block mb-1">Total Ventas</span>
                                <div class="d-flex align-items-baseline mb-2">
                                    <h4 class="mb-0 me-2">$<?= number_format($total_mes['total_ventas'], 0) ?></h4>
                                    <small class="text-success"><i class="bi bi-arrow-up"></i> +14%</small>
                                </div>
                                <span class="badge bg-label-primary rounded-pill">Este Mes</span>
                            </div>
                            <div class="avatar bg-primary-subtle p-3 rounded">
                                <i class="bi bi-currency-dollar text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fila Principal - Gráfico y Estadísticas -->
        <div class="row">
            <!-- Gráfico Principal -->
            <div class="col-xl-8 col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">Productos más Vendidos</h5>
                            <small class="text-muted">Análisis mensual de ventas por producto</small>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <div id="ventasChart" style="height: 360px;"></div>
                    </div>
                </div>
            </div>

            <!-- Panel Lateral -->
            <div class="col-xl-4 col-12">
                <!-- Estadísticas Rápidas -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Resumen Estadístico</h5>
                    </div>
                    <div class="card-body">
                        <!-- Productos en Stock -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-info-subtle rounded p-2">
                                    <i class="bi bi-box text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Productos en Stock</h6>
                                    <small class="text-muted">Inventario actual</small>
                                </div>
                            </div>
                            <h4 class="mb-0 text-info"><?= number_format($stats['total_productos']) ?></h4>
                        </div>

                        <!-- Total Compras -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-success-subtle rounded p-2">
                                    <i class="bi bi-cart-plus text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Total Compras</h6>
                                    <small class="text-muted">Este mes</small>
                                </div>
                            </div>
                            <h4 class="mb-0 text-success">$<?= number_format($stats['total_ingresos']) ?></h4>
                        </div>

                        <!-- Total Ventas -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar bg-danger-subtle rounded p-2">
                                    <i class="bi bi-cart-check text-danger"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Total Ventas</h6>
                                    <small class="text-muted">Este mes</small>
                                </div>
                            </div>
                            <h4 class="mb-0 text-danger">$<?= number_format($stats['total_salidas']) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 1rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        margin-bottom: 1.5rem;
        box-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.05);
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, .05);
        padding: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .avatar {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.75rem;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 1rem;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
    }

    .progress-bar {
        border-radius: 1rem;
        transition: width .6s ease;
    }

    .bg-success {
        background-color: #28a745 !important;
    }

    .bg-warning {
        background-color: #ffc107 !important;
    }

    .bg-danger {
        background-color: #dc3545 !important;
    }

    /* Efecto hover en la barra de progreso */
    .progress:hover .progress-bar {
        opacity: 0.9;
    }

    /* Estilos para las badges */
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        border-radius: 0.375rem;
    }

    .bg-label-primary {
        background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        color: var(--bs-primary) !important;
    }

    .list-group-item {
        padding: 1rem 1.5rem;
    }

    .list-group-item:hover {
        background-color: rgba(0, 0, 0, .01);
    }

    .dropdown-toggle::after {
        margin-left: 0.5em;
    }

    /* Estilos para el tema oscuro */
    [data-bs-theme="dark"] .card {
        background-color: #2b2c40;
    }

    [data-bs-theme="dark"] .bg-label-primary {
        background-color: rgba(105, 108, 255, 0.16) !important;
    }

    [data-bs-theme="dark"] .text-muted {
        color: #7983bb !important;
    }
</style>