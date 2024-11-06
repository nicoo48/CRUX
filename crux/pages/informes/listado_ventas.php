<?php
$nivel_directorio = "../../";
require "../../carga.php";

// CONSULTAS A LA BBDD
require "datos/datos_masVendidos.php";
?>

<!-- Listado Completo de Productos -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Listado Completo de Productos Vendidos</h5>
            <div>
                <button class="btn btn-sm btn-outline-secondary me-2" id="exportExcel">Exportar Excel</button>
                <button class="btn btn-sm btn-primary" id="printList">Imprimir</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="1">SKU</th>
                            <th>Producto</th>
                            <th>Total Vendido</th>
                            <th>% del Total</th>
                            <th width="1">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_global = 0;
                        mysqli_data_seek($result_ventas, 0);
                        while ($row = mysqli_fetch_assoc($result_ventas)) {
                            $total_global += $row['total_vendido'];
                        }

                        mysqli_data_seek($result_ventas, 0);
                        while ($row = mysqli_fetch_assoc($result_ventas)) {
                            $porcentaje = ($row['total_vendido'] / $total_global) * 100;
                            ?>
                            <tr>
                                <td><span class="badge bg-light text-dark"><?= htmlspecialchars($row['pro_codigo']) ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0"><?= htmlspecialchars($row['pro_nombre']) ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-0"><?= number_format($row['total_vendido'], 0) ?></h6>
                                    <small class="text-muted">unidades</small>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $porcentaje ?>%;"
                                            aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-muted"><?= number_format($porcentaje, 1) ?>%</small>
                                </td>
                                <td>
                                    <?php if ($porcentaje > 15): ?>
                                        <span class="badge bg-success">Alto Rendimiento</span>
                                    <?php elseif ($porcentaje > 5): ?>
                                        <span class="badge bg-warning">Rendimiento Medio</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Bajo Rendimiento</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>