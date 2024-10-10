<?php
$nivel_directorio = "../../";
require "../../carga.php";

$filtros["tnd_id"] = 1; // Forzar la tienda 1
$productos = select("productos", "*", $filtros);

if (count($productos['datos']) > 0) {
    // Si hay productos, mostrar tabla
    ?>
    <table>
        <?
        boton(
            "Crear Producto",
            "plus-circle",
            "outline-info",
            "crearProducto()"
        );
        ?>
    </table>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center;">Nombre</th>
                    <th>Descripción</th>
                    <th style="text-align: center;">Precio</th>
                    <th style="text-align: center;">Unidad de Medida</th>
                    <th style="width: 20%; text-align: center;">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos['datos'] as $producto) { ?>
                    <tr>
                        <td width="1">
                            <?php
                            boton(
                                "", // Texto del botón vacío (solo ícono)
                                "pencil", // Ícono del botón
                                "outline-info", // Estilo del botón
                                "editarProducto(" . $producto['id'] . ")", // Llamada a la función con el ID del producto
                                "Editar"
                            );
                            ?>
                        </td>
                        <td style="text-align: center;"><?php echo $producto["nombre"]; ?></td>
                        <td><?php echo $producto["descripcion"]; ?></td>
                        <td style="text-align: center;"><?php echo "$" . number_format($producto["precio"], 0, ',', '.'); ?> CLP</td> <!-- Formato de moneda chilena -->
                        <td style="text-align: center;"><?php echo $producto["umed"]; ?></td>
                        <td style="text-align: center;">
                            <?php 
                            // Verificar si la imagen es una URL externa, imagen local o base64
                            if (filter_var($producto["imagen"], FILTER_VALIDATE_URL)) {
                                // Es una URL externa
                                ?>
                                <img src="<?php echo $producto["imagen"]; ?>" alt="<?php echo $producto["nombre"]; ?>" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                            <?php } elseif (strpos($producto["imagen"], 'data:image/') === 0) { 
                                // Es una imagen en base64
                                ?>
                                <img src="<?php echo $producto["imagen"]; ?>" alt="<?php echo $producto["nombre"]; ?>" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                            <?php } elseif ($producto["imagen"]) { 
                                // Es una imagen local
                                ?>
                                <img src="<?php echo $nivel_directorio . "template/assets/img/products/" . $producto["imagen"]; ?>" alt="<?php echo $producto["nombre"]; ?>" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                            <?php } else { ?>
                                Sin imagen
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
} else {
    // Si no hay productos, mostrar mensaje y botón
    mensaje(
        "Aquí no hay nada.",
        "Parece que aun no tienes productos registrados, ¿por qué no creas un producto?",
        "info",
        "box-seam-fill",
        1
    );
    boton(
        "Crear Producto",
        "plus-circle",
        "outline-info",
        "crearProducto()"
    );
}
?>
<script>
    function crearProducto() {
        AJAXPOST(urlBase + "pages/tienda/productos/agregar_producto.php", "", document.getElementById("pagina_central"));
    }

    function editarProducto(id) {
        AJAXPOST(urlBase + "pages/tienda/productos/editar_producto.php", "id=" + id, document.getElementById("pagina_central"));
    }
</script>
