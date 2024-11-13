<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <? require 'menu/logo.php'; ?>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <?
        if ($_SESSION["usuario"]["per_id"] == 1) {
        ?>
            <a href="template/html/vertical-menu-template/index.html" target="_blank" style="margin-left:20px">
                <i class="bi bi-star" style="padding-right: 5px;">Template</i>
            </a>
        <?
        }
        //dentro del archivo de abajo esta el ciclo con el arreglo de navegación
        require 'menu/item.php';
        ?>
    </ul>
</aside>