<?
$nivel_directorio = "../../../";
require "../../../carga.php";
?>
<div id="crear">
    <div class="row">
        <!-- Columna izquierda - Información del Producto y Precio -->
        <div class="col-12 col-lg-8">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title mb-0">Información del Producto</h5>
                </div>
                <div class="card-body">
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="text" class="form-control campos" id="ecommerce-product-name" placeholder="Product title" name="nombre_producto" aria-label="Product title">
                        <label for="ecommerce-product-name">Nombre del producto</label>
                    </div>
    
                    <div class="row mb-5 gx-5">
                        <div class="col">
                            <div class="form-floating form-floating-outline">
                                <input type="number" class="form-control campos" id="ecommerce-product-sku" placeholder="00000" name="codigo_producto" aria-label="Product SKU">
                                <label for="ecommerce-product-sku">SKU</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control campos" id="ecommerce-product-barcode" placeholder="0123-4567" name="codigo_barra" aria-label="Product barcode">
                                <label for="ecommerce-product-barcode">Código de Barra</label>
                            </div>
                        </div>
                    </div>
    
                    <!-- Description -->
                    <div class="mb-5">
                        <p class="mb-1">Descripción (Optional)</p>
                        <textarea type="text" class="form-control campos" id="ecommerce-product-descripcion" name="descripcion" aria-label="Product description"></textarea>    
                    </div>
    
                    <!-- Base Price (moved here) -->
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="number" class="form-control campos" id="ecommerce-product-price" placeholder="Price" name="precio" aria-label="Product price" />
                        <label for="ecommerce-product-price">Precio del producto</label>
                    </div>

                    <div class="form-floating form-floating-outline mb-5">
                        <?
                        selector([
                            'campo' => 'unidad',
                            'tabla' => 'unidad_medida',
                            'id' => 'uni_id',
                            'campos' => ['uni_codigo', 'uni_nombre'],
                            'todos' => 'Seleccione una unidad de medida',
                            'order_by' => 'uni_id ASC'
                        ]);
                        ?>
                    </div>
    
                    <!-- Instock switch (moved here) -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <div>
                            <?
                            boton("Volver al listado", "list", "info", "volver()");
                            boton("Guardar", "save", "primary", "guardar()");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Columna derecha - Imagen del Producto -->
        <div class="col-12 col-lg-4">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Imagen del Producto</h5>
                </div>
                <div class="card-body">
                    <form action="/upload" class="dropzone needsclick" id="dropzone-basic">
                        <div class="dz-message needsclick my-12">
                            <div class="d-flex justify-content-center">
                                <div class="avatar">
                                    <span class="avatar-initial rounded-3 bg-label-secondary">
                                        <i class="ri-upload-2-line ri-24px"></i>
                                    </span>
                                </div>
                            </div>
                            <p class="h4 needsclick my-2">Presiona aqui para subir una imagen</p>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function guardar(){
        var campos = $(".campos").serialize();
        console.log(campos);
        AJAXPOST(urlBase + "pages/tienda/productos/ajax/crear.php", campos, document.getElementById("pagina_central"));
    }
    function volver(){
        AJAXPOST(urlBase + "pages/tienda/productos.php", "", document.getElementById("pagina_central"));
    }
</script>