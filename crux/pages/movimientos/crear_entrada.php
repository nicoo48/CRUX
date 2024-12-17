<?php
$nivel_directorio = "../../";
require "../../carga.php";

// Obtener todos los precios de productos
$sql_precios = "SELECT pro_id, pro_precio FROM productos";
$result_precios = mysqli_query($conexion, $sql_precios);
$precios = [];
while ($row = mysqli_fetch_assoc($result_precios)) {
    $precios[$row['pro_id']] = floatval($row['pro_precio']);
}
?>
<script>
// Crear el mapa de precios de productos
const productoPreciosMap = <?= json_encode($precios) ?>;
</script>
<?php
require "entradas/entradas_js.php";
?>

<input type="hidden" id="oculto" name="oculto" class="campos">
<input type="hidden" id="precio" name="precio" class="campos">
<div class="container" id="formulario_completo_salidas">
    <div class="left-column">
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Datos de la Compra</h5>
                <small class="text-body float-end"><i class="bi bi-star">Campos Obligatorios</i></small>
            </div>
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-6">
                    <?php
                    selector([
                        'campo' => 'producto',
                        'tabla' => 'productos',
                        'id' => 'pro_id',
                        'campos' => ['pro_codigo', 'pro_nombre'],
                        'todos' => 'Seleccione un producto',
                        'order_by' => 'pro_codigo ASC',
                        'onchange' => 'if(typeof cargarPrecioProducto === "function") cargarPrecioProducto()'
                    ]);
                    ?>
                    <label for="basic-default-company"><i class="bi bi-star"></i>&nbsp;Producto</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <select name="clase" id="clase" class='form-select form-select-sm campos'>
                        <option value="">Seleccione una clase</option>
                        <option value="COM">Compra</option>
                        <option value="AJU">Ajuste</option>
                    </select>
                    <label for="basic-default-company"><i class="bi bi-star"></i>&nbsp;Clase</label>
                </div>
                <div class="row g-3">
                    <div class="form-floating form-floating-outline col-sm">
                        <input type="number" onchange="calcular_total()" name="cantidad" id="cantidad" class="form-control campos" placeholder="100">
                        <label for="basic-default-company"><i class="bi bi-star"></i>&nbsp;Cant.</label>
                    </div>
                    <div class="form-floating form-floating-outline col-sm">
                        <input type="text" name="precio_display" id="precio_display" class="form-control campos" placeholder="$$$" disabled>
                        <label for="basic-default-company">Precio U.</label>
                    </div>
                    <div class="form-floating form-floating-outline col-sm">
                        <input type="text" name="total" id="total" class="form-control campos" placeholder="100" disabled>
                        <label for="basic-default-company">Total</label>
                    </div>
                </div>
                <br>
                <div class="form-floating form-floating-outline mb-6">
                    <textarea name="comentario" id="comentario" class="form-control campos" style="height: 90px;"></textarea>
                    <label for="basic-default-company">Comentario</label>
                </div>
            </div>
            <div style="margin:10px;display:flex;justify-content:space-between">
                <?php
                boton(
                    "agregar linea",
                    "box",
                    "outline-primary",
                    "agregar_linea();"
                );
                ?>
                <div id="boton_guardar" style="display:none">
                    <?php
                    boton(
                        "Guardar",
                        "save",
                        "success",
                        'preguardar()'
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="right-column">
        <div id="mensaje_sin_items"><?php mensaje("Sin Productos", "Ingresa Algun Producto Para Continuar", "primary", "info-circle", 1); ?></div>
        <table id="tabla-detalle" class="table table-bordered table-hover" style="display:none">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Comentario</th>
                    <th width="1">Clase</th>
                    <th width="1">Cantidad</th>
                    <th>Precio U.</th>
                    <th>Total</th>
                    <th width="1"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<style>
    .center {
        text-align: center;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .left-column {
        width: 35%;
        padding-right: 15px;
    }

    .right-column {
        width: 65%;
        padding-left: 15px;
    }

    #tabla-detalle tbody tr.new-row {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.5s ease, transform 0.8s ease;
    }

    #tabla-detalle tbody tr.new-row.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .row-number {
        font-weight: bold;
        text-align: center;
    }
</style>

<?php
modal(
    "modConfirmar",
    "Confirmar Transacción",
    "¿Estás seguro de que deseas Confirmar la transacción",
    "currency-dollar",
    "l",
    "guardar()"
);

// Debug para verificar los datos (opcional)
echo "<!-- Debug Info: \n";
echo "Precios cargados: " . print_r($precios, true) . "\n";
echo "-->";
?>

<script>
// Verificar que el mapa de precios se haya cargado correctamente
console.log('Mapa de precios cargado:', productoPreciosMap);

// Asegurarse de que el selector tenga el evento change y funcione correctamente
document.addEventListener('DOMContentLoaded', function() {
    const productoSelect = document.getElementById('producto');
    if (productoSelect) {
        productoSelect.addEventListener('change', function() {
            console.log('Producto seleccionado:', this.value);
            cargarPrecioProducto();
        });
    }
});
</script>