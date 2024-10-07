<?
$nivel_directorio = "../../../";
require "../../../carga.php";
?>
<div id="operacion">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th colspan=2>Crear Tienda</th>
            </tr>
        <tbody>
            <tr>
                <td width=1>Nombre</td>
                <td>
                    <input type="text" name="nombre" id="nombre" class="form-control campos" placeholder="Donde Los Locos Adams">
                </td>
            </tr>
            <tr>
                <td>Dirección</td>
                <td>
                    <input type="text" name="direccion" id="direccion" class="form-control campos" placeholder="Avenida Siempre Viva #742">
                </td>
            </tr>
        </tbody>
    </table>
    <?
    boton("Volver","arrow-left-circle","outline-primary","cargar_pagina('tiendas.php','tienda')");
    boton("Crear","check-lg","outline-success","crearTienda()");
    ?>
</div>
<script>
    function crearTienda() {
        if (!validar_input("nombre", "Debe ingresar un nombre para la tienda.")) {return;}
        if (!validar_input("direccion", "Debe ingresar una dirección para la tienda.")) {return;}

        var campos = $(".campos").serialize();
        var div = document.getElementById("operacion");
        AJAXPOST(urlBase + "pages/tienda/tiendas/guardar.php", campos, div);
    }
</script>