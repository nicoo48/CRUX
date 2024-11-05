<?
//La navegación esta en duro y los iconos son de https://icons.getbootstrap.com/
$_navegacion = array(
    "Tienda" => array(
        "icono" => "shop-window",
        "carpeta" => "tienda",
        "paginas" => array(
            "Mis Tiendas" => array(
                "url" => "tiendas.php",
                "icono" => "shop"
            ),
            "Mis Productos" => array(
                "url" => "productos.php",
                "icono" => "bag"
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
            )
        )
    ),
    /*
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
    */
    "Compras y Ventas" => array(
        "icono" => "cash-stack",
        "carpeta" => "movimientos",
        "paginas" => array(
            "Compras" => array(
                "url" => "crear_entrada.php",
                "icono" => "cart-plus"
            ),
            "Ventas" => array(
                "url" => "crear_salida.php",
                "icono" => "cart-dash"
            ),
            "Resumen" => array(
                "url" => "listado_movimientos.php",
                "icono" => "clipboard-data"
            )
        )
    ),
    "Configuración" => array(
        "icono" => "gear",
        "carpeta" => "configuracion",
        "paginas" => array(
            "Configuración de la cuenta" => array(
                "url" => "configuracion.php",
                "icono" => "person-fill-gear"
            ),
            "Configuración de la Aplicación" => array(
                "url" => "aplicacion.php",
                "icono" => "house-gear"
            )
        )
    )
);
