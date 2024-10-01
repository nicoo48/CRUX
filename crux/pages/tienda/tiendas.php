<?
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos todas las tiendas del usuario
$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$tiendas = select("tiendas","*",$filtros);
if(count($tiendas["datos"])>0){
    mensaje(
        "Tus tiendas",
        "Aquí puedes ver todas las tiendas que has creado.",
        "info",
        "shop",
        0    
    );
    ?>
    <table class="table table-bordered table-hovered">
        <thead>
            <tr>
                <th width="250">Nombre</th>
                <th>Dirección</th>
                <th width="180"></th>
            </tr>
        </thead>
        <tbody>
            <?
            foreach($tiendas["datos"] as $tienda){
                ?>
                <tr>
                    <td><?=$tienda["tnd_nombre"]?></td>
                    <td><?=$tienda["tnd_direccion"]?></td>
                    <td>
                        <?
                            boton(";Editar","pencil","outline-success","editarTienda(".$tienda["tnd_id"].")");
                            boton(";Eliminar","trash","outline-danger","eliminarTienda(".$tienda["tnd_id"].")");
                            boton(";Productos","box","outline-info","cargar_pagina('productos.php','tienda',".$tienda["tnd_id"].")");
                        ?>
                    </td>
                </tr>
                <?
            }
            ?>
        </tbody>
    </table>
    <?
}else{
    mensaje(
        "Aquí no hay nada.",
        "Parece que aun no tienes tiendas registradas, ¿por qué no creas una?",
        "info",
        "shop",
        1
    );
    boton(
        "Crear Tienda",
        "plus-circle",
        "outline-info",
        "crearTienda()"
    );
    ?>
    <script>
        function crearTienda(){
            AJAXPOST(urlBase+"pages/tienda/tiendas/crear.php","",document.getElementById("pagina_central"));
        }
    </script>
    <?
}