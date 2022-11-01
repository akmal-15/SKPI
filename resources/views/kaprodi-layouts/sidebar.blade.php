<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/kaprodi" class="brand-link">
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
                <a href="#" class="d-block">Kaprodi</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item {{ $menu === "materi" ? "menu-open" : '' }}">
                    <a href="" class="nav-link {{ $menu === "materi" ? "active" : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Materi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/kaprodi" class="nav-link {{ ($title === "Data Materi") ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Materi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kaprodi/materi-tambah" class="nav-link {{ ($title === "Tambah Data Materi") ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Data </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="/kaprodi/materi-edit" class="nav-link {{ ($title === " Edit Data Materi")
                                ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Data </p>
                            </a>
                        </li> --}}

                    </ul>
                </li>


                <li class="nav-item {{ $menu === "soal" ? "menu-open" : '' }}">
                    <a href="#" class="nav-link {{ $menu === "soal" ? "active" : '' }}">
                        <i class="nav-icon fas fa-users "></i>
                        <p>
                            Soal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/kaprodi/data-soal" class="nav-link {{ ($title === "Data Soal") ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Soal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kaprodi/tambah-soal" class="nav-link {{ ($title === "Tambah Data Soal") ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Data</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="" class="nav-link {{ ($title === " Edit Data Kaprodi")
                                ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Data</p>
                            </a>
                        </li> --}}
                    </ul>
                <li class="nav-item  ">
                    <a href="/kaprodi/validasi-pengajuan" class="nav-link btn-secondary">
                        <i class="nav-icon fas fa-file"></i>
                        <p class="text-light">Validasi Pengajuan</p>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="/kaprodi/sudah-validasi" class="nav-link btn-secondary">
                        <i class="nav-icon fas fa-file"></i>
                        <p class="text-light">Sudah di Validasi</p>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="/kaprodi/dokumen" class="nav-link btn-secondary">
                        <i class="nav-icon fas fa-file"></i>
                        <p class="text-light">Dokumen</p>
                    </a>
                </li>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>