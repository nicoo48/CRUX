<?php
// obtener_ventas.php
// Obtener los filtros
$producto = $_POST['producto'] ?? '';
$movimiento = $_POST['movimiento'] ?? '';
$fecha_desde = $_POST['fecha_desde'] ?? '';
$fecha_hasta = $_POST['fecha_hasta'] ?? '';

// Filtrar el array $lista_ventas según los criterios
$ventas_filtradas = array_filter($lista_ventas, function ($venta) use ($producto, $movimiento, $fecha_desde, $fecha_hasta) {
    $fecha_venta = strtotime($venta['mov_fecha']);

    // Filtrar por fecha
    if ($fecha_desde && strtotime($fecha_desde) > $fecha_venta)
        return false;
    if ($fecha_hasta && strtotime($fecha_hasta) < $fecha_venta)
        return false;

    // Filtrar por movimiento
    if ($movimiento && !in_array($movimiento, array_column($venta['detalles'], 'mdet_mov_id')))
        return false;

    // Filtrar por producto
    if ($producto) {
        $productos_venta = array_column($venta['detalles'], 'mdet_pro_id');
        if (!in_array($producto, $productos_venta))
            return false;
    }

    return true;
});
?>
<br>
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

            foreach ($ventas_filtradas as $venta):
                foreach ($venta["detalles"] as $detalle):
                    $producto = $lista_productos[$detalle["mdet_pro_id"]];
                    $total_registros++;
                    $total_general += $detalle["mdet_total"];

                    // Determinar el tipo y clase de movimiento
                    $tipo_movimiento = "";
                    $badge_class = "";
                    
                    switch($detalle["mdet_clase"]) {
                        case "VNT":
                            $tipo_movimiento = "Venta";
                            $badge_class = "bg-success";
                            break;
                        case "AJU":
                            $tipo_movimiento = "Ajuste";
                            $badge_class = "bg-secondary";
                            break;
                        case "MRM":
                            $tipo_movimiento = "Merma";
                            $badge_class = "bg-danger";
                            break;
                        default:
                            $tipo_movimiento = $detalle["mdet_clase"];
                            $badge_class = "bg-secondary";
                    }
                    ?>
                    <tr>
                        <td>
                            <span class="text-heading"><?= $total_registros?></span>
                        </td>
                        <td>
                            <span class="text-heading"><?= $producto["pro_codigo"] ?>  - <?= $producto["pro_nombre"]?></span>
                        </td>
                        <td class="text-center">
                            <span class="text-heading"><?= htmlspecialchars($detalle["mdet_mov_id"]) ?></span>
                        </td>
                        <td class="text-center">
                            <span class="badge <?= $badge_class ?> rounded-pill">
                                <?= htmlspecialchars($tipo_movimiento) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="text-heading fw-medium"><?= fecha($venta["mov_fecha"]) ?></span>
                        </td>
                        <td class="text-center">
                            <span class="text-heading fw-medium"><?= cantidad($detalle["mdet_cantidad"]) ?></span>
                        </td>
                        <td class="text-center">
                            <span class="text-heading fw-medium"><?= cantidad($detalle["mdet_total"]) ?></span>
                        </td>
                    </tr>
                <?php
                endforeach;
            endforeach;
            ?>

            <?php if ($total_registros === 0) {
                mensaje(
                    "Sin Movimientos",
                    "Aun no hay movimientos",
                    "success",
                    "info-circle",
                    1
                );
            }?>
        </tbody>
        <tfoot>
            <tr class="border-top">
                <td colspan="6" class="text-end fw-bold">Total General:</td>
                <td class="text-center fw-bold"><?= cantidad($total_general) ?></td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="mt-3">
    <small class="text-muted">
        Mostrando <?= $total_registros ?> registro<?= $total_registros !== 1 ? 's' : '' ?>
    </small>
</div>