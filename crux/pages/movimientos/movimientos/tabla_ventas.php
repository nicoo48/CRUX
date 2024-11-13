<div class="card-body pb-1 pt-0">
    <?
    if (!empty($lista_ventas)) {
    ?>
        <div class="table-responsive text-nowrap border-top">
            <table class="table">
                <thead class="table-border-bottom-0">
                    <tr>
                        <th>Producto</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?
                    foreach ($lista_ventas as $venta) {
                        foreach ($venta["detalles"] as $detalle) {
                            $producto = $lista_productos[$detalle["mdet_pro_id"]];
                    ?>
                            <tr>
                                <td>
                                    <span class="text-heading"><?= $producto["pro_nombre"] ?></span>
                                </td>
                                <td>
                                    <span class="text-heading fw-medium"><?= fecha($venta["mov_fecha"]) ?></span>
                                </td>
                                <td>
                                    <span class="text-heading fw-medium "><?= cantidad($detalle["mdet_cantidad"]) ?></span>
                                </td>
                                <td>
                                    <span class="text-heading fw-medium"><?= cantidad($detalle["mdet_total"]) ?></span>
                                </td>
                            </tr>
                    <?
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?
    } else {
        mensaje(
            "Sin Compras",
            "Aun no hay movimientos",
            "primary",
            "info-circle",
            1
        );
    }
    ?>
</div>