<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
        
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

    
    </li>
    <li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
    </li>
    <!-- dropdown log out -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="http://<?= $_SERVER['HTTP_HOST']?>/bk_poliklnik/pages/auth/destroy.php" class="dropdown-item">Logout</a>
        </div>
    </li>
</ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">


<!-- Sidebar -->
<div class="sidebar bg-primary" >
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    
    <div class="info">
        <a href="#" class="d-block"><?= ucwords($_SESSION['username'])?></a>
    </div>
    </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <?php if ($_SESSION['akses'] == 'admin') : ?>
                    <li class="nav-item">
                        <a href="<?= $base_admin ?>" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                               
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_admin.'/dokter' ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Dokter</p>
                           
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_admin.'/pasien' ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>
                                Pasien
                               
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_admin.'/poli' ?>" class="nav-link">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>
                                Poli
                               
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_admin.'/obat' ?>" class="nav-link">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>
                                Obat
                               
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="http://<?= $_SERVER['HTTP_HOST']?>/bk_poliklnik/pages/auth/destroy.php" class="nav-link">
                           
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php elseif ($_SESSION['akses'] == 'dokter') : ?>
                    <li class="nav-item">
                        <a href="<?= $base_dokter ?>" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                              
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_dokter . '/jadwal_periksa' ?>" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Jadwal Periksa
                              
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_dokter . '/memeriksa_pasien' ?>" class="nav-link">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>
                                Memeriksa Pasien
                              
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_dokter . '/riwayat_pasien' ?>" class="nav-link">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>
                                Riwayat Pasien
                              
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_dokter . '/profil' ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profil
                              
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="http://<?= $_SERVER['HTTP_HOST']?>/bk_poliklnik/pages/auth/destroy.php" class="nav-link">
                           
                            <p>
                                Logout
                                <span class="right badge badge-warning">Pasien</span>
                            </p>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="<?= $base_pasien ?>" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                               
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_pasien . '/poli' ?>" class="nav-link">
                            <i class="nav-icon fas fa-hospital"></i>
                            <p>
                                Poli
                               
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="http://<?= $_SERVER['HTTP_HOST']?>/bk_poliklnik/pages/auth/destroy.php" class="nav-link">
                           
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>