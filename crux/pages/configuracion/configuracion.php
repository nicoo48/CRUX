<?php
$nivel_directorio = "../../";
require "../../carga.php";
$usuario = $_SESSION['usuario'];
?>
<div id="operacion" class="d-flex justify-content-between">
    <div class="card mb-4" style="width:29%;">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-card-image"></i>&nbsp;Foto de Perfil</h5>
        </div>
        <div class="card-body" style="display:flex;align-items:center;flex-direction:column;">
            <img id="preview" src="<?= $usuario["per_imagen"] ?>" alt="" width="300" height="300" style="border-radius:15px;"><br>
            <input type="file" name="imagen" id="imagen" class="form-control campos" accept="image/*">
        </div>
    </div>
    <div class="card mb-4" style="width:69%">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person"></i>&nbsp;Datos Personales</h5>
            <small class="text-body float-end"><i class="bi bi-star"></i>&nbsp;Campos Obligatorios</small>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" name="nombre" id="nombre" class="form-control campos" placeholder="Peter" value="<?= $usuario['per_nombre'] ?>">
                        <label for="nombre"><i class="bi bi-star-fill text-success"></i>&nbsp;Nombre</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" name="apellidos" id="apellidos" class="form-control campos" placeholder="Parker" value="<?= $usuario["per_apellidos"] ?>">
                        <label for="apellidos">Apellidos</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="email" name="correo" id="correo" class="form-control campos" placeholder="Contacto@cruxApp.cl" value="<?= $usuario["per_correo"] ?>">
                        <label for="correo">Correo Electrónico</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="tel" name="telefono" id="telefono" class="form-control campos" placeholder="+56 9 1234 5678" value="<?= $usuario["per_telefono"] ?>">
                        <label for="telefono">Teléfono</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-lock-fill"></i>&nbsp;Actualizar Contraseña</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div>
                    <div class="form-floating form-floating-outline">
                        <input type="password" name="act_clave" id="act_clave" class="form-control campos" placeholder="*****">
                        <label for="act_clave"><i class="bi bi-star-fill text-success"></i>&nbsp;Contraseña Actual</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="password" name="nue_clave" id="nue_clave" class="form-control campos" placeholder="*****">
                        <label for="nue_clave">Nueva Contraseña</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="password" name="re_clave" id="re_clave" class="form-control campos" placeholder="*****">
                        <label for="re_clave">Repetir Contrasñea</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="respuesta"></div>
<div id="div_boton">
    <?
    boton("Guardar Cambios", "save", "success", "guardar_configuracion()");
    ?>
</div>

<script>
    function guardar_configuracion() {
        
        // Validar los campos obligatorios
        if (!validar_input("nombre", "Debe ingresar un nombre")) {return;}
        if (!validar_input("act_clave", "Debe ingresar su contraseña actual")) {return;}
        
        // Validar formato del correo electrónico
        if (!validar_email("correo", "Debe ingresar un correo electrónico válido")) {return;}
        
        // Validar formato del teléfono
        if (!validar_telefono("telefono", "Debe ingresar un número de teléfono válido")) {return;}
        
        // Validar si se ingresó una nueva contraseña
        if ($("#nue_clave").val() !== "") {
            // Validar la seguridad de la nueva contraseña
            if (!validar_contrasenia("nue_clave")) {alerta("La nueva contraseña no cumple con los requisitos de seguridad", "error");return;}

            // Validar que las contraseñas coincidan
            if ($("#nue_clave").val() !== $("#re_clave").val()){
                mostrar_error("re_clave", "Las contraseñas no coinciden");
                focus("nue_clave");
                return;
            } else {
                limpiar_error("re_clave");
            }
        }
        
        // Crear un objeto FormData
        var formData = new FormData();

        // Agregar los campos y archivos
        $(".campos").each(function() {
            var input = $(this);
            if (input.attr('type') === 'file') {
                formData.append(input.attr('name'), input[0].files[0]);
            } else {
                formData.append(input.attr('name'), input.val());
            }
        });

        // Realizar la petición AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", urlBase + "pages/configuracion/usuario/guardar.php", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Insertar el contenido en el div
                var div = document.getElementById("respuesta");
                div.innerHTML = xhr.responseText;

                // Extraer y ejecutar el script devuelto
                var scripts = div.getElementsByTagName('script');
                for (var i = 0; i < scripts.length; i++) {
                    eval(scripts[i].text);
                }

                // Mostrar la animación de carga y restaurar el cursor
                document.body.style.cursor = "auto";
            } else {
                console.log("Error en la solicitud: " + xhr.status);
            }
        };

        // Mostrar la animación de carga
        document.body.style.cursor = "wait";

        // Enviar el formulario
        xhr.send(formData);
    }

    $(document).ready(function() {
        // Validar correo electrónico
        $("#correo").on("input", function() {
            validar_email("correo", "Debe ingresar un correo electrónico válido");
        });
        // Validar teléfono
        $("#telefono").on("input", function() {
            validar_telefono("telefono", "Debe ingresar un número de teléfono válido");
        });

        // Validar nueva contraseña con semáforo
        $("#nue_clave").on("input", function() {
            validar_contrasenia("nue_clave");
        });

        // Validar repetición de contraseña
        $("#re_clave").on("input", function() {
            if ($("#nue_clave").val() !== $("#re_clave").val()) {
                mostrar_error("re_clave", "Las contraseñas no coinciden");
            } else {
                limpiar_error("re_clave");
            }
        });
    });

    document.getElementById('imagen').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var imagePreview = document.getElementById('preview');

        // Lista de tipos MIME permitidos
        var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (file && allowedTypes.includes(file.type)) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        } else {
            alerta("El archivo no esta en un formato permitido.", "error")
            $("#imagen").val("")
        }
    });
</script>