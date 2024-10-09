<?
//La navegación esta en duro y los iconos son de https://icons.getbootstrap.com/
$_navegacion = array(
    "Tienda" => array(
        "icono" => "shop-window",
        "carpeta" => "tienda",
        "paginas" => array(
            "Mis Tiendas" => array(
                "url"=>"tiendas.php",
                "icono"=>"shop"
            ),
            "Mis Productos" => array(
                "url"=>"productos.php",
                "icono"=>"bag"
            )
        )
    ),
    "Ventas" => array(
        "icono" => "cart",
        "carpeta" => "ventas",
        "paginas" => array(
            "Ventas" => array(
                "url"=>"ventas.php",
                "icono"=>"cart"
            ),
            "Clientes" => array(
                "url"=>"clientes.php",
                "icono"=>"people"
            )
        )
    ),
    "Informes" => array(
        "icono" => "file-earmark-bar-graph",
        "carpeta" => "informes",
        "paginas" => array(
            "Stock" => array(
                "url"=>"informe_stock.php",
                "icono"=>"boxes"
            ),
            "Ventas" => array(
                "url"=>"informe_ventas.php",
                "icono"=>"currency-dollar"
            )
        )
    ),
    "Configuración" => array(
        "icono" => "gear",
        "carpeta" => "configuracion",
        "paginas" => array(
            "Configuración de la cuenta" => array(
                "url"=>"configuracion.php",
                "icono"=>"person-fill-gear"
            ),
            "Configuración de la Aplicación" => array(
                "url"=>"aplicacion.php",
                "icono"=>"house-gear"
            )
        )
    ),
    "movimientos" => array(
        "icono" => "basket",
        "carpeta" => "movimientos",
        "paginas" => array(
            "Crear Movimientos" => array(
                "url"=>"elegir_movimiento.php",
                "icono"=>"basket"
            ),
            "Listado Movimientos" => array(
                "url"=>"listado_movimientos.php",
                "icono"=>"list"
            )
        )
    )
);