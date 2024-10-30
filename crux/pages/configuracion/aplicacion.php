<?
$nivel_directorio = "../../";
require "../../carga.php";
?>
<div class="card mb-6">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Configuración de Usuario</h5>
    </div>
    <div class="card-body">
        <div class="form-check mb-6">
            <input
                class="form-check-input campos"
                type="checkbox"
                id="sistema_fifo"
                name="sistema_fifo"
                value="1"
                <?= $configuracion["sistema_fifo"]["cfg_valor"] ? "checked" : "" ?>>
            <label class="form-check-label" for="sistema_fifo">
                Utilizar Sistema FIFO
                <br>
                <small class="text-muted fw-normal">Los productos más antiguos se venden primero, usando su precio de compra para calcular margenes.</small>
            </label>
        </div>
        <div class="form-check mb-6">
            <input
                class="form-check-input campos"
                type="checkbox"
                id="tienda_iniciar"
                name="tienda_iniciar"
                value="1"
                onchange="check_activar()"
                <?= $configuracion["tienda_iniciar"]["cfg_valor"] ? "checked" : "" ?>>

            <label class="form-check-label" for="tienda_iniciar">
                Elegir Tienda Al iniciar
                <br>
                <small class="text-muted fw-normal">Si esta opción esta activada se utilizara la tienda definida para todas las operaciones </small>
            </label>
        </div>
        <div class="form-floating form-floating-outline mb-6">
            <?
            selector(
                [
                    'campo' => 'tienda_defecto',
                    'tabla' => 'tiendas',
                    'id' => 'tnd_id',
                    'campos' => ['tnd_nombre'],
                    'order_by' => 'tnd_id ASC',
                    'selected' => $configuracion["tienda_defecto"]["cfg_valor"]
                ]
            );
            ?>
            <label for="basic-default-fullname"><i class="bi bi-shop"></i>&nbsp;Tienda Por Defecto</label>
        </div>
        <?
        boton("Guardar Configuración", "save", "success", "guardar_configuracion()");
        ?>
    </div>
</div>
<div id="operacion"></div>
<script>
    function guardar_configuracion() {
        var div = document.getElementById("operacion");
        var aux = "";
        // Asegurar que los checkbox no marcados envíen 0
        $('.campos[type="checkbox"]').each(function() {
            if (!this.checked) {
                aux = aux + $(this).attr('name') + "=0&";
            }
        });
        var a = $(".campos").serialize();
        a = a + "&" + aux;
        AJAXPOST(urlBase + "/pages/configuracion/aplicacion/guardar.php", a, div);
    }

    function check_activar() {
        var selector_tienda = document.querySelector('[name="tienda_defecto"]');
        selector_tienda.disabled = !document.getElementById('tienda_iniciar').checked;
    }
    check_activar();
</script>