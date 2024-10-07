<?
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos todas las tiendas del usuario
$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$tiendas = select("tiendas", "*", $filtros);
if (count($tiendas["datos"]) > 0) {
    barra_busqueda("filtrar_tienda()");
    boton("Crear Tienda", "plus-circle", "success", "crearTienda()", "Crear una nueva tienda");
    ?>
    <br><br>
    <div class="row mb-12 g-6">
        <?
        foreach ($tiendas["datos"] as $tienda) {
            if (!$_SESSION["tienda"]["tnd_id"] == $tienda["tnd_id"]) {
                $estilo = "bg-success";
                $style = "style='color:white'";
            }
            ?>
            <div class="col-md-6 col-lg-4" id="tienda_<?= $tienda["tnd_id"] ?>">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="display: flex;justify-content: space-between;">
                            <i class="bi bi-shop">&nbsp;<?=$tienda["tnd_nombre"]?></i>
                            <div>
                                <?
                                boton("", "pencil", "outline-primary", "editarTienda(" . $tienda["tnd_id"] . ")", "Editar la información de la tienda");
                                boton("", "trash", "outline-danger", "abrir_modal(" . $tienda["tnd_id"] . ")", "Eliminar la tienda");
                                ?>
                            </div>
                        </h5>
                        <hr>
                        <p class="card-text">
                            <?= $tienda["tnd_direccion"] ?>
                        </p>
                    </div>
                </div>
            </div>
        <?
        }
        ?>
    </div>
<?
} else {
    mensaje("Aquí no hay nada.", "Parece que aun no tienes tiendas registradas, ¿por qué no creas una?", "info", "shop", 1);
    boton("Crear Tienda", "plus-circle", "outline-info", "crearTienda()");
}
modal("ModEliminar", "Eliminar Tienda", "¿Estás seguro de que deseas eliminar esta tienda?", "shop", "xl", "eliminarTienda()");
?>
<script>
    function filtrar_tienda(){
        console.log("filtranding")
    }
    function crearTienda() {
        AJAXPOST(urlBase + "pages/tienda/tiendas/crear.php", "", document.getElementById("pagina_central"));
    }

    function editarTienda(id) {
        AJAXPOST(urlBase + "pages/tienda/tiendas/editar.php", "id=" + id, document.getElementById("pagina_central"));
    }

    function eliminarTienda() {
        var id = document.getElementById("valor_modal").value;
        AJAXPOST(urlBase + "pages/tienda/tiendas/eliminar.php", "id=" + id, document.getElementById("pagina_central"));
    }
</script>