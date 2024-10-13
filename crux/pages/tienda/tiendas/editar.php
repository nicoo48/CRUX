<?
$nivel_directorio = "../../../";
require "../../../carga.php";

$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$filtros["tnd_id"] = $_REQUEST["id"];
$tienda  = select("tiendas", "*", $filtros);
$tienda = $tienda["datos"][0];

?>
<div id="operacion">
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Tienda</h5>
            <small class="text-body float-end"><i class="bi bi-star">Campos Obligatorios</i></small>
        </div>
        <div class="card-body">
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" name="nombre" id="nombre" class="form-control campos" value="<?=$tienda["tnd_nombre"]?>">
                <label for="basic-default-fullname"><i class="bi bi-star"></i>&nbsp;Nombre</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" name="codigo" id="codigo" class="form-control campos" value="<?=$tienda["tnd_codigo"]?>">
                <label for="basic-default-fullname"><i class="bi bi-star"></i>&nbsp;Codigo</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" name="direccion" id="direccion" class="form-control campos" value="<?=$tienda["tnd_direccion"]?>">
                <label for="basic-default-company"><i class="bi bi-star"></i>&nbsp;Dirección</label>
            </div>
            <?
            boton("Volver", "arrow-left-circle", "outline-primary",'cargar_pagina("tiendas.php","tienda")');
            boton("Editar", "pencil", "outline-warning", "guardarEditar($tienda[tnd_id])");
            ?>
        </div>
    </div>
</div>
<script>
    function guardarEditar(id) {
        if (!validar_input("nombre", "Debe ingresar un nombre para la tienda.")) {return;}        
        if (!validar_input("codigo", "Debe ingresar un código para la tienda.")) {return;}
        if (!validar_input("direccion", "Debe ingresar una dirección para la tienda.")) {return;}
        
        var codigo = document.getElementById("codigo").value;
        if (codigo.length < 3) {
            alerta("El código de la tienda debe tener al menos 3 caracteres.", "warning");
            return;
        }
        if (codigo.length > 6) {
            alerta("El código de la tienda no puede tener más de 6 caracteres.", "warning");
            return;
        }

        var campos = $(".campos").serialize();
        var div = document.getElementById("operacion");
        AJAXPOST(urlBase + "pages/tienda/tiendas/guardar_editar.php?id="+id, campos, div);
    }
</script>