<?
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos todas las tiendas del usuario

//seleccionamos todos los productos de la tienda seleccionada si es que hay una
if(isset($_SESSION["tienda"]["tnd_id"])){
    $filtros["pro_tnd_id"] = $_SESSION["tienda"]["tnd_id"];
}
$filtros["pro_per_id"] = $_SESSION["usuario"]["per_id"];
$productos = select("productos","*",$filtros);

if(count($productos['datos'])> 0){
    
}else{
    mensaje(
        "Aquí no hay nada.",
        "Parece que aun no tienes productos registrados, ¿por qué no creas un producto?",
        "info",
        "box-seam-fill",
        1
    );
    boton(
        "Crear Producto",
        "plus-circle",
        "outline-info",
        "crearProducto()"
    );
    ?>
    <script>
        function crearProducto(){
            AJAXPOST(urlBase+"pages/tienda/productos/agregar_producto.php","",document.getElementById("pagina_central"));
        }
    </script>
    <?
}