<?
//cargo la configuracion y las funciones
$nivel_directorio = "";
require "carga.php";
/* Validamos que el usuario este loggeado */
if (!isset($_SESSION['usuario'])) {
  echo '<script>location.href="login.php";</script>';
  exit;
}
?>

<!doctype html>

<html lang="es" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="template/assets/" data-template="vertical-menu-template" data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Proyecto Base 2 - Ahora es personal</title>

  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
  <link rel="icon" type="image/x-icon" href="template/assets/img/favicon/favicon.ico" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
  <!-- Icons -->
  <link rel="stylesheet" href="template/assets/vendor/fonts/remixicon/remixicon.css" />
  <link rel="stylesheet" href="template/assets/vendor/fonts/flag-icons.css" />
  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="template/assets/vendor/libs/node-waves/node-waves.css" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="template/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="template/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="template/assets/css/demo.css" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="template/assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="template/assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="template/assets/vendor/libs/swiper/swiper.css" />
  <!-- Page CSS -->
  <link rel="stylesheet" href="template/assets/vendor/css/pages/cards-statistics.css" />
  <link rel="stylesheet" href="template/assets/vendor/css/pages/cards-analytics.css" />
  <!-- Helpers -->
  <script src="template/assets/vendor/js/helpers.js"></script>
  <script src="template/assets/vendor/js/template-customizer.js"></script>
  <script src="template/assets/js/config.js"></script>
</head>

<body style="user-select:none">
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?
      // Menu laterarl
      require 'componentes/menu.php';
      ?>
      <div class="layout-page">
        <?
        // Barra de navegación
        require 'componentes/navbar.php';
        ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y" id="pagina_central">
            <!-- <?_p($_navegacion);?> -->
          </div>
        </div>
        <? require 'componentes/footer.php' ?>
        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div>
  <div class="layout-overlay layout-menu-toggle"></div>
  <div class="drag-target"></div>
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="template/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="template/assets/vendor/libs/popper/popper.js"></script>
  <script src="template/assets/vendor/js/bootstrap.js"></script>
  <script src="template/assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="template/assets/vendor/libs/hammer/hammer.js"></script>
  <script src="template/assets/vendor/libs/i18n/i18n.js"></script>
  <script src="template/assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="template/assets/vendor/js/menu.js"></script>

  <!-- endbuild -->
  <!-- Vendors JS -->
  <script src="template/assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="template/assets/vendor/libs/swiper/swiper.js"></script>
  <!-- Main JS -->
  <script src="template/assets/js/main.js"></script>
  <!-- Page JS -->
  <script src="template/assets/js/dashboards-analytics.js"></script>
  <script src="template/assets/js/ui-popover.js"></script>

  <script>
    function cargar_pagina(pagina,carpeta){
        var div = document.getElementById("pagina_central");
        AJAXPOST(urlBase+"pages/"+carpeta+"/"+pagina,"",div)
    }
  </script>
</body>


</html>