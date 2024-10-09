<?
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos todas las tiendas del usuario
$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$tiendas = select("tiendas", "*", $filtros);
if (count($tiendas["datos"]) > 0) {
?>
    <div id="operacion"></div>
    <div style="display:flex;justify-content: space-between;">
        <?
        barra_busqueda("filtrar_tienda()");
        boton("Nueva Tienda", "star", "outline-success", "crearTienda()");
        ?>
    </div>
    <hr>
    <div class="row mb-12 g-6">
        <?
        foreach ($tiendas["datos"] as $tienda) {
            if ($_SESSION["tienda"]["tnd_id"] == $tienda["tnd_id"]) {
                $estilo = "bg-primary";
                $style = "style='color:white!important'";
            }
        ?>
            <div class="col-md-6 col-lg-4 tarjeta_tienda " id="tienda_<?= $tienda["tnd_id"] ?>">
                <div class="card <?= $estilo ?>" <?= $style ?> class="tarjeta_estilo" id="est_<?= $tienda["tnd_id"] ?>">
                    <div class="card-body">
                        <h5 class="card-title" style="display: flex;justify-content: space-between;">
                            <i class="bi bi-shop" <?= $style ?>>&nbsp;<?= $tienda["tnd_nombre"] ?></i>
                            <div  style="display: flex;align-items:center">
                                <?
                                if ($_SESSION["tienda"]["tnd_id"] == $tienda["tnd_id"]) {
                                    boton(
                                        "",
                                        "check-all",
                                        "secondary",
                                        'alerta("Tienda ya Seleccionada","success")',
                                        "Utilizar tienda"
                                    );
                                } else {
                                    boton(
                                        "",
                                        "check2-square",
                                        "success",
                                        "seleccionar_tienda($tienda[tnd_id])",
                                        "Utilizar tienda"
                                    );
                                }
                                boton(
                                    "",
                                    "pencil",
                                    "warning",
                                    "editarTienda($tienda[tnd_id])",
                                    "Editar la información de la tienda"
                                );
                                boton(
                                    "",
                                    "trash",
                                    "danger",
                                    "abrir_modal($tienda[tnd_id])",
                                    "Eliminar la tienda"
                                );
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
            $estilo = "";
            $style = "";
        }
        ?>
    </div>
<?
} else {
    mensaje("Aquí no hay nada.", "Parece que aun no tienes tiendas registradas, ¿por qué no creas una?", "info", "shop", 1);
    boton("Crear Tienda", "plus-circle", "outline-info", "crearTienda()");
}
modal("ModEliminar", "Eliminar Tienda", "¿Estás seguro de que deseas eliminar esta tienda?<p style='color:red'>Esta Acción es Permanente</p>", "shop", "xl", "eliminarTienda()");
?>
<script>
    function seleccionar_tienda(id) {
        AJAXPOST(urlBase + "pages/tienda/tiendas/seleccionar.php", "id=" + id, document.getElementById("operacion"));
    }

    function filtrar_tienda() {
        const searchTerm = document.getElementById('barra_busqueda').value.toLowerCase();
        const tiendas = document.getElementsByClassName('tarjeta_tienda');

        for (let tienda of tiendas) {
            const tiendaNombre = tienda.querySelector('.card-title').textContent.toLowerCase();
            const tiendaDireccion = tienda.querySelector('.card-text').textContent.toLowerCase();

            if (tiendaNombre.includes(searchTerm) || tiendaDireccion.includes(searchTerm)) {
                tienda.style.display = '';
            } else {
                tienda.style.display = 'none';
            }
        }
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