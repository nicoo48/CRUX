<?php
$nivel_directorio = "../../../";
require "../../../carga.php";
$filtros["pro_id"] = $_REQUEST["id"];
$productos = select("productos", "*", $filtros);
$prod = $productos["datos"][0];
?>
<div id="operacion">
    <div class="row">
        <!-- Columna izquierda - Información del Producto -->
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-box-seam"></i>&nbsp;Información del Producto</h5>
                    <small class="text-body float-end"><i class="bi bi-star"></i>&nbsp;Campos Obligatorios</small>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="nombre_producto" id="ecommerce-product-name" class="form-control campos" placeholder="Nombre del producto" value="<?= $prod["pro_nombre"] ?>">
                                <label for="ecommerce-product-name"><i class="bi bi-star-fill text-success"></i>&nbsp;Nombre del producto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="codigo_producto" id="ecommerce-product-sku" class="form-control campos" placeholder="SKU" value="<?= $prod["pro_codigo"] ?>">
                                <label for="ecommerce-product-sku"><i class="bi bi-star-fill text-success"></i>&nbsp;Código (SKU)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" name="codigo_barra" id="ecommerce-product-barcode" class="form-control campos" placeholder="Código de Barra" value="<?= $prod["pro_codigo_barra"] ?>">
                                <label for="ecommerce-product-barcode">Código de Barra</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating form-floating-outline">
                                <input type="number" name="precio" id="ecommerce-product-price" class="form-control campos" placeholder="Precio" value="<?= $prod["pro_precio"] ?>">
                                <label for="ecommerce-product-price"><i class="bi bi-star-fill text-success"></i>&nbsp;Precio del producto</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating form-floating-outline">
                                <?
                                selector([
                                    'campo' => 'unidad',
                                    'tabla' => 'unidad_medida',
                                    'id' => 'uni_id',
                                    'campos' => ['uni_codigo', 'uni_nombre'],
                                    'todos' => 'Seleccione una unidad de medida',
                                    'order_by' => 'uni_id ASC',
                                    'selected' => $prod["pro_unidad"]
                                ]);
                                ?>
                                <label><i class="bi bi-star-fill text-success"></i>&nbsp;Unidad de Medida</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" id="ecommerce-product-descripcion" class="form-control campos" rows="4" placeholder="Descripción del producto"><?= $prod["pro_descripcion"] ?></textarea>
                        </div>
                        <input type="hidden" id="id_producto" name="id_producto" class="campos" value="<?= $prod["pro_id"] ?>">
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
                    <img id="preview" src="<?= !empty($prod["pro_imagen"]) ? $prod["pro_imagen"] : '' ?>" alt="Imagen del producto" width="300" height="300" style="border-radius:15px;object-fit:cover;"><br>
                    <input type="file" name="imagen" id="imagen" class="form-control campos" accept="image/*">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="respuesta"></div>

<div id="div_boton" class="mt-4">
    <?
    boton("Volver", "list", "info", 'cargar_pagina("productos.php","tienda")');
    boton("Guardar Cambios", "save", "success", "guardar_edicion()");
    ?>
</div>

<script>
    function guardar_edicion() {
        // Validar campos obligatorios
        if (!validar_input("ecommerce-product-name", "Debe ingresar un nombre para el producto")) {
            return;
        }
        if (!validar_input("ecommerce-product-sku", "Debe ingresar un código para el producto")) {
            return;
        }
        if (!validar_input("ecommerce-product-price", "Debe ingresar un precio para el producto")) {
            return;
        }
        if (!validar_input("unidad", "Debe seleccionar una unidad de medida")) {
            return;
        }

        var formData = new FormData();

        $(".campos").each(function() {
            var input = $(this);
            if (input.attr('type') === 'file') {
                formData.append(input.attr('name'), input[0].files[0]);
            } else {
                formData.append(input.attr('name'), input.val());
            }
        });

        var xhr = new XMLHttpRequest();
        xhr.open("POST", urlBase + "pages/tienda/productos/editar.php", true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                var div = document.getElementById("respuesta");
                div.innerHTML = xhr.responseText;
                var scripts = div.getElementsByTagName('script');
                for (var i = 0; i < scripts.length; i++) {
                    eval(scripts[i].text);
                }
                document.body.style.cursor = "auto";
            } else {
                console.log("Error en la solicitud: " + xhr.status);
            }
        };

        document.body.style.cursor = "wait";
        xhr.send(formData);
    }

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