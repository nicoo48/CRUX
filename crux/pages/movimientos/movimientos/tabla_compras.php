<div class="card-body pb-1 pt-0">
    <?php
    if (!empty($lista_compras)) {
    ?>
        <div class="table-responsive text-nowrap border-top">
            <table class="table">
                <thead class="table-border-bottom-0">
                    <tr>
                        <th class="text-center" width="1">#</th>
                        <th>Producto</th>
                        <th class="text-center" width="1">Movimiento</th>
                        <th class="text-center" width="130">Tipo Mov</th>
                        <th class="text-center" width="1">Fecha</th>
                        <th class="text-center" width="1">Cantidad</th>
                        <th class="text-center" width="1">Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    $total_registros = 0;
                    $total_general = 0;
                    
                    foreach ($lista_compras as $compras) {
                        foreach ($compras["detalles"] as $detalle) {
                            $total_registros++;
                            $total_general += $detalle["mdet_total"];
                            $producto = $lista_productos[$detalle["mdet_pro_id"]];

                            // Determinar el tipo y clase de movimiento
                            $tipo_movimiento = "";
                            $badge_class = "";
                            
                            switch($detalle["mdet_clase"]) {
                                case "COM":
                                    $tipo_movimiento = "Compra";
                                    $badge_class = "bg-success";
                                    break;
                                case "AJU":
                                    $tipo_movimiento = "Ajuste";
                                    $badge_class = "bg-secondary";
                                    break;
                                default:
                                    $tipo_movimiento = $detalle["mdet_clase"];
                                    $badge_class = "bg-secondary";
                            }
                    ?>
                            <tr>
                                <td>
                                    <span class="text-heading"><?= $total_registros ?></span>
                                </td>
                                <td>
                                    <span class="text-heading"><?= $producto["pro_codigo"] ?>  - <?= $producto["pro_nombre"]?></span>
                                </td>
                                <td class="text-center">
                                    <span class="text-heading"><?= $compras["mov_id"] ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $badge_class ?> rounded-pill">
                                        <?= htmlspecialchars($tipo_movimiento) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="text-heading fw-medium"><?= fecha($compras["mov_fecha"]) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="text-heading fw-medium"><?= cantidad($detalle["mdet_cantidad"]) ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="text-heading fw-medium"><?= cantidad($detalle["mdet_total"]) ?></span>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="border-top">
                        <td colspan="6" class="text-end fw-bold">Total General:</td>
                        <td class="text-center fw-bold"><?= cantidad($total_general) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php } ?>
    <?php if ($total_registros === 0) {
        mensaje(
            "Sin Compras",
            "Aun no hay movimientos",
            "success",
            "info-circle",
            1
        );
    } ?>
</div>
<div class="mt-3">
    <small class="text-muted">
        Mostrando <?= $total_registros ?> registro<?= $total_registros !== 1 ? 's' : '' ?>
    </small>
</div>
<style>
    .table td.text-center,
    .table th.text-center {
        text-align: center !important;
    }
    
    .table td.text-center span {
        display: inline-block;
        width: 100%;
        text-align: center;
    }
    
    .table thead th.text-center {
        vertical-align: middle;
    }

    .badge {
        padding: 0.5em 1em;
        font-size: 0.85em;
    }

    .badge.rounded-pill {
        border-radius: 50rem;
    }

    .table td {
        vertical-align: middle;
    }
</style>