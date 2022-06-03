<!-- File sidebar.php -->
<ul class="sidebar sidebar-dark bg-primary navbar-nav">
    <li class="nav-item <?php echo (strtolower($this->uri->segment(1)) == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?php echo (strtolower($this->uri->segment(1)) == 'mahasiswa') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('Mahasiswa') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item <?= (strtolower($this->uri->segment(1)) == 'setting') ? 'active' : '' ?>">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span>
        </a>
    </li>
</ul>

<!-- / File sidebar.php -->