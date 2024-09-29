<?
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos todas las tiendas del usuario
$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$tiendas = select("tiendas","*",$filtros);
if(count($tiendas)>0){
    mensaje(
        "No tienes tiendas registradas",
        "No tienes tiendas registradas, por favor registra una tienda para poder continuar",
        "warning"
    );
    ?>
        <button class="btn btn-secondary" onclick="crearTienda()">Crear tienda</button>
        <script>
            function crearTienda(){
                AJAXPOST(urlBase+"pages/tienda/tiendas/crear.php","",document.getElementById("pagina_central"));
            }
        </script>
    <?
}



