<?
$nivel_directorio = "../../../";
require "../../../carga.php";

$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$filtros["tnd_id"] = $_REQUEST["id"];
$tienda  = select("tiendas", "*", $filtros);
$tienda = $tienda["datos"][0];

?>
<div id="operacion">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th colspan=2><b>Editar Tienda</b></th>
            </tr>
        <tbody>
            <tr>
                <td width=1>Nombre</td>
                <td>
                    <input type="text" name="nombre" id="nombre" class="form-control campos" value="<?=$tienda["tnd_nombre"]?>">
                </td>
            </tr>
            <tr>
                <td>Dirección</td>
                <td>
                    <input type="text" name="direccion" id="direccion" class="form-control campos" value="<?=$tienda['tnd_direccion']?>">
                </td>
            </tr>
        </tbody>
    </table>
    <?
    boton("Volver","arrow-left-circle","outline-primary","cargar_pagina('tiendas.php','tienda')");
    boton("Guardar","save","outline-success","guardarEditar($_REQUEST[id])");
    ?>
</div>
<script>
    function guardarEditar(id) {
        if (!validar_input("nombre", "Debe ingresar un nombre para la tienda.")) {
            return;
        }
        if (!validar_input("direccion", "Debe ingresar una dirección para la tienda.")) {
            return;
        }
        var campos = $(".campos").serialize();
        var div = document.getElementById("operacion");
        AJAXPOST(urlBase + "pages/tienda/tiendas/guardar_editar.php?id="+id, campos, div);
    }
</script>