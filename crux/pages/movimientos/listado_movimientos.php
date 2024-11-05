<?
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
//obtenemos los detalles
unset($filtros);
$filtros["mdet_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$detalles = select("movimientos_detalle", "*", $filtros);
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
                    <?
                    foreach ($detalles["datos"] as $detalle) {
                        $movimiento = $lista_movimientos[$detalle["mdet_mov_id"]];
                        $producto = $lista_productos[$detalle["mdet_pro_id"]];

                    ?>
                        <tr>
                            <td><?= fecha($movimiento["mov_fecha"]); ?></td>
                            <td><?= $producto["pro_nombre"] ?></td>
                            <td><?= cantidad($detalle["mdet_cantidad"]) ?></td>
                            <td><?= cantidad($detalle["mdet_valor_unitario"]) ?></td>
                            <td><?= cantidad($detalle["mdet_total"]) ?></td>
                            <td>
                                <?
                                //ir agregando mas mientras mas clases salgan en el camino
                                switch ($detalle["mdet_clase"]) {
                                    case 'VNT':echo "<i class='bi bi-currency-dollar text-success'>Venta</i>";break;
                                    case 'MRM':echo "<i class='bi bi-recycle text-warning'>&nbsp;Merma</i>";break;
                                    case 'COM': echo "<i class='bi bi-bag-plus text-success'>&nbsp;Compra</i>";break;
                                }
                                ?>
                            </td>
                            <td><?= $detalle["mdet_glosa"] ?></td>
                        </tr>
                    <?
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?
}else{
    mensaje("Sin Movimientos", "No se han encontrado movimientos en esta tienda", "primary", "info-circle", 1);
}
