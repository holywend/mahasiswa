<!-- File navbar.php -->
<nav class="navbar navbar-expand navbar-light bg-light shadow static-top">
    <!-- Navbar Sitename -->
    <div class="navbar-brand mr-1" href="<?= base_url('Mahasiswa') ?>">
        <!-- Navbar Toggle Sidebar -->
        <button class="btn text-dark" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i> Data Mahasiswa
        </button>
    </div>

    <!-- Navbar Usermenu -->
    <ul class="navbar-nav ml-auto float-right">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> Selamat datang, <?= $this->session->userdata('username');?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Ubah Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#signout_modal">Sign Out</a>
            </div>
        </li>
    </ul>
</nav>
<!-- / File navbar.php -->