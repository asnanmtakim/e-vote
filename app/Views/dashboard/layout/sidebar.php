<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?= base_url(); ?>/dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?= $appIdentity['app_icon']; ?>" alt="Logo" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= $appIdentity['app_brand']; ?>" alt="Logo" height="27">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?= base_url(); ?>/dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?= $appIdentity['app_icon']; ?>" alt="Logo" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= $appIdentity['app_brand_light']; ?>" alt="Logo" height="27">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <?php if (auth()->user()->inGroup('user')) : ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link<?= $page == 'vote' ? ' active' : ''; ?>" href="<?= base_url(); ?>/dashboard/vote">
                            <i class="ri-file-user-line"></i> <span>Vote</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (auth()->user()->inGroup('admin')) : ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span>Menu Admin</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link<?= $page == 'dashboard' ? ' active' : ''; ?>" href="<?= base_url(); ?>/dashboard">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link<?= ($page == 'apps' || $page == 'footer') ? ' active' : ''; ?>" href="#sidebarApp" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApp">
                            <i class="ri-apps-line"></i> <span>Setting Aplikasi</span>
                        </a>
                        <div class="collapse menu-dropdown<?= ($page == 'apps' || $page == 'footer') ? ' show' : ''; ?>" id="sidebarApp">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>/dashboard/apps" class="nav-link<?= $page == 'apps' ? ' active' : ''; ?>">Identitas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link menu-link<?= $page == 'admin' ? ' active' : ''; ?>" href="<?= base_url(); ?>/dashboard/admin">
                            <i class="ri-user-2-line"></i> <span>Data Admin</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link menu-link<?= $page == 'calon' ? ' active' : ''; ?>" href="<?= base_url(); ?>/dashboard/calon">
                            <i class="ri-shield-user-line"></i> <span>Data Calon Formatur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link<?= $page == 'pemilih' ? ' active' : ''; ?>" href="<?= base_url(); ?>/dashboard/pemilih">
                            <i class="ri-folder-user-line"></i> <span>Data Pemilih</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link<?= $page == 'hasil' ? ' active' : ''; ?>" href="<?= base_url(); ?>/dashboard/hasil">
                            <i class="ri-line-chart-line"></i> <span>Hasil Voting</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>