<?php
$nivel_directorio = "../../../";
require "../../../carga.php";
$filtros["pro_id"] = $_REQUEST["id"];
$producto = select("productos", "*", $filtros);
$producto = $producto["datos"][0];
?>
<input type="hidden" value="<?=$producto["pro_id"]?>" class="campos" name="id_producto">
<div id="crear">
    <div class="row">
        <!-- Columna izquierda - Información del Producto y Precio -->
        <div class="col-12 col-lg-8">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-box"></i>&nbsp;Editar Producto: <b><?=$producto["pro_nombre"]?></b></h5>
                    <small class="text-body float-end"><i class="bi bi-star">Campos Obligatorios</i></small>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="text" value="<?=$producto["pro_nombre"]?>" class="form-control campos" id="nombre_producto" placeholder="Product title" name="nombre_producto">
                        <label for="nombre_producto"><i class="bi bi-star"></i>&nbsp;Nombre del producto</label>
                    </div>

                    <div class="row mb-5 gx-5">
                        <div class="col">
                            <div class="form-floating form-floating-outline">
                                <input type="number" value="<?=$producto["pro_codigo"]?>" class="form-control campos" id="codigo_producto" placeholder="00000" name="codigo_producto">
                                <label for="codigo_producto"><i class="bi bi-star"></i>&nbsp;Código</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating form-floating-outline">
                                <input type="text" value="<?=$producto["pro_codigo_barra"]?>" class="form-control campos" id="ecommerce-product-barcode" placeholder="0123-4567" name="codigo_barra">
                                <label for="ecommerce-product-barcode">Código de Barra</label>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-floating form-floating-outline mb-6">
                        <textarea class="form-control h-px-100 campos   " id="descripcion" name="descripcion" placeholder="Descripción aquí."><?=$producto["pro_descripcion"]?></textarea>
                        <label for="descripcion">Descripción del Producto</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-5">
                        <?
                        selector([
                            'campo' => 'unidad',
                            'tabla' => 'unidad_medida',
                            'id' => 'uni_id',
                            'campos' => ['uni_codigo', 'uni_nombre'],
                            'todos' => 'Seleccione una unidad de medida',
                            'order_by' => 'uni_id ASC',
                            "selected" => $producto["pro_unidad"]
                        ]);
                        ?>
                    </div>
                    <!-- Instock switch (moved here) -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <div>
                            <?
                            boton("Volver", "list", "info", 'cargar_pagina("productos.php","tienda")');
                            boton("Guardar", "save", "primary", "guardar()");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha - Imagen del Producto -->
        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-card-image"></i>&nbsp;Imagen del Producto</h5>
                </div>
                <div class="card-body" style="display:flex;align-items:center;flex-direction:column;">
                    <img id="preview" src="<?=$producto["pro_imagen"]<>""?$producto["pro_imagen"]:$sinImagen?>" alt="Sin imagen" width="300" height="300" style="border-radius:15px;"><br>
                    <input type="file" value="<?=$producto?>" name="imagen" id="imagen" class="form-control campos" accept="image/*">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function guardar() {
        // Validar campos obligatorios
        if (!validar_input("nombre_producto", "Debe ingresar un nombre para el producto")) {
            return;
        }
        if (!validar_input("codigo_producto", "Debe ingresar un código para el producto")) {
            return;
        }
        if (!validar_input("unidad", "Debe seleccionar una unidad de medida")) {
            return;
        }

        // Crear un objeto FormData
        var formData = new FormData();

        // Agregar los campos y archivos al FormData
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
        xhr.open("POST", urlBase + "pages/tienda/productos/ajax/editar.php", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Insertar el contenido en el div
                var div = document.getElementById("crear");
                div.innerHTML = xhr.responseText;

                // Extraer y ejecutar el script devuelto
                var scripts = div.getElementsByTagName('script');
                for (var i = 0; i < scripts.length; i++) {
                    eval(scripts[i].text);
                }

                // Restaurar el cursor
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

    // Event Listeners para el documento listo
    $(document).ready(function() {
        // Aquí puedes agregar cualquier inicialización adicional que necesites
    });

    // Preview de imagen
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
            alerta("El archivo no está en un formato permitido.", "error");
            $("#imagen").val("");
        }
    });
</script>