<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">CRUX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <!-- El menu de inicio estara en duro -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-house-door"></i>
                        Inicio
                    </a>
                </li>            
                <?
                foreach ($_navegacion as $nombre => $link) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-<?= $link["icono"] ?>"></i>
                            <?= $nombre ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?
                            foreach ($link["paginas"] as $pagina => $url) {
                            ?>
                                <li>
                                    <a class="dropdown-item" href="#" onclick='javascript:cargar_pagina("<?=$url["url"]?>","<?=$link["carpeta"]?>")'>
                                        <i class="bi bi-<?= $url["icono"] ?>"></i>
                                        <?= $pagina ?>
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
                <li>
                    <a class="nav-link" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        Salir
                    </a>
            </ul>
        </div>
    </div>
</nav>
<script>
    function cargar_pagina(pagina,carpeta){
        var div = document.getElementById("pagina_central");
        AJAXPOST(urlBase+"pages/"+carpeta+"/"+pagina,"",div)
    }
</script>