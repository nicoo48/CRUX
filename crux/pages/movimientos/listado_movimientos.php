<?php
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos los movimientos
unset($filtros);
$filtros["mov_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$filtros["mov_per_id"] = $_SESSION["usuario"]["per_id"];
$mov = select("movimientos", "*", $filtros); 
foreach ($mov["datos"] as $movi) {
    $lista_movimientos[$movi["mov_id"]] = $movi;
}

//obtenemos los productos
unset($filtros);
$filtros["pro_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$filtros["pro_per_id"] = $_SESSION["usuario"]["per_id"];
$pro = select("productos", "*", $filtros);
foreach ($pro["datos"] as $produc) {
    $lista_productos[$produc["pro_id"]] = $produc;
}

//obtenemos los detalles y los agrupamos por movimiento
unset($filtros);
$filtros["mdet_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$detalles = select("movimientos_detalle", "*", $filtros);

// Agrupar detalles por movimiento
$detalles_por_movimiento = [];
foreach ($detalles["datos"] as $detalle) {
    $detalles_por_movimiento[$detalle["mdet_mov_id"]][] = $detalle;
}

if (count($detalles["datos"]) > 0) {
?>
<div class="card">
    <h5 class="card-header" style="display:flex;justify-content:space-between">
        <span>
            <i class="bi bi-list-star"></i>
            Listado de Transacciones
        </span>
        <span>
            <i class="bi bi-calendar"></i>
            Fecha: <?= fecha(date("Y-m-d H:i:s")) ?>
        </span>
        <span>
            <i class="bi bi-shop"></i>
            Tienda: <?= $_SESSION["tienda"]["tnd_nombre"] ?>
        </span>
    </h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="1">Fecha</th>
                        <th>Producto</th>
                        <th width="1">Cantidad</th>
                        <th width="1">Precio</th>
                        <th width="1">Total</th>
                        <th width="130">Clase</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    $movimiento_anterior = null;
                    foreach ($detalles["datos"] as $detalle) {
                        $movimiento = $lista_movimientos[$detalle["mdet_mov_id"]];
                        $producto = $lista_productos[$detalle["mdet_pro_id"]];
                        $total_detalles = count($detalles_por_movimiento[$detalle["mdet_mov_id"]]);
                        
                        // Si es un nuevo movimiento o el primer registro
                        $es_nuevo_movimiento = $movimiento_anterior !== $detalle["mdet_mov_id"];
                        
                        if ($es_nuevo_movimiento) {
                            $movimiento_anterior = $detalle["mdet_mov_id"];
                        }
                    ?>
                        <tr class="<?= $es_nuevo_movimiento ? '' : 'table-light' ?>">
                            <?php if ($es_nuevo_movimiento): ?>
                                <td rowspan="<?= $total_detalles ?>"><?= fecha($movimiento["mov_fecha"]); ?></td>
                            <?php endif; ?>
                            <td>
                                <?= $producto["pro_nombre"] ?>
                                <?php if ($es_nuevo_movimiento && $total_detalles > 1): ?>
                                    <span class="badge bg-info">+<?= $total_detalles - 1 ?> productos más</span>
                                <?php endif; ?>
                            </td>
                            <td><?= cantidad($detalle["mdet_cantidad"]) ?></td>
                            <td><?= cantidad($detalle["mdet_valor_unitario"]) ?></td>
                            <td><?= cantidad($detalle["mdet_total"]) ?></td>
                            <?php if ($es_nuevo_movimiento): ?>
                                <td rowspan="<?= $total_detalles ?>">
                                    <?php
                                    switch ($detalle["mdet_clase"]) {
                                        case 'VNT':
                                            echo "<i class='bi bi-currency-dollar text-success'>Venta</i>";
                                            break;
                                        case 'MRM':
                                            echo "<i class='bi bi-recycle text-warning'>&nbsp;Merma</i>";
                                            break;
                                        case 'COM':
                                            echo "<i class='bi bi-bag-plus text-success'>&nbsp;Compra</i>";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td rowspan="<?= $total_detalles ?>"><?= $detalle["mdet_glosa"] ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
} else {
    mensaje("Sin Movimientos", "No se han encontrado movimientos en esta tienda", "primary", "info-circle", 1);
}
?>