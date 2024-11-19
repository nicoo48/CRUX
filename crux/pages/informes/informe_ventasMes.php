<?php
$nivel_directorio = "../../";
require "../../carga.php";

// CONSULTAS A LA BBDD
require "datos/datos_ventaMes.php";

// JAVASCRIPT
require "js/ventaMes.php";
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Header del Dashboard -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Dashboard de Ventas</h4>
                <p class="text-muted mb-0">Análisis y seguimiento de ventas mensuales</p>
            </div>
        </div>

        <!-- Tarjetas de Resumen Superior -->
        <div class="row g-4 mb-4">
            <!-- Total Ventas -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100 border-0">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md bg-primary-subtle rounded-3 me-3">
                                <i class="ri-shopping-bag-line text-primary fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-0">Total Ventas</p>
                                <h3 class="mb-0">$<?= number_format($total_ventas, 0, '.', ',') ?></h3>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <?php
                            $crecimiento_total = isset($venta_anterior) ?
                                (($total_ventas - $venta_anterior) / $venta_anterior) * 100 : 0;
                            $crecimiento_class = $crecimiento_total >= 0 ? 'success' : 'danger';
                            $crecimiento_icon = $crecimiento_total >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line';
                            ?>
                            <span class="badge bg-<?= $crecimiento_class ?>-subtle text-<?= $crecimiento_class ?> me-2">
                                <i class="<?= $crecimiento_icon ?> me-1"></i>
                                <?= abs(number_format($crecimiento_total, 1)) ?>%
                            </span>
                            <span class="text-muted small">vs. mes anterior</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Venta más Alta -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100 border-0">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md bg-success-subtle rounded-3 me-3">
                                <i class="ri-line-chart-line text-success fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-0">Venta más Alta</p>
                                <h3 class="mb-0">$<?= number_format($max_ventas, 0, '.', ',') ?></h3>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="text-muted small">
                                Logrado en <?= $mes_max_venta ?? 'este período' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promedio Mensual -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100 border-0">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md bg-info-subtle rounded-3 me-3">
                                <i class="ri-funds-line text-info fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-0">Promedio Mensual</p>
                                <h3 class="mb-0">$<?= number_format($promedio_ventas, 0, '.', ',') ?></h3>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="text-muted small">
                                Basado en los últimos 12 meses
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meta Mensual -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100 border-0">
                    <div class="card-body p-4">
                        <?php
                        $porcentaje = ($total_ventas / $m) * 100;
                        $colorClase = $porcentaje >= 100 ? 'success' : ($porcentaje <= 40 ? 'danger' : 'warning');
                        $badgeText = $porcentaje >= 100 ? 'Meta Alcanzada' : ($porcentaje <= 40 ? 'Meta Baja' : 'Meta en Progreso');
                        $iconClass = $porcentaje >= 100 ? 'ri-check-line' : ($porcentaje <= 40 ? 'ri-alert-line' : 'ri-timer-line');
                        ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-md bg-<?= $colorClase ?>-subtle rounded-3 me-3">
                                <i class="<?= $iconClass ?> text-<?= $colorClase ?> fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-0">Meta Mensual</p>
                            </div>
                        </div>

                        <!-- Contenedor de valores con ajuste automático -->
                        <div class="meta-values mb-3">
                            <div class="current-value">
                                $<?= number_format($total_ventas, 0, '.', ',') ?>
                            </div>
                            <div class="target-value">
                                / $<?= number_format($m, 0, '.', ',') ?>
                            </div>
                        </div>

                        <div class="progress mb-2" style="height: 6px;">
                            <div class="progress-bar bg-<?= $colorClase ?>"
                                style="width: <?= min($porcentaje, 100) ?>%;" role="progressbar">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= number_format($porcentaje, 1) ?>% completado</small>
                            <span class="badge bg-<?= $colorClase ?>-subtle text-<?= $colorClase ?> rounded-pill px-2">
                                <?= $badgeText ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Gráfico Principal -->
            <div class="col-xl-8">
                <div class="card hover-shadow-lg border-0">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Análisis de Ventas</h5>
                                <p class="text-muted mb-0">Comportamiento mensual de ventas y tendencias</p>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge bg-primary-subtle text-primary px-3">
                                    <i class="ri-arrow-up-line me-1"></i>
                                    <?= number_format($crecimiento_total, 1) ?>% vs. anterior
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="ventasMensualesChart" style="height: 400px;"></div>
                    </div>
                </div>
            </div>

            <!-- Panel Lateral -->
            <div class="col-xl-4">
                <div class="card hover-shadow-lg border-0">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Ventas por Mes</h5>
                                <p class="text-muted mb-0">Detalle mensual de los últimos 12 meses</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="list-group list-group-flush">
                            <?php
                            $result_mensual = mysqli_query($conexion, $query_ventas_mensuales);
                            $venta_anterior = null;

                            while ($row = mysqli_fetch_assoc($result_mensual)):
                                $mes_espanol = traducirMes($row['mes_nombre']);
                                $venta_actual = (float) $row['total_ventas'];
                                $crecimiento = isset($venta_anterior) ?
                                    (($venta_actual - $venta_anterior) / $venta_anterior) * 100 : 0;
                                $venta_anterior = $venta_actual;

                                $indicator_class = $crecimiento >= 0 ? 'success' : 'danger';
                                $indicator_icon = $crecimiento >= 0 ? 'ri-arrow-up-s-fill' : 'ri-arrow-down-s-fill';
                                $porcentaje_del_maximo = ($row['total_ventas'] / $max_ventas) * 100;
                                ?>
                                <div class="list-group-item border-0 px-4 py-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h6 class="mb-1 fw-semibold"><?= $mes_espanol ?></h6>
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="text-muted small">
                                                    <i class="ri-shopping-cart-2-line me-1"></i>
                                                    <?= number_format($row['total_transacciones']) ?> ventas
                                                </span>
                                                <span class="text-muted small">
                                                    <i class="ri-stack-line me-1"></i>
                                                    <?= number_format($row['total_unidades']) ?> unidades
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h6 class="mb-1 fw-semibold">
                                                $<?= number_format($row['total_ventas'], 0, '.', ',') ?>
                                            </h6>
                                            <?php if ($crecimiento != 0): ?>
                                                <span
                                                    class="badge bg-<?= $indicator_class ?>-subtle text-<?= $indicator_class ?>">
                                                    <i class="<?= $indicator_icon ?> me-1"></i>
                                                    <?= abs(number_format($crecimiento, 1)) ?>%
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="progress" style="height: 4px;">
                                        <div class="progress-bar bg-primary" style="width: <?= $porcentaje_del_maximo ?>%;"
                                            role="progressbar">
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>