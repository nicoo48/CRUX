<?php
$nivel_directorio = "../../";
require "../../carga.php";

// CONSULTAS A LA BBDD
require "datos/datos_ventaMes.php";

// JAVASCRIPT
require "js/ventaMes.php";
?>
<!-- Solo incluir la librería básica de Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<!-- Dashboard de Ventas Mensuales -->
<div class="row g-4">
    <!-- Tarjetas de Resumen Superior -->
    <div class="col-12">
        <div class="row g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="avatar avatar-md bg-primary-subtle rounded-3">
                                <i class="ri-shopping-bag-line text-primary fs-4"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-ghost rounded-circle" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Ver Detalles</a></li>
                                    <li><a class="dropdown-item" href="#">Generar Reporte</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="mb-1 display-6">$<?= number_format($total_ventas, 2) ?></h3>
                        <p class="text-muted mb-2">Total Ventas</p>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-<?= $tendencia === 'up' ? 'success' : 'danger' ?>-subtle text-<?= $tendencia === 'up' ? 'success' : 'danger' ?> rounded-pill">
                                <i class="ri-arrow-<?= $tendencia ?>-s-line"></i> <?= $tendencia === 'up' ? '+' : '-' ?>2.5%
                            </span>
                            <span class="text-muted ms-2 small">vs mes anterior</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="avatar avatar-md bg-success-subtle rounded-3">
                                <i class="ri-line-chart-line text-success fs-4"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-ghost rounded-circle" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Ver Detalles</a></li>
                                    <li><a class="dropdown-item" href="#">Generar Reporte</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="mb-1 display-6">$<?= number_format($max_ventas, 2) ?></h3>
                        <p class="text-muted mb-2">Venta más Alta</p>
                        <div class="text-muted small">Mejor desempeño mensual</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="avatar avatar-md bg-warning-subtle rounded-3">
                                <i class="ri-funds-line text-warning fs-4"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-ghost rounded-circle" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Ver Detalles</a></li>
                                    <li><a class="dropdown-item" href="#">Generar Reporte</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="mb-1 display-6">$<?= number_format($promedio_ventas, 2) ?></h3>
                        <p class="text-muted mb-2">Promedio Mensual</p>
                        <div class="text-muted small">Basado en los últimos 12 meses</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="avatar avatar-md bg-info-subtle rounded-3">
                                <i class="ri-target-line text-info fs-4"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-ghost rounded-circle" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Ver Detalles</a></li>
                                    <li><a class="dropdown-item" href="#">Generar Reporte</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="mb-1 display-6">78%</h3>
                        <p class="text-muted mb-2">Meta Mensual</p>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 78%;" role="progressbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico Principal -->
    <div class="col-xl-8">
        <div class="card hover-shadow-lg">
            <div class="card-header border-0 bg-transparent pt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Análisis de Ventas</h5>
                        <p class="text-muted mb-0">Comportamiento mensual de ventas</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-soft-primary btn-sm rounded-pill px-3">
                            <i class="ri-download-2-line me-1"></i> Exportar
                        </button>
                        <select class="form-select form-select-sm w-auto">
                            <option>Últimos 12 meses</option>
                            <option>Últimos 6 meses</option>
                            <option>Este año</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="ventasMensualesChart" style="height: 400px;"></div>
            </div>
        </div>
    </div>

    <!-- Panel Lateral -->
    <div class="col-xl-4">
        <!-- Métricas Clave -->
        <div class="card hover-shadow-lg mb-4">
            <div class="card-header border-0 bg-transparent pt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Métricas Clave</h5>
                    <div class="dropdown">
                        <button class="btn btn-icon btn-sm btn-ghost rounded-circle" data-bs-toggle="dropdown">
                            <i class="ri-more-2-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Ver Detalles</a></li>
                            <li><a class="dropdown-item" href="#">Exportar Datos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-3 bg-primary-subtle rounded">
                                    <i class="ri-shopping-bag-line text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Total Transacciones</h6>
                                    <small class="text-muted">Este mes</small>
                                </div>
                            </div>
                            <h5 class="mb-0">1,245</h5>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 85%;" role="progressbar"></div>
                        </div>
                    </div>

                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-3 bg-success-subtle rounded">
                                    <i class="ri-user-line text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Clientes Nuevos</h6>
                                    <small class="text-muted">Este mes</small>
                                </div>
                            </div>
                            <h5 class="mb-0">845</h5>
                        </div>
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 65%;" role="progressbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Indicadores de Rendimiento -->
        <div class="card hover-shadow-lg">
            <div class="card-header border-0 bg-transparent pt-4">
                <h5 class="mb-0">Rendimiento</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-lg bg-success-subtle rounded">
                            <i class="ri-line-chart-line text-success fs-3"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Crecimiento Anual</h6>
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 me-2">62%</h4>
                            <small class="text-success">
                                <i class="ri-arrow-up-s-fill"></i> 12%
                            </small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-lg bg-warning-subtle rounded">
                            <i class="ri-funds-line text-warning fs-3"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">ROI</h6>
                        <div class="d-flex align-items-center">
                            <h4 class="mb-0 me-2">89%</h4>
                            <small class="text-success">
                                <i class="ri-arrow-up-s-fill"></i> 8%
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos mejorados */
.hover-shadow-lg {
    transition: all 0.3s ease;
}

.hover-shadow-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08) !important;
}

.card {
    border: none;
    border-radius: 1rem;
    background: #fff;
    box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.04);
}

.btn-soft-primary {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
    border: none;
}

.btn-soft-primary:hover {
    background-color: var(--bs-primary);
    color: #fff;
}

.btn-ghost {
    color: #6c757d;
    background: transparent;
    border: none;
}

.btn-ghost:hover {
    background-color: rgba(108, 117, 125, 0.1);
}

.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
}

.avatar-md {
    width: 3.5rem;
    height: 3.5rem;
}

.avatar-lg {
    width: 4rem;
    height: 4rem;
}

.progress {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    border-radius: 1rem;
}

.form-select {
    border-radius: 0.5rem;
}

.list-group-item {
    padding: 1rem 0;
}

/* Estilos para el tema oscuro (opcional) */
[data-bs-theme="dark"] .card {
    background: #2b2c40;
}

[data-bs-theme="dark"] .btn-soft-primary {
    background-color: rgba(var(--bs-primary-rgb), 0.2);
}

[data-bs-theme="dark"] .text-muted {
    color: #7983a9 !important;
}
</style>