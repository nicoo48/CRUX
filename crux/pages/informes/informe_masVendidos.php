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
        <!-- Fila Principal - Gráfico y Estadísticas -->
        <div class="row g-4">
            <!-- Gráfico Principal -->
            <div class="col-xl-8">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">Top 10 Productos más Vendidos</h5>
                            <p class="text-muted small mb-0">Análisis mensual de ventas por producto</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="ventasChart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

            <!-- Panel Lateral de Estadísticas -->
            <div class="col-xl-4">
                <div class="row g-4">
                    <!-- Tarjeta de Ventas Totales -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar bg-primary-subtle rounded p-2">
                                            <i class="bi bi-graph-up text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted small mb-0">Ventas Totales</p>
                                            <h4 class="mb-0">$<?= number_format($stats['total_salidas'], 0) ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress rounded-pill" style="height: 6px">
                                    <div class="progress-bar bg-primary" style="width: <?= ($stats['total_salidas'] / $m) * 100 ?>%"></div>
                                </div>
                                <small class="text-muted">vs. Meta Mensual</small>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Productos Top -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="text-muted mb-3">Detalles de Productos Top</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">Producto</th>
                                                <th class="text-end text-muted">Unidades</th>
                                                <th class="text-end text-muted">Ingresos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach (array_slice($data_productos, 0, 5) as $producto): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar avatar-xs bg-primary-subtle rounded-circle">
                                                            <small class="text-primary"><?= substr($producto['pro_nombre'], 0, 1) ?></small>
                                                        </div>
                                                        <span class="text-truncate" style="max-width: 150px;" title="<?= htmlspecialchars($producto['pro_nombre']) ?>">
                                                            <?= htmlspecialchars($producto['pro_nombre']) ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="text-end"><?= number_format($producto['total_vendido']) ?></td>
                                                <td class="text-end">$<?= number_format($producto['total_ingresos']) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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