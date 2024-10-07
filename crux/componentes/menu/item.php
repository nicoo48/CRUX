<?
foreach($_navegacion as $modulo => $cont_modulo){
    // empezamos creando el modulo y despues creamos el submenu
    ?>
    <li class="menu-item" id="">
        <a href="" class="menu-link menu-toggle">
            <i class="bi bi-<?=$cont_modulo["icono"]?>" style="padding-right: 5px; !important;"></i>
            <div data-i18n="<?=$modulo?>"><?=$modulo?></div>
        </a>
        <ul class="menu-sub">
            <?
            foreach($cont_modulo["paginas"] as $pagina => $cont_pagina){
                ?>
                <li class="links_paginas menu-item" id="link_<?=$cont_pagina['url']?>" name="">
                    <a onclick="cargar_pagina('<?=$cont_pagina['url']?>','<?=$cont_modulo['carpeta']?>')" class="menu-link">
                        <i class="bi bi-<?=$cont_pagina["icono"]?>" style="padding-right: 5px; !important;"></i>
                        <div data-i18n="<?=$pagina?>"><?=$pagina?></div>
                    </a>
                </li>
                <?
            }
            ?>
        </ul>    
    </li>
    <?
}
?>