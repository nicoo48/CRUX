<?php
require "query_pagina/datos_pagina.php";
?>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" id="pagina_central">
        <?php 
        // Cálculos iniciales para el dashboard
        $porcentaje = ($stats['total_salidas'] / $m) * 100;
        $colorClase = $porcentaje >= 100 ? 'success' : ($porcentaje <= 40 ? 'danger' : 'warning');
        $statusText = $porcentaje >= 100 ? 'Meta Alcanzada' : ($porcentaje <= 40 ? 'Meta Baja' : 'En Progreso');
        $statusIcon = $porcentaje >= 100 ? 'check-circle' : ($porcentaje <= 40 ? 'exclamation-circle' : 'arrow-up-circle');
        ?>

        <!-- Header Card -->
        <div class="card bg-gradient-primary shadow-lg text-white mb-4 overflow-hidden">
            <div class="card-body position-relative py-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl bg-white bg-opacity-15 rounded-circle me-4 p-2">
                                <i class="bi bi-person-circle text-white fs-2"></i>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1">Bienvenido, @<?= htmlspecialchars($_SESSION["usuario"]["per_usuario"]) ?></h2>
                                <p class="mb-0 fs-5">Dashboard de control - <?= date("d/m/Y") ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="meta-info p-4 bg-white bg-opacity-15 rounded-4 backdrop-blur">
                            <h3 class="fw-bold mb-2">Meta Mensual: $<?= number_format($m, 0) ?></h3>
                            <div class="d-flex align-items-center justify-content-end gap-3">
                                <div class="progress flex-1" style="height: 8px; width: 120px">
                                    <div class="progress-bar bg-white"
                                        style="width: <?= min($porcentaje, 100) ?>%"
                                        role="progressbar"
                                        aria-valuenow="<?= min($porcentaje, 100) ?>"
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                    </div>
                                </div>
                                <span class="fw-semibold">Progreso: <?= number_format($porcentaje, 1) ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="row g-4">
            <!-- Progress Card -->
            <div class="col-xl-8 col-lg-7">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <!-- Card Header -->
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <h4 class="card-title mb-1">Progreso de Meta Mensual</h4>
                                <p class="text-muted small">Actualizado en tiempo real</p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-ghost-primary btn-icon rounded-circle" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class="bi bi-download me-2"></i>Exportar Datos
                                        </a></li>
                                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class="bi bi-graph-up me-2"></i>Ver Detalles
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Progress Content -->
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="position-relative" style="width: 220px; height: 220px; margin: 0 auto;">
                                    <div class="progress-ring">
                                        <svg viewBox="0 0 120 120" style="transform: rotate(-90deg)">
                                            <circle cx="60" cy="60" r="54" stroke="#f8f9fa" stroke-width="12" fill="none" />
                                            <circle cx="60" cy="60" r="54"
                                                stroke="<?= $porcentaje >= 100 ? '#10b981' : ($porcentaje <= 40 ? '#ef4444' : '#f59e0b') ?>"
                                                stroke-width="12" fill="none" 
                                                style="stroke-dasharray: 339.292; 
                                                       stroke-dashoffset: <?= 339.292 * (1 - min($porcentaje, 100) / 100) ?>;
                                                       transition: stroke-dashoffset 1s ease-in-out" />
                                        </svg>
                                        <div class="progress-ring-value">
                                            <span class="display-5 fw-bold"><?= number_format($porcentaje, 1) ?>%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="progress-details">
                                    <div class="list-group list-group-flush">
                                        <!-- Venta Actual -->
                                        <div class="list-group-item border-0 px-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted">Venta Actual</span>
                                                <span class="h5 mb-0">$<?= number_format($stats['total_salidas'], 0) ?></span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-<?= $colorClase ?>"
                                                    style="width: <?= min($porcentaje, 100) ?>%; 
                                                           transition: width 1s ease-in-out">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Meta Mensual -->
                                        <div class="list-group-item border-0 px-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted">Meta Mensual</span>
                                                <span class="h5 mb-0">$<?= number_format($m, 0) ?></span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Footer -->
                                    <div class="mt-4 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-<?= $colorClase ?> rounded-pill px-3 py-2">
                                                <i class="bi bi-<?= $statusIcon ?> me-1"></i><?= $statusText ?>
                                            </span>
                                            <small class="text-muted">Actualizado <?= date('h:i A') ?></small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-arrow-right"></i> Ver Detalles
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="col-xl-4 col-lg-5">
                <!-- Resumen Card -->
                <div class="card shadow-sm hover-shadow-lg transition-all mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Resumen Últimos 12 Meses</h5>
                            <button class="btn btn-icon btn-ghost-primary rounded-circle" type="button">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                        </div>
                        <div class="row g-4 mt-2">
                            <div class="col-4 text-center">
                                <p class="h5 mb-1">$<?= number_format($total_ventas, 0) ?></p>
                                <p class="text-muted mb-0 small">Ventas</p>
                            </div>
                            <div class="col-4 text-center">
                                <p class="h5 mb-1"><?= number_format($total_unidades) ?></p>
                                <p class="text-muted mb-0 small">Unidades</p>
                            </div>
                            <div class="col-4 text-center">
                                <p class="h5 mb-1">$<?= number_format($promedio_ventas, 0) ?></p>
                                <p class="text-muted mb-0 small">Promedio</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingresos y Productos Cards -->
                <div class="row g-4">
                    <!-- Ingresos Card -->
                    <div class="col-md-6 col-xl-12">
                        <div class="card shadow-sm hover-shadow-lg transition-all">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-success-subtle rounded-3 p-3 me-3">
                                        <i class="bi bi-currency-dollar text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Ingresos del Mes</p>
                                        <h3 class="mb-0">$<?= number_format($stats['total_ingresos'], 0) ?></h3>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-1" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                        <span class="badge bg-success-subtle text-success px-2">+15%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Productos Card -->
                    <div class="col-md-6 col-xl-12">
                        <div class="card shadow-sm hover-shadow-lg transition-all">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-info-subtle rounded-3 p-3 me-3">
                                        <i class="bi bi-box text-info fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Total Productos</p>
                                        <h3 class="mb-0"><?= number_format($stats['total_productos']) ?></h3>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-1" style="height: 6px;">
                                            <div class="progress-bar bg-info" style="width: 65%"></div>
                                        </div>
                                        <span class="badge bg-info-subtle text-info px-2">Activos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>