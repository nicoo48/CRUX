<?php
function subir_archivo($file) {
    global $urlBase;
    
    // Directorio de destino para los archivos subidos
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/crux/crux/uploads/';
    
    // Asegurarse de que el directorio existe, si no, crearlo
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Generar un nombre único para el archivo
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '.' . $fileExtension;
    
    // Ruta completa del archivo
    $filePath = $uploadDir . $fileName;
    
    // Intentar mover el archivo subido al directorio de destino
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Si la subida fue exitosa, devolver la URL del archivo
        $fileUrl = $urlBase . 'uploads/' . $fileName;
        return $fileUrl;
    } else {
        // Si hubo un error en la subida, devolver false
        return false;
    }
}

// Ejemplo de uso:
// if (isset($_FILES['imagen'])) {
//     $fileUrl = uploadFile($_FILES['imagen']);
//     if ($fileUrl) {
//         echo "Archivo subido exitosamente. URL: " . $fileUrl;
//     } else {
//         echo "Error al subir el archivo.";
//     }
// }
?>