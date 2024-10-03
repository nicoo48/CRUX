<?
if ($nivel_directorio == "") {
    //iniciamos las librerias siempre y cuando no se nos caiga el sistema por no tener la variable de nivel de directorio
    echo '<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>';
    $funciones_js = opendir("funciones_js/");
    while ($archivo = readdir($funciones_js)) {
        if (!is_dir($archivo)) {
            echo "<script src= 'funciones_js/$archivo'></script>";
        }
    }
        
    
}
