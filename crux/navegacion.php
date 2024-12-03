<?
//La navegación esta en duro y los iconos son de https://icons.getbootstrap.com/
$_navegacion = array(
    "Tienda" => array(
        "icono" => "shop-window",
        "carpeta" => "tienda",
        "paginas" => array(
            "Tiendas" => array(
                "url" => "tiendas.php",
                "icono" => "shop"
            ),
            "Productos" => array(
                "url" => "productos.php",
                "icono" => "bag"
            ),
            "Unidades" => array(
                "url" => "unidades.php",
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
            ),
            "Más Vendidos" => array(
                "url"=>"informe_masVendidos.php",
                "icono"=>"cash-stack"
            ),
            "Ventas X Mes" => array(
                "url"=>"informe_ventasMes.php",
                "icono"=>"cash-stack"
            ),
            "Listado Ventas" => array(
                "url"=>"listado_ventas.php",
                "icono"=>"clipboard-data"
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
