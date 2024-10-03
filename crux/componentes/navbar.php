<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="ri-menu-fill ri-22px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
            <? require 'navbar/search.php'; ?>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->
            <? require 'navbar/language.php'; ?>
            <!--/ Language -->

            <!-- Style Switcher -->
            <? require 'navbar/switcher.php';?>
            <!-- / Style Switcher-->

            <!-- Quick links  -->
            <? require 'navbar/quick_links.php'; ?>
            <!-- Quick links -->

            <!-- Notification -->
            <? require 'navbar/notification.php'; ?>
            <!--/ Notification -->

            <!-- User -->
            <? require 'navbar/user.php'; ?>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input
            type="text"
            class="form-control search-input container-xxl border-0"
            placeholder="Search..."
            aria-label="Search..." />
        <i class="ri-close-fill search-toggler cursor-pointer"></i>
    </div>
</nav>