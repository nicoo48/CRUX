<?php
$nivel_directorio = "../../../";
require "../../../carga.php";

// Obtenemos todas las tiendas del usuario
$filtros["per_id"] = $_SESSION['usuario']['per_id'];
$persona = select("personas", "*", $filtros);
$datos_persona = $persona['datos'][0];

if ($persona > 0) {
?>
<div id="operacion">
    <table class="table table-hover table-bordered" style="margin: auto; width: 50%;">
        <thead>
            <tr>
                <th colspan=2 style="text-align: center;">Editar Usuario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <img id="imgPerfil" src="path_to_image/foto_perfil_<?php echo $datos_persona['per_id']; ?>.png" alt="Foto de perfil" 
                        style="width: 150px; height: 150px; border-radius: 75px; border: 2px solid #ccc; object-fit: cover; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                    <input type="hidden" id="url_imagen" name="url_imagen" class="campos" value="path_to_image/foto_perfil_<?php echo $datos_persona['per_id']; ?>.png">
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Nombre</td>
                <td>  
                    <input type="text" name="usuario" id="usuario" class="form-control campos" value="<?= $datos_persona['per_usuario'] ?>">
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Contraseña</td>
                <td>
                    <input type="text" name="clave" id="clave" class="form-control campos" value="<?= isset($datos_persona['per_clave']) ? $datos_persona['per_clave'] : '' ?>">
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Foto de Perfil</td>
                <td>
                    <input type="file" name="foto_perfil" id="foto_perfil" class="form-control campos" onchange="mostrarImagen(event)">
                </td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 20px; width: 50%; margin-left: auto; margin-right: auto;">
        <?
        boton(
            "Editar Usuario",
            "pencil",
            "outline-success",
            "editar_usuario()"
        )
        ?>
    </div>
</div>
<div id="mensaje" style="display:none;">sadfdasdas</div> 
<?php
} else {
    mensaje(
        "Hubo un error al encontrar al usuario",
        "No se encontró al usuario de la cuenta, contacte a un administrador",
        "warning"
    );
}
?>


<script>
    function mostrarImagen(event) {
        var output = document.getElementById('imgPerfil');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    }

    function editar_usuario() {
        // Validar entradas de usuario
        $("#operacion").hide();
        $("#mensaje").show();
        if (!validar_input("usuario", "Debe ingresar un nombre para la tienda.")) {return;}
        if (!validar_input("clave", "Debe ingresar una dirección para la tienda.")) {return;}
        var campos = $(".campos").serialize();
        // Realiza la llamada AJAX
        AJAXPOST(urlBase + "pages/configuracion/usuario/guardar_usuario.php",campos,document.getElementById("operacion"));
    }
</script>