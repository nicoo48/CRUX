<?php
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";

// Decodificamos los datos de la tabla
$tabla_data = json_decode($_REQUEST['tabla_data'], true);

if (empty($tabla_data)) {
    mensaje(
        "Error al procesar los datos",
        "No se recibieron datos de productos",
        "error"
    );
    exit;
}

// Guardamos el movimiento principal una sola vez
$campos_movimiento = [
    "mov_tipo" => "ing",
    "mov_clase" => $tabla_data[0]["clase"], // Tomamos la clase del primer item
    "mov_fecha" => date("Y-m-d H:i:s"),
    "mov_per_id" => $_SESSION["usuario"]["per_id"],
    "mov_glosa" => $tabla_data[0]["glosa"], // Tomamos la glosa del primer item
    "mov_tnd_id" => "1"
];

$movimiento_principal = insert("movimientos", $campos_movimiento);

if ($movimiento_principal["error"] == 0) {
    $success = true;
    $movimiento_id = $movimiento_principal["datos"];

    // Iteramos sobre cada línea de la tabla para crear los detalles
    foreach ($tabla_data as $item) {
        $campos_detalle = [
            "mdet_mov_id" => $movimiento_id,
            "mdet_producto" => $item['producto'],
            "mdet_cantidad" => $item['cantidad'],
            "mdet_total" => $item['cantidad']
        ];

        $detalle = insert("movimientos_detalle", $campos_detalle);
        
        if ($detalle["error"] != 0) {
            $success = false;
            break;
        }
    }
    
    if ($success) {
        mensaje(
            "Movimiento de Ingreso creado correctamente",
            "Se creó el movimiento de Ingreso #" . $movimiento_id,
            "check"
        );
        boton(
            "Listado de movimientos",
            "list",
            "outline-info",
            "ir_listado()"
        );
    } else {
        mensaje(
            "Hubo un error al crear el detalle del movimiento #" . $movimiento_id,
            "No se pudo crear el detalle para todos los productos",
            "warning"
        );
    }
} else {
    mensaje(
        "Error al crear el movimiento principal",
        "No se pudo crear el movimiento de Ingreso",
        "error"
    );
}
?>

<script>
    function ir_listado() {
        AJAXPOST(urlBase + "pages/movimientos/listado_movimientos.php", "", document.getElementById("pagina_central"));
    }
</script>