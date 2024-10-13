<?
//Esta pagina funciona como recopilador de todas las funciones y variables globales que usara el sistema 
error_reporting(0);

//require 'vendor\autoload.php';
require "init.php";
require_once "init_js.php";
require 'navegacion.php';
require "config.php";


//script para traer las configuraciónes guardadas del usuario
if(isset($_SESSION["usuario"])){
    global $configuracion;
    $configuracion = array();
    $res = select("configuraciones", "*", ["cfg_per_id"=>$_SESSION["usuario"]["per_id"]]);
    if(count($res["datos"])>0){
        foreach($res["datos"] as $r){
            $configuracion[$r["cfg_nombre"]] = $r;
        }
    }
}