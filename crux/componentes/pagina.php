<?php
require "datos_pagina/datos_pagina.php";
require "js_pagina/js_pagina.php";
?>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" id="pagina_central">
        <?php
        $porcentaje = ($stats['total_salidas'] / $m) * 100;
        $colorClase = $porcentaje >= 100 ? 'success' : ($porcentaje <= 40 ? 'danger' : 'warning');
        $statusText = $porcentaje >= 100 ? 'Meta Alcanzada' : ($porcentaje <= 40 ? 'Meta Baja' : 'En Progreso');
        $statusIcon = $porcentaje >= 100 ? 'check-circle' : ($porcentaje <= 40 ? 'exclamation-circle' : 'arrow-up-circle');
        ?>

        <div class="card shadow-lg mb-4 position-relative overflow-hidden">
            <!-- Background Gradient -->
            <div class="position-absolute w-100 h-100" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);opacity: 0.95;z-index: 1;">
            </div>

            <!-- Content -->
            <div class="card-body py-4 position-relative" style="z-index: 2;">
                <div class="row align-items-center">
                    <!-- User Info Section -->
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center">
                            <div class="avatar-wrapper me-4">
                                <div class="avatar avatar-xl rounded-circle" style="
                                        background: rgba(255, 255, 255, 0.2);
                                        backdrop-filter: blur(8px);
                                        border: 2px solid rgba(255, 255, 255, 0.3);">
                                    <i class="bi bi-person-circle text-white fs-2"></i>
                                </div>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1 text-white">
                                    Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]["per_usuario"]) ?>
                                </h2>
                                <p class="mb-0 text-white text-opacity-75">
                                    Dashboard de control
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Meta Info Section -->
                    <div class="col-lg-4">
                        <div class="p-4 rounded-4" style="
                            background: rgba(255, 255, 255, 0.1);
                            backdrop-filter: blur(8px);
                            border: 1px solid rgba(255, 255, 255, 0.2);">
                            <div class="text-center">
                                <h3 class="fw-bold mb-3 text-white">
                                    Meta Mensual: $<?= cantidad($m) ?>
                                </h3>
                                <div class="progress mb-2" style="height: 10px; background: rgba(255, 255, 255, 0.2);">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: <?= min($porcentaje, 100) ?>%; background: rgba(255, 255, 255, 0.9);"
                                        aria-valuenow="<?= min($porcentaje, 100) ?>" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-white text-opacity-75">Progreso</span>
                                    <span class="fw-semibold text-white"><?= cantidad($porcentaje) ?>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-absolute" style="
                bottom: -20px;
                right: -20px;
                width: 150px;
                height: 150px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                z-index: 1;
            "></div>
            <div class="position-absolute" style="
                top: -30px;
                left: -30px;
                width: 100px;
                height: 100px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                z-index: 1;
            "></div>
        </div>
        <div class="row g-4 mb-4">
            <!-- Progress Card -->
            <div class="col-xl-8">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <h4 class="card-title mb-1">Progreso de Meta Mensual</h4>
                                <p class="text-muted small">Actualizado en tiempo real</p>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <!-- Aro de progreso -->
                            <div class="col-md-5">
                                <div class="position-relative" style="width: 220px; height: 220px; margin: 0 auto;">
                                    <div class="progress-ring">
                                        <svg viewBox="0 0 120 120" style="transform: rotate(-90deg)">
                                            <circle cx="60" cy="60" r="54" stroke="#f8f9fa" stroke-width="12"
                                                fill="none" />
                                            <circle cx="60" cy="60" r="54"
                                                stroke="<?= $porcentaje >= 100 ? '#10b981' : ($porcentaje <= 40 ? '#ef4444' : '#f59e0b') ?>"
                                                stroke-width="12" fill="none" style="stroke-dasharray: 339.292; 
                                                       stroke-dashoffset: <?= 339.292 * (1 - min($porcentaje, 100) / 100) ?>;
                                                       transition: stroke-dashoffset 1s ease-in-out" />
                                        </svg>
                                        <div class="progress-ring-value">
                                            <span class="display-5 fw-bold"><?= cantidad($porcentaje) ?>%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Details -->
                            <div class="col-md-7">
                                <div class="progress-details">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item border-0 px-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted">Venta Actual</span>
                                                <span
                                                    class="h5 mb-0">$<?= cantidad($stats['total_salidas']) ?></span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-<?= $colorClase ?>"
                                                    style="width: <?= min($porcentaje, 100) ?>%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item border-0 px-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted">Meta Mensual</span>
                                                <span class="h5 mb-0">$<?= cantidad($m) ?></span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats Column -->
            <div class="col-xl-4">
                <div class="row g-4">
                    <!-- Summary Card -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Resumen Últimos 12 Meses</h5>
                                    <button class="btn btn-icon btn-ghost-primary rounded-circle">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                </div>
                                <div class="row text-center g-3">
                                    <div class="col-4">
                                        <p class="h5 mb-1">$<?= cantidad($total_ventas) ?></p>
                                        <p class="text-muted small mb-0">Ventas</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="h5 mb-1"><?= cantidad($total_unidades) ?></p>
                                        <p class="text-muted small mb-0">Unidades</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="h5 mb-1">$<?= cantidad($promedio_ventas) ?></p>
                                        <p class="text-muted small mb-0">Promedio</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Cards -->
                    <div class="col-12">
                        <div class="row g-4">
                            <!-- Income Card -->
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-lg bg-success-subtle rounded-3 p-3 me-3">
                                                <i class="bi bi-currency-dollar text-success fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">Valor de Compras del Mes</p>
                                                <h3 class="mb-0">$<?= cantidad($stats['total_ingresos']) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Products Card -->
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-lg bg-info-subtle rounded-3 p-3 me-3">
                                                <i class="bi bi-box text-info fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-muted small mb-0">Total Productos Comprados</p>
                                                <h3 class="mb-0"><?= cantidad($cantidad_compras) ?></h3>
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
        <div class="row g4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg bg-success-subtle rounded-3 p-2 me-3">
                                <i class="bi bi-arrow-up-right-circle text-success fs-5"></i>
                            </div>
                            <div>
                                <p class="text-muted small mb-1">Producto Más Vendido <?=$meses[date('m')]." - ".date('Y',strtotime('-12 months'))?></p>
                                <?php
                                $id_prod_max = array_search(max($ventas_anio_pasado), $ventas_anio_pasado);
                                $prod_max = select("productos", "*", ["pro_id" => $id_prod_max]);
                                $prod_max = $prod_max["datos"][0];
                                ?>
                                <h5 class="mb-0"><?= $prod_max["pro_nombre"] ?> - <?= cantidad($ventas_anio_pasado[$id_prod_max]) ?> unidades</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg bg-danger-subtle rounded-3 p-2 me-3">
                                <i class="bi bi-arrow-down-left-circle text-danger fs-5"></i>
                            </div>
                            <div>
                                <p class="text-muted small mb-1">Producto Menos Vendido <?=$meses[date('m')]." - ".date('Y',strtotime('-12 months'))?></p>
                                <?php
                                $id_prod_min = array_search(min($ventas_anio_pasado), $ventas_anio_pasado);
                                $prod_min = select("productos", "*", ["pro_id" => $id_prod_min]);
                                $prod_min = $prod_min["datos"][0];
                                ?>
                                <h5 class="mb-0"><?= $prod_min["pro_nombre"] ?> - <?= cantidad($ventas_anio_pasado[$id_prod_min]) ?> unidades</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Analytics Section -->
        <div class="row g-4">
            <!-- Analytics Cards -->
            <div class="col-xl-4">
                <div class="row g-4">
                    <!-- Average Sale Card -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-primary-subtle rounded-3 p-3 me-3">
                                        <i class="bi bi-graph-up-arrow text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Valor Promedio de Venta</p>
                                        <h3 class="mb-0">$<?= cantidad($stats["total_salidas"] / $cantidad_ventas) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions Card -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-warning-subtle rounded-3 p-3 me-3">
                                        <i class="bi bi-receipt text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Total Productos Vendidos</p>
                                        <h3 class="mb-0"><?= cantidad($cantidad_ventas) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Average Ticket Card -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-success-subtle rounded-3 p-3 me-3">
                                        <i class="bi bi-cash-stack text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted small mb-0">Promedio de Margen de utilidad</p>
                                        <h3 class="mb-0">
                                            $<?= cantidad($stats["total_salidas"] / $cantidad_ventas - $stats["total_ingresos"] / $cantidad_compras) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="col-xl-8">
                <div class="card h-100 shadow-sm">
                    <div class="card-header border-0 bg-transparent pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Análisis Gráfico de Ventas</h5>
                                <p class="text-muted mb-0">Comportamiento mensual de ventas de los últimos 12 meses</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="ventasMensualesChart2" style="min-height: 400px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .hover-shadow-lg {
        transition: box-shadow 0.3s ease-in-out;
    }

    .hover-shadow-lg:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
    }

    .transition-all {
        transition: all 0.3s ease-in-out;
    }

    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-lg {
        width: 48px;
        height: 48px;
    }

    .progress-ring {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .progress-ring-value {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .btn-soft-primary {
        color: #3b82f6;
        background-color: rgba(59, 130, 246, 0.1);
    }

    .btn-soft-primary:hover {
        color: #fff;
        background-color: #3b82f6;
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #3b82f6, #60a5fa);
    }

    .bg-opacity-15 {
        --bs-bg-opacity: 0.15;
    }
</style>