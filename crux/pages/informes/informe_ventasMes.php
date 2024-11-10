<?php
$nivel_directorio = "../../";
require "../../carga.php";

// CONSULTAS A LA BBDD
require "datos/datos_ventaMes.php";

// JAVASCRIPT
require "js/ventaMes.php";
?>

<!-- Dashboard de Ventas Mensuales -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Tarjetas de Resumen Superior -->
        <div class="row g-4 mb-4">
            <!-- Total Ventas -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="avatar avatar-md bg-primary-subtle rounded-3">
                                <i class="ri-shopping-bag-line text-primary fs-4"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-ghost rounded-circle">
                                    <i class="ri-more-2-fill"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <h3 class="mb-2 display-6">$<?= number_format($total_ventas, 2) ?></h3>
                            <p class="text-muted mb-0">Total Ventas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Venta más Alta -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="avatar avatar-md bg-success-subtle rounded-3">
                                <i class="ri-line-chart-line text-success fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="mb-2 display-6">$<?= number_format($max_ventas, 2) ?></h3>
                            <p class="text-muted mb-0">Venta más Alta</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promedio Mensual -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="avatar avatar-md bg-warning-subtle rounded-3">
                                <i class="ri-funds-line text-warning fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="mb-2 display-6">$<?= number_format($promedio_ventas, 2) ?></h3>
                            <p class="text-muted mb-0">Promedio Mensual</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meta Mensual -->
            <div class="col-xl-3 col-md-6">
                <div class="card hover-shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="avatar avatar-md bg-warning-subtle rounded-3">
                                <i class="bi bi-currency-dollar text-primary fs-5"></i>
                            </div>
                        </div>
                        <?php
                        $porcentaje = ($total_ventas / $m) * 100;
                        if ($porcentaje >= 100) {
                            $colorClase = 'bg-success';
                            $badgeText = 'Meta Alcanzada';
                        } elseif ($porcentaje <= 40) {
                            $colorClase = 'bg-danger';
                            $badgeText = 'Meta Baja';
                        } else {
                            $colorClase = 'bg-warning';
                            $badgeText = 'Meta en Progreso';
                        }
                        ?>
                        <div class="mb-3">
                            <h3 class="mb-2 display-6" style="font-size: 1.5rem;">
                                $<?= number_format($total_ventas, 2) ?>
                                <span class="text-muted" style="font-size: 1rem;">/ $<?= number_format($m, 2) ?></span>
                            </h3>
                            <p class="text-muted mb-0">Meta Mensual</p>
                        </div>
                        <div class="progress mb-2" style="height: 6px;">
                            <div class="progress-bar <?= $colorClase ?>" style="width: <?= min($porcentaje, 100) ?>%;"
                                role="progressbar">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= number_format($porcentaje, 1) ?>% completado</small>
                            <span class="badge <?= $colorClase ?> rounded-pill"><?= $badgeText ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Gráfico Principal -->
            <div class="col-xl-8 mb-4">
                <div class="card hover-shadow-lg">
                    <div class="card-header border-0 bg-transparent pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Análisis de Ventas</h5>
                                <p class="text-muted mb-0">Comportamiento mensual de ventas</p>
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
                <div class="card hover-shadow-lg">
                    <div class="card-header border-0 bg-transparent pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Ventas por Mes</h5>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm btn-ghost rounded-circle">
                                    <i class="ri-more-2-fill"></i>
                                </button>
                            </div>
                        </div>
                        <p class="text-muted mb-0">Últimos 12 meses</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php
                            $result_mensual = mysqli_query($conexion, $query_ventas_mensuales);
                            while ($row = mysqli_fetch_assoc($result_mensual)) {
                                // Traducir el nombre del mes
                                $mes_espanol = traducirMes($row['mes_nombre']);

                                // Calcular el incremento respecto al mes anterior
                                $venta_actual = (float) $row['total_ventas'];
                                $crecimiento = isset($venta_anterior) ? (($venta_actual - $venta_anterior) / $venta_anterior) * 100 : 0;
                                $venta_anterior = $venta_actual;

                                // Determinar el color del indicador
                                $indicator_class = $crecimiento >= 0 ? 'text-success' : 'text-danger';
                                $indicator_icon = $crecimiento >= 0 ? 'ri-arrow-up-s-fill' : 'ri-arrow-down-s-fill';
                                ?>
                                <div class="list-group-item border-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1"><?= $mes_espanol ?></h6>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-muted small">
                                                    <?= number_format($row['total_transacciones']) ?> ventas
                                                </span>
                                                •
                                                <span class="text-muted small">
                                                    <?= number_format($row['total_unidades']) ?> unidades
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h6 class="mb-1">$<?= number_format($row['total_ventas'], 2) ?></h6>
                                            <?php if ($crecimiento != 0): ?>
                                                <small class="<?= $indicator_class ?>">
                                                    <i class="<?= $indicator_icon ?>"></i>
                                                    <?= abs(number_format($crecimiento, 1)) ?>%
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                    // Calcular el porcentaje respecto al mes con mayores ventas
                                    $porcentaje_del_maximo = ($row['total_ventas'] / $max_ventas) * 100;
                                    ?>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-primary" style="width: <?= $porcentaje_del_maximo ?>%;"
                                            role="progressbar">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>