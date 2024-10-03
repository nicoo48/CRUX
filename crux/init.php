<?
//hacemos una pequeña rutina para traer todas las funciones de la carpeta funciones
$funciones = opendir($nivel_directorio . "funciones/");
while ($archivo = readdir($funciones)) {
    if (!is_dir($archivo)) {
        require "funciones/" . $archivo;
    }
}
