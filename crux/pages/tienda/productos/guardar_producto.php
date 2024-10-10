<?php
$nivel_directorio = "../../../";
require "../../../carga.php";

$modo = $_REQUEST["modo"];

switch ($modo) {
    case 'agregar':
        if ($_REQUEST <> "") {
            unset($campos);
        
            // Manejo de la imagen
            if (isset($_FILES['imagenDispositivo']) && $_FILES['imagenDispositivo']['error'] == UPLOAD_ERR_OK) {
                // Subida de imagen desde dispositivo
                $nombre_archivo = $_FILES['imagenDispositivo']['name'];
                $ruta_destino = $nivel_directorio . "template/assets/img/products/" . $nombre_archivo;
        
                // Verificar si el archivo ya existe y crear un nuevo nombre si es necesario
                if (file_exists($ruta_destino)) {
                    $nombre_archivo = pathinfo($nombre_archivo, PATHINFO_FILENAME) . '_' . time() . '.' . pathinfo($nombre_archivo, PATHINFO_EXTENSION);
                    $ruta_destino = $nivel_directorio . "template/assets/img/products/" . $nombre_archivo;
                }
        
                // Mover la imagen al directorio
                if (move_uploaded_file($_FILES['imagenDispositivo']['tmp_name'], $ruta_destino)) {
                    $campos["imagen"] = "template/assets/img/products/" . $nombre_archivo; // Guardar la ruta en el campo de la base de datos
                } else {
                    mensaje(
                        "Error en la carga",
                        "Error al mover la imagen. No se guardó la imagen.",
                        "danger",
                        "exclamation-triangle",
                        "1"
                    );
                    exit;
                }
            } elseif (!empty($_REQUEST['imagenURL'])) {
                // Guardar la URL de la imagen directamente en la base de datos
                $campos["imagen"] = $_REQUEST['imagenURL'];
            }
        
            // Guardar el resto de los datos del producto
            $campos["tnd_id"] = $_REQUEST["tienda"];
            $campos["nombre"] = $_REQUEST["nombre"];
            $campos["precio"] = $_REQUEST["costo"];
            $campos["descripcion"] = $_REQUEST["Descripcion"];
            $campos["umed"] = $_REQUEST["umed"];
            $campos["ancho"] = $_REQUEST["ancho"];
            $campos["largo"] = $_REQUEST["largo"];
        
            $res = insert("productos", $campos);
        
            if ($res['error'] == 0) {
                mensaje(
                    "Se Guardó correctamente",
                    "Se guardaron correctamente los datos del producto",
                    "success",
                    "save",
                    "1"
                );
            } else {
                mensaje(
                    "Atención",
                    "No se logró guardar correctamente, Intente nuevamente",
                    "warning",
                    "exclamation-diamond-fill",
                    "1"
                );
            }
        }
        break;
    
    case 'editar':
        $id = $_REQUEST["id"];
        unset($campos);
        
            // Manejo de la imagen
            if (isset($_FILES['imagenDispositivo']) && $_FILES['imagenDispositivo']['error'] == UPLOAD_ERR_OK) {
                // Subida de imagen desde dispositivo
                $nombre_archivo = $_FILES['imagenDispositivo']['name'];
                $ruta_destino = $nivel_directorio . "template/assets/img/products/" . $nombre_archivo;
        
                // Verificar si el archivo ya existe y crear un nuevo nombre si es necesario
                if (file_exists($ruta_destino)) {
                    $nombre_archivo = pathinfo($nombre_archivo, PATHINFO_FILENAME) . '_' . time() . '.' . pathinfo($nombre_archivo, PATHINFO_EXTENSION);
                    $ruta_destino = $nivel_directorio . "template/assets/img/products/" . $nombre_archivo;
                }
        
                // Mover la imagen al directorio
                if (move_uploaded_file($_FILES['imagenDispositivo']['tmp_name'], $ruta_destino)) {
                    $campos["imagen"] = "template/assets/img/products/" . $nombre_archivo; // Guardar la ruta en el campo de la base de datos
                } else {
                    mensaje(
                        "Error en la carga",
                        "Error al mover la imagen. No se guardó la imagen.",
                        "danger",
                        "exclamation-triangle",
                        "1"
                    );
                    exit;
                }
            } elseif (!empty($_REQUEST['imagenURL'])) {
                // Guardar la URL de la imagen directamente en la base de datos
                $campos["imagen"] = $_REQUEST['imagenURL'];
            }
        
            // Guardar el resto de los datos del producto
            $campos["tnd_id"] = $_REQUEST["tienda"];
            $campos["nombre"] = $_REQUEST["nombre"];
            $campos["precio"] = $_REQUEST["costo"];
            $campos["descripcion"] = $_REQUEST["Descripcion"];
            $campos["umed"] = $_REQUEST["umed"];
            $campos["ancho"] = $_REQUEST["ancho"];
            $campos["largo"] = $_REQUEST["largo"];
            $filtro["id"] = $id;
            $res = update("productos", $campos, $filtro);
        
            if ($res['error'] == 0) {
                mensaje(
                    "Se Guardó correctamente",
                    "Se guardaron correctamente los datos del producto",
                    "success",
                    "save",
                    "1"
                );
            } else {
                mensaje(
                    "Atención",
                    "No se logró guardar correctamente, Intente nuevamente",
                    "warning",
                    "exclamation-diamond-fill",
                    "1"
                );
            }
        break;
}
?>
