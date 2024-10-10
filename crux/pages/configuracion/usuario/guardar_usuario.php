<?php
$nivel_directorio = "../../../";
require "../../../carga.php";

if ($_REQUEST <> "") {
    unset($campos);

    // Manejo de archivo de imagen
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        $nombre_archivo = $_FILES['foto_perfil']['name'];
        $ruta_destino = $nivel_directorio . "template/assets/img/avatars/" . $nombre_archivo;

        // Verificar si el archivo ya existe y crear un nuevo nombre si es necesario
        if (file_exists($ruta_destino)) {
            $nombre_archivo = pathinfo($nombre_archivo, PATHINFO_FILENAME) . '_' . time() . '.' . pathinfo($nombre_archivo, PATHINFO_EXTENSION);
            $ruta_destino = $nivel_directorio . "template/assets/img/avatars/" . $nombre_archivo;
        }

        // Mueve el archivo subido a la carpeta de destino
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta_destino)) {
            $campos["per_imagen"] = $nombre_archivo;
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
    } elseif (!empty($_REQUEST["url_imagen"]) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_NO_FILE) {

    }

    $campos["per_usuario"] = $_REQUEST["usuario"];
    $campos["per_clave"] = $_REQUEST["clave"];
    $filtro["per_id"] = $_SESSION['usuario']['per_id'];
    $res = update("personas", $campos, $filtro);

    if ($res['error'] == 0) {
        mensaje(
            "Se Guardó correctamente",
            "Se guardaron correctamente los datos del usuario",
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
?>
