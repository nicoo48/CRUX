<?
$nivel_directorio = "../../../";
require "../../../carga.php";
//consultamos si existe o no la configuración para saber si creamos o editamos
foreach($_REQUEST as $k => $v){
    if(isset($configuracion[$k])){
        //si esta definido lo actualizamos
        unset($campos);
        unset($filtros);
        $campos["cfg_valor"] = ($v=="on")?1:$v;
        $filtros["cfg_id"] = $configuracion[$k]["cfg_id"];
        $res = update("configuraciones", $campos, $filtros);
    }else{
        //si no esta entonces lo creamos 
        $campos["cfg_nombre"] = $k;
        $campos["cfg_valor"] = ($v=="on")?1:$v;
        $campos["cfg_per_id"] = $_SESSION["usuario"]["per_id"];
        $res = insert("configuraciones",$campos);
    }
}
echo "<script>alerta('Configuración guardada correctamente','success')</script>";

?>