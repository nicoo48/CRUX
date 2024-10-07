<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <?require 'menu/logo.php';?>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <? 
        //dentro del archivo de abajo esta el ciclo con el arreglo de navegación
        require 'menu/item.php';
        ?>
    </ul>
</aside>