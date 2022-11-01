<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{ asset ('AdminLTE/dist')}}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SKPI FTI UNSERA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset ('AdminLTE/dist')}}/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item {{ $menu === "mahasiswa" ? "menu-open" : '' }}">
                    <a href="#" class="nav-link {{ $menu === "mahasiswa" ? "active" : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Mahasiswa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link {{ ($title === "Data Mahasiswa") ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/mahasiswa-tambah" class="nav-link {{ ($title === "Tambah Data Mahasiswa")
                                ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Data </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="/admin/mahasiswa-edit" class="nav-link {{ ($title === "Edit Data Mahasiswa")
                                ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Data </p>
                            </a>
                        </li> --}}

                    </ul>
                </li>


                <li class="nav-item {{ $menu === "kaprodi" ? "menu-open" : '' }}">
                    <a href="#" class="nav-link {{ $menu === "kaprodi" ? "active" : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Kaprodi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/kaprodi" class="nav-link {{ ($title === "Data Kaprodi") ? 'active' : ''
                                }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kaprodi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/kaprodi-tambah" class="nav-link {{ ($title === "Tambah Data Kaprodi")
                                ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Data</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="/admin/kaprodi-edit" class="nav-link {{ ($title === "Edit Data Kaprodi")
                                ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Data</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>