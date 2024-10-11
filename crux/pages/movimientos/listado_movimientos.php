<?php
$nivel_directorio = "../../";
require "../../carga.php";
//Consultar a la base de datos
$movimientos = select("movimientos", "*");
$detalles = select("movimientos_detalle", "*");
unset($filtros);
$arreglo_datos = select("productos","*"); 
foreach($arreglo_datos["datos"] as $row_info){
    $_productos[$row_info["pro_codigo"]] = $row_info;
}
?>

<div class="card">
    <h5 class="card-header">Listado de Movimientos</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="1">Folio</th>
                    <th width="1">Detalle</th>
                    <th width="90">Tipo</th>
                    <th width="90">Clase</th>
                    <th width="180">Responsable</th>
                    <th>Glosa</th>
                    <th width="180">Fecha</th>
                    <th width="90">acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php foreach ($movimientos["datos"] as $mov) { ?>
                    <tr id="mov_<?= $mov["mov_id"] ?>">
                        <td><span class="fw-medium"><?= $mov["mov_id"] ?></span></td>
                        <td><?php boton("", "box", "outline-info", "detalle(" . $mov["mov_id"] . ")");?></td>
                        <td><?= $mov["mov_tipo"] ?></td>
                        <td><?= $mov["mov_clase"] ?></td>
                        <td><?= $mov["mov_responsable"] ?></td>
                        <td><?= $mov["mov_glosa"] ?></td>
                        <td><?= $mov["mov_fecha"] ?></td>
                        <td style="display:flex">
                            <?php
                            boton("", "pencil", "outline-success", "editarmov(" . $mov["mov_id"] . ")");
                            boton("", "trash", "outline-danger", "eliminarmov(" . $mov["mov_id"] . ")");
                            ?>
                        </td>
                    </tr>
                    <tr id="detalle-<?= $mov["mov_id"] ?>" style="display:none;">
                        <td colspan="8">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1">Folio</th>
                                        <th>Productos</th>
                                        <th width="90">cantidad</th>
                                        <th width="180">total</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php foreach ($detalles["datos"] as $mdet) { 
                                        if ($mdet["mdet_mov_id"] == $mov["mov_id"]) { ?>
                                            <tr>
                                                <td><span class="fw-medium"><?= $mdet["mdet_id"] ?></span></td>
                                                <td><?= $_productos[$mdet["mdet_producto"]]["pro_nombre"] ?></td>
                                                <td><?= $mdet["mdet_cantidad"] ?></td>
                                                <td><?= $mdet["mdet_total"] ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function detalle(id) {
        var detalleRow = document.getElementById('detalle-' + id);
        if (detalleRow.style.display === "none") {
            detalleRow.style.display = "table-row";
        } else {
            detalleRow.style.display = "none";
        }
    }
    function editarmov(id) {
        var id_mov = document.getElementById('mov_' + id);
        AJAXPOST(urlBase + "pages/movimientos/editar_movimiento.php", "id=" + id, document.getElementById("pagina_central"));
        // Abrir el modal
        var myModal = new bootstrap.Modal(document.getElementById('editarMovimientoModal'));
        myModal.show();
    }
    function editarmov(id){
        var id_mov = document.getElementById('mov_' + id);
        AJAXPOST(url_base+"pages/movimientos/editar_movimiento.php","id=" + id,document.getElementById("pagina_central"),false,function(){	
            $('#editarMovimientoModal').modal('show');
        });
    }
</script>