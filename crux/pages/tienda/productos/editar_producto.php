<?php
$nivel_directorio = "../../../";
require "../../../carga.php";

// Obtener el ID del producto desde la request
$id_producto = $_POST['id'] ?? null; // Asegúrate que el ID venga por POST o GET

if ($id_producto) {
    // Agregar filtro por ID de producto
    $filtros["id"] = $id_producto;
    $productos = select("productos", "*", $filtros);

    // Verificar si se encontró el producto
    if (count($productos['datos']) > 0) {
        // Asignar el producto a una variable para más claridad
        $producto = $productos['datos'][0];
    } else {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no especificado.";
    exit;
}
?>

<div id="operacion">
    <input type="hidden" name="id" id="id" class="campos" value="<? echo $id_producto; ?>">
    <!-- Tabs nav -->
    <ul class="nav nav-tabs" id="productoTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="infoProducto-tab" data-bs-toggle="tab" href="#infoProducto" role="tab" aria-controls="infoProducto" aria-selected="true">Información de Producto</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="infoExtra-tab" data-bs-toggle="tab" href="#infoExtra" role="tab" aria-controls="infoExtra" aria-selected="false">Información Extra</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="imagenProducto-tab" data-bs-toggle="tab" href="#imagenProducto" role="tab" aria-controls="imagenProducto" aria-selected="false">Imagen del Producto</a>
        </li>
    </ul>

    <!-- Tabs content -->
    <div class="tab-content" id="productoTabsContent">
        <!-- Información de Producto -->
        <div class="tab-pane fade show active" id="infoProducto" role="tabpanel" aria-labelledby="infoProducto-tab">
            <table class="table table-hover table-bordered" width="100%">
                <thead>
                    <tr>
                        <th colspan=2 style="text-align: center;">Información de Producto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right;">Nombre</td>
                        <td><input type="text" name="nombre" id="nombre" class="form-control campos" value="<?php echo $producto['nombre']; ?>"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Descripción</td>
                        <td><input type="text" name="Descripcion" id="Descripcion" class="form-control campos" value="<?php echo $producto['descripcion']; ?>"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Tienda</td>
                        <td>
                            <select name="tienda" id="tienda" class="form-control campos">
                                <option value="">Seleccione una tienda</option>
                                <option value="1" <?php echo ($producto['tienda'] == 1) ? 'selected' : ''; ?>>Tienda 1</option>
                                <option value="2" <?php echo ($producto['tienda'] == 2) ? 'selected' : ''; ?>>Tienda 2</option>
                                <option value="3" <?php echo ($producto['tienda'] == 3) ? 'selected' : ''; ?>>Tienda 3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">U. Medida</td>
                        <td>
                            <select name="umed" id="umed" class="form-control campos">
                                <option value="">Seleccione Unidad de medida</option>
                                <option value="u1" <?php echo ($producto['umed'] == 'u1') ? 'selected' : ''; ?>>CM</option>
                                <option value="u2" <?php echo ($producto['umed'] == 'u2') ? 'selected' : ''; ?>>KM</option>
                                <option value="u3" <?php echo ($producto['umed'] == 'u3') ? 'selected' : ''; ?>>ETC</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Información Extra -->
        <div class="tab-pane fade" id="infoExtra" role="tabpanel" aria-labelledby="infoExtra-tab">
            <table class="table table-hover table-bordered" width="100%">
                <thead>
                    <tr>
                        <th colspan=2 style="text-align: center;">Información Extra</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right;">Costo</td>
                        <td><input type="number" name="costo" id="costo" class="form-control campos" value="<?php echo $producto['precio']; ?>"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Ancho</td>
                        <td><input type="text" name="ancho" id="ancho" class="form-control campos" value="<?php echo $producto['ancho']; ?>"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Largo</td>
                        <td><input type="text" name="largo" id="largo" class="form-control campos" value="<?php echo $producto['largo']; ?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Imagen del Producto -->
        <div class="tab-pane fade" id="imagenProducto" role="tabpanel" aria-labelledby="imagenProducto-tab">
            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 15px;">
                <img id="imgPerfil" src="<?php echo $producto['imagen']; ?>" alt="Vista previa de imagen" style="max-width: 400px; max-height: 400px; border: 1px solid #ddd; padding: 5px; <?php echo ($producto['imagen']) ? '' : 'display: none;'; ?>">
            </div>
            <table class="table table-hover table-bordered" width="100%">
                <thead>
                    <tr>
                        <th colspan=2 style="text-align: center;">Imagen del Producto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right;">Cargar desde dispositivo</td>
                        <td><input type="file" name="imagenDispositivo" id="imagenDispositivo" class="form-control campos" accept="image/*" onchange="mostrarImagen(event)"></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Cargar desde URL</td>
                        <td><input type="text" name="imagenURL" id="imagenURL" class="form-control campos" value="<?php echo $producto['imagen']; ?>" oninput="mostrarImagenDesdeURL()"></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div style="margin-top: 20px; text-align: left;">
        <?php
        boton(
            "Guardar",
            "save",
            "outline-info",
            "guardarProducto()"
        );
        ?>
    </div>
</div>

<div id="mensaje" style="display:none;"></div>

<script>
    function mostrarImagen(event) {
        var output = document.getElementById('imgPerfil');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.style.display = 'block';
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
    }

    function mostrarImagenDesdeURL() {
        var url = document.getElementById('imagenURL').value;
        var output = document.getElementById('imgPerfil');
        if (url) {
            output.src = url;
            output.style.display = 'block';
        } else {
            output.style.display = 'none';
        }
    }

    function guardarProducto() {
        // Validar entradas de usuario
        if (!validar_input("nombre", "Debe ingresar un nombre de producto.")) {
            return;
        }
        if (!validar_input("tienda", "Debe ingresar una tienda.")) {
            return;
        }
        if (!validar_input("umed", "Debe ingresar una unidad de medida.")) {
            return;
        }
        var a = $(".campos").serialize();
        $("#operacion").hide();
        $("#mensaje").show();
        // Realiza la llamada AJAX para actualizar el producto
        AJAXPOST(urlBase + "pages/tienda/productos/guardar_producto.php",a+"&modo=editar", document.getElementById("operacion"));
    }
</script>
