<?
$nivel_directorio = "../../";
require "../../carga.php";

$productos = select("productos", "*");
$registros = count($productos["datos"]);

if($registros > 0){
    ?>
    <div class="card">
        <div class="card-header">
            <?
            boton(
                "Crear Producto",
                "plus-circle",
                "info",
                "crearProducto()"
            );
            ?>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-products table">
            <thead>
                <tr>
                    <th width="1">#</th>
                    <th>Producto</th>
                    <th>SKU</th>
                    <th>Código Barra</th>
                    <th>Precio</th>
                    <th>Unidad</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?
                foreach($productos["datos"] as $p){
                    $filtros["uni_id"] = $p["pro_unidad"];
                    $unidad = select("unidad_medida", "*", $filtros);
                    ?>
                    <tr>
                        <td>
                            <?
                            boton("","pencil","info","ver_ficha($p[pro_id])");
                            ?>
                        </td>
                        <td><?= $p["pro_nombre"]?></td>
                        <td><?= $p["pro_codigo"]?></td>
                        <td><?= $p["pro_codigo_barra"]?></td>
                        <td><?= $p["pro_precio"]?></td>
                        <td><?= $unidad["datos"][0]["uni_nombre"]?></td>
                        <td><?= $p["pro_descripcion"]?></td>
                        <td><?= _label_estado("producto", $p["pro_estado"],2);?></td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>  
    <?
}else{
    mensaje(
        "No hay productos",
        "No se encontraron productos en la base de datos",
        "x"
    );
}
?>
<script>
    function crearProducto(){
        AJAXPOST(urlBase + "pages/tienda/productos/crear_producto.php", "", document.getElementById("pagina_central"));
    }
    function ver_ficha(id){
        AJAXPOST(urlBase + "pages/tienda/productos/ficha.php", "id="+id, document.getElementById("pagina_central"));
    }
</script>