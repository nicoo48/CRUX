<?
$nivel_directorio = "../../";
require "../../carga.php";

$unidad_medida = select("unidad_medida", "*");
$registros = count($unidad_medida["datos"]);

if($registros > 0){
    ?>
    <div class="card">
        <div class="card-header">
            <?
            boton(
                "Crear Unidad de Medida",
                "plus-circle",
                "info",
                "crearUnidad()"
            );
            ?>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-products table">
            <thead>
                <tr>
                    <th width="1"></th>
                    <th width="1">#</th>
                    <th>Nombre Unidad</th>
                    <th>Código Unidad</th>
                </tr>
            </thead>
            <tbody>
                <?
                $contador = 0;
                foreach($unidad_medida["datos"] as $u){
                    $contador ++;                    ?>
                    <tr>
                        <td>
                            <?
                            boton("","pencil","info","editarUnidad($u[uni_id])");
                            ?>
                        </td>
                        <td><?= $contador;?></td>
                        <td><?= $u["uni_nombre"]?></td>
                        <td><?= $u["uni_codigo"]?></td>
                    <?
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>  
    <?
}else{
    ?>
    <div class="card">
        <div class="card-header">
            <?
            boton(
                "Crear Producto",
                "plus-circle",
                "info",
                "crearUnidad()"
            );
            ?>
        </div>
    </div>
    <?
    mensaje(
        "Sin Información",
        "No se encontraron Unidades de Medida en la base de datos",
        "x"
    );
}
?>
<script>
    function crearUnidad(){
        AJAXPOST(urlBase + "pages/tienda/unidades/crear.php", "", document.getElementById("pagina_central"));
    }
    function editarUnidad(id){
        AJAXPOST(urlBase + "pages/tienda/unidades/editar.php", "id="+id, document.getElementById("pagina_central"));
    }
</script>