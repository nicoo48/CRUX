<?
$nivel_directorio = "../../../";
require "../../../carga.php";
$unidad_medida = select("unidad_medida", "*");
$u = $unidad_medida["datos"][0];
?>
<div id="operacion">
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Crear Unidad</h5>
            <small class="text-body float-end"><i class="bi bi-star">Campos Obligatorios</i></small>
        </div>
        <div class="card-body">
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" name="nombre" id="nombre" class="form-control campos"value="<?= $u["uni_nombre"]?>">
                <label for="basic-default-fullname"><i class="bi bi-star"></i>&nbsp;Nombre</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
                <input type="text" name="codigo" id="codigo" class="form-control campos"value="<?= $u["uni_codigo"]?>">
                <label for="basic-default-fullname"><i class="bi bi-star"></i>&nbsp;Código</label>
            </div>
            <?
            boton("Volver", "arrow-left-circle", "outline-primary",'cargar_pagina("unidades.php","tienda")');
            boton("Crear", "check-lg", "outline-success", "editarUnidad()");
            ?>
        </div>
    </div>
</div>

<script>
    function editarUnidad() {
        if (!validar_input("codigo", "Debe ingresar una código para la tienda.")) {return;}
        if (!validar_input("nombre", "Debe ingresar un nombre para la tienda.")) {return;}
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
        AJAXPOST(urlBase + "pages/tienda/unidades/guardar_editar.php", campos, div);
    }
</script>