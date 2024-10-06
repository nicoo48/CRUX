<?php
$nivel_directorio = "../../../";
require "../../../carga.php";

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
                        <?php
                        // Verificar si hay una imagen en la base de datos
                        $imagenPerfil = $datos_persona['per_imagen'];

                        // Verificar si no hay imagen y buscar en la carpeta de iconos
                        if (empty($imagenPerfil) || !filter_var($imagenPerfil, FILTER_VALIDATE_URL)) {
                            // Aquí puedes definir el nombre del archivo que buscas
                            $nombreIcono = "default_icon.png"; // Cambia esto por el nombre que necesites
                            $rutaIcono = $nivel_directorio . "template/assets/img/avatars/" . $nombreIcono;

                            // Verificar si el icono existe en la carpeta
                            if (file_exists($rutaIcono)) {
                                $imagenPerfil = $rutaIcono; // Asignar la ruta del icono
                            } else {
                                // Si tampoco existe, puedes asignar una imagen por defecto
                                $imagenPerfil = "template/assets/img/avatars/".$datos_persona['per_imagen']; // Cambia esto por el nombre de tu imagen por defecto
                            }
                        }
                        ?>

                        <img id="imgPerfil" src="<?= $imagenPerfil ?>" alt="Foto de perfil"
                            style="width: 150px; height: 150px; border-radius: 75px; border: 2px solid #ccc; object-fit: cover; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                        <input type="hidden" id="url_imagen" name="url_imagen" class="campos" value="<?= $imagenPerfil ?>">
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
                <tr>
                    <td style="text-align: right;">URL de Imagen</td>
                    <td>
                        <div class="input-group">
                            <input type="text" name="url_imagen_text" id="url_imagen_text" class="form-control" placeholder="Ingresar URL de imagen">
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#selectImageModal">
                                Seleccionar Icono
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 20px; width: 50%; margin-left: auto; margin-right: auto;">
            <?php
            boton(
                "Editar Usuario",
                "pencil",
                "outline-success",
                "editar_usuario()"
            );
            ?>
        </div>
    </div>
    <div id="mensaje" style="display:none;"></div>

    <!-- Modal de selección de imagen -->
    <div class="modal fade" id="selectImageModal" tabindex="-1" aria-labelledby="selectImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectImageModalLabel">Seleccionar Imagen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                        $imagenes = glob($nivel_directorio . "template/assets/img/avatars/*.png");

                        foreach ($imagenes as $imagen) {
                            $ruta = str_replace($nivel_directorio, '', $imagen);
                            echo '
                            <div class="col-md-3 text-center">
                                <img src="' . $ruta . '" alt="Avatar" class="img-thumbnail" style="width: 100px; height: 100px; cursor: pointer;" onclick="seleccionarImagen(\'' . $ruta . '\')">
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    // Función para mostrar imagen seleccionada del dispositivo
    function mostrarImagen(event) {
        var output = document.getElementById('imgPerfil');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src); // libera el objeto URL
        }

        // Actualizamos el input hidden con la imagen del dispositivo
        document.getElementById('url_imagen').value = event.target.files[0].name;
    }

    // Selección de imagen local del modal
    function seleccionarImagen(ruta) {
        document.getElementById('imgPerfil').src = urlBase + ruta;
        document.getElementById('url_imagen').value = urlBase + ruta;

        var modal = bootstrap.Modal.getInstance(document.getElementById('selectImageModal'));
        modal.hide();
    }

    // Cuando se ingresa manualmente una URL
    document.getElementById('url_imagen_text').addEventListener('input', function() {
        const url = this.value;
        if (validarUrl(url)) {
            document.getElementById('imgPerfil').src = url;
            document.getElementById('url_imagen').value = url;
        }
    });

    function validarUrl(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?' +
            '((([a-zA-Z0-9\\-]+\\.)+[a-zA-Z]{2,})|' +
            '((\\d{1,3}\\.){3}\\d{1,3}))' +
            '(\\:\\d+)?(\\/[-a-zA-Z0-9%_.~+]*)*' +
            '(\\?[;&a-zA-Z0-9%_.~+=-]*)?' +
            '(\\#[-a-zA-Z0-9_]*)?$', 'i');
        return !!pattern.test(str);
    }

    function editar_usuario() {
        if (!validar_input("usuario", "Debe ingresar un nombre para el usuario.")) {
            return;
        }
        if (!validar_input("clave", "Debe ingresar una contraseña para el usuario.")) {
            return;
        }
        $("#operacion").hide();
        $("#mensaje").show();

        // Crear un objeto FormData
        var formData = new FormData();

        // Agregar los campos del formulario
        var campos = $(".campos");
        for (let i = 0; i < campos.length; i++) {
            var campo = campos[i];
            formData.append(campo.name, campo.value);
        }

        // Agregar el archivo de imagen si existe
        var fotoPerfil = document.getElementById("foto_perfil").files[0];
        if (fotoPerfil) {
            formData.append("foto_perfil", fotoPerfil);
        }

        // Realizar la solicitud AJAX
        $.ajax({
            url: urlBase + "pages/configuracion/usuario/guardar_usuario.php",
            type: "POST",
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el tipo de contenido
            success: function(response) {
                // Manejo de respuesta
                $("#mensaje").html(response);
            },
            error: function(xhr, status, error) {
                // Manejo de error
                $("#mensaje").html("Error al guardar los datos.");
            }
        });
    }
</script>