<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?= base_url(); ?>/dashboard" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= $appIdentity['app_icon']; ?>" alt="Logo" height="55">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= $appIdentity['app_brand']; ?>" alt="Logo" height="55">
                        </span>
                    </a>

                    <a href="<?= base_url(); ?>/dashboard" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= $appIdentity['app_icon']; ?>" alt="Logo" height="55">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= $appIdentity['app_brand_light']; ?>" alt="Logo" height="55">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?= checkImageUser(auth()->user()->image_user); ?>" alt="Avatar User">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= getFullname(auth()->user()->first_name, auth()->user()->last_name); ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?= auth()->user()->getGroups()[0]; ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h4 class="dropdown-header"><?= getFullname(auth()->user()->first_name, auth()->user()->last_name); ?></h4>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url(); ?>/logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>