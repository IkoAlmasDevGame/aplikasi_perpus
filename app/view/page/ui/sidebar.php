<?php 
if($_SESSION['role'] == ""){
    echo "<script>document.location.href = '../../auth/index.php?info=gagal'</script>";
    exit;
}
?>

<?php 
if($_SESSION['role'] == "superadmin"){
?>
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fs-6 fst-normal fw-semibold">
            Aplikasi Perpustakaan
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM users WHERE email = '$_SESSION[email]'")); ?>
                    <img src="../../../../assets/admin/<?php echo $baseFile['foto']; ?>" width="32"
                        alt="<?php echo $_SESSION['nama']?>" class="rounded-3 img-circle img-responsive">
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <hr class="dropdown-divider">
                        <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- ======= Header ======= -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Blank Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?aksi=pendaftaran-karyawan">
                <i class="fa fa-registered fa-1x"></i>
                <span>Pendaftaran Karyawan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=karyawan">
                <i class="fa fa-database fa-1x"></i>
                <span>Data Master Karyawan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=absensi">
                <i class="fa fa-bookmark fa-1x"></i>
                <span>Data Absensi Karyawan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=keterangan">
                <i class="fa fa-book fa-1x"></i>
                <span>Keterangan Karyawan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?aksi=ubah-karyawan&id=<?php echo $_SESSION['id']?>"
                onclick="return confirm('Apakah anda ingin edit profile anda ?')">
                <i class="fa fa-user-edit fa-1x"></i>
                <span>Edit Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=settings"
                onclick="return confirm('Apakah anda ingin edit pengturan Perpustakaan ?')">
                <i class="fa fa-gears fa-1x"></i>
                <span>Pengaturan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                onclick="return confirm('Apakah anda ingin logout ?')">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->
    </ul>
</aside><!-- End Sidebar-->
<!-- ======= Sidebar ======= -->

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>
    </section>
    <?php
}elseif($_SESSION['role'] == "admin"){
?>
    <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" role="button" class="logo d-flex align-items-center fs-6 fst-normal fw-semibold">
                Aplikasi Perpustakaan
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto mx-3">
            <ul>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                        data-bs-toggle="dropdown" aria-controls="dropdown">
                        <?php $baseFile = mysqli_fetch_array($konfigs->query("SELECT * FROM users WHERE email = '$_SESSION[email]'")); ?>
                        <img src="../../../../assets/admin/<?php echo $baseFile['foto']; ?>" width="32"
                            alt="<?php echo $_SESSION['nama']?>" class="rounded-3 img-circle img-responsive">
                        <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <hr class="dropdown-divider">
                            <div class="text-start">username : <?php echo $baseFile['username'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">Email : <?php echo $baseFile['email'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">nama : <?php echo $baseFile['nama'] ?></div>
                            <div class="mb-1"></div>
                            <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                            <hr class="dropdown-divider">
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header>
    <!-- ======= Header ======= -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=beranda">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Blank Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?aksi=absensi-karyawan">
                    <i class="fa fa-bookmark fa-1x"></i>
                    <span>Absensi Karyawan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?aksi=keterangan-karyawan">
                    <i class="fa fa-book-open fa-1x"></i>
                    <span>Keterangan Karyawan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=anggota">
                    <i class="fa fa-registered fa-1x"></i>
                    <span>Pendaftaran Anggota</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=buku">
                    <i class="fa fa-book-reader fa-1x"></i>
                    <span>Data Master Buku</span>
                </a>
            </li>

            <li class="nav-item" hidden>
                <a class="nav-link collapsed" aria-current="page" href="">
                    <i class="fa fa-location-arrow fa-1x"></i>
                    <span>Kategori Rak Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=peminjaman">
                    <i class="fa fa-book fa-1x"></i>
                    <span>Peminjaman Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=pengembalian">
                    <i class="fa fa-book-reader fa-1x"></i>
                    <span>Pengembalian Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page"
                    href="?aksi=ubah-karyawan&id=<?php echo $_SESSION['id']?>"
                    onclick="return confirm('Apakah anda ingin edit profile anda ?')">
                    <i class="fa fa-user-edit fa-1x"></i>
                    <span>Edit Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" aria-current="page" href="?page=keluar"
                    onclick="return confirm('Apakah anda ingin logout ?')">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Blank Page Nav -->
        </ul>
    </aside><!-- End Sidebar-->
    <!-- ======= Sidebar ======= -->

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>
        <?php
}else{
    echo "<script>document.location.href = '../../auth/index.php'</script>";
    exit;
}
?>