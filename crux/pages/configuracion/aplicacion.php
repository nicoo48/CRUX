<?
$nivel_directorio = "../../";
require "../../carga.php";
$configuracion["tienda_defecto"];
?>
<div class="card mb-6">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Configuración de Usuario</h5>
        <small class="text-body float-end">
            <i class="bi bi-star"></i>
        </small>
    </div>
    <div class="card-body">
        <div class="form-check mb-6">
            <input 
                class="form-check-input campos" 
                type="checkbox"  
                onchange="check_activar()" 
                id="check_tienda_iniciar"
                <?=$configuracion["tienda_iniciar"]["cfg_valor"]?"checked":""?>>

            <input 
                type="hidden"   
                class="campos" 
                id="tienda_iniciar" 
                name="tienda_iniciar" 
                value="<?=$configuracion["tienda_iniciar"]["cfg_valor"]?>">
            
            <label class="form-check-label" for="defaultCheck1">
                Elegir Tienda Al iniciar 
                <br>
                <small class="text-muted fw-normal">Si esta opción esta activada se utilizara la tienda definida para todas las operaciones </small>
            </label>
        </div>
        <div class="form-floating form-floating-outline mb-6">
            <?
            selector([
                'campo' => 'tienda_defecto',
                'tabla' => 'tiendas',
                'id' => 'tnd_id',
                'campos' => ['tnd_nombre'],
                'order_by' => 'tnd_id ASC',
                'selected' => $configuracion["tienda_defecto"]["cfg_valor"]
                ]
            );
            ?>
            <label for="basic-default-fullname"><i class="bi bi-star"></i>&nbsp;Tienda Por Defecto</label>
        </div>
        <?
        boton("Guardar Configuración", "save", "success", "guardar_configuracion()");
        ?>
    </div>
</div>
<script>
    function check_activar(){
        if($("#check_tienda_iniciar").is(":checked")){
            $("#tienda_defecto").prop("disabled",false);
            $("#tienda_iniciar").val(1);
        }else{
            $("#tienda_iniciar").val(0);
            $("#tienda_defecto").prop("disabled",true);
        }
    }
    function guardar_configuracion(){
        var div = document.getElementById("pagina_central");
        var a = $(".campos").serialize();
        AJAXPOST(urlBase+"/pages/configuracion/aplicacion/guardar.php",a,div);
    }
    check_activar();
</script>



