<?php 
require_once("../ui/header.php");
require_once("../ui/sidebar.php");
require_once("../../../database/koneksi.php");
?>

<?php if($_SESSION['role'] == "superadmin" || $_SESSION['role'] == 'admin'){ ?>
<div class="d-flex justify-content-center align-items-center flex-wrap gap-3 gap-lg-3">
    <div class="card col-sm-4 col-md-3">
        <div class="card-header py-2">
            <h4 class="card-title fs-6 text-center
             text-text-black-50">Karyawan / Admin Perpustakaan</h4>
        </div>
        <div class="card-body mt-2">
            <?php 
                $karyawan = $konfigs->query("SELECT count(id_akun) as jabatan FROM users WHERE role = 'admin' order by id_akun asc");
                $countKaryawan = mysqli_fetch_array($karyawan);
            ?>
            <p class="text-center fs-1 display-4">
                <?php echo $countKaryawan['jabatan'] ?>
            </p>
        </div>
    </div>
    <div class="card col-sm-4 col-md-3">
        <div class="card-header py-2">
            <h4 class="card-title fs-6 text-center
             text-text-black-50">Data Buku Perpustakaan</h4>
        </div>
        <div class="card-body mt-2">
            <?php 
                $buku = $konfigs->query("SELECT count(id_buku) as buku FROM buku order by id_buku asc");
                $countBuku = mysqli_fetch_array($buku);
            ?>
            <p class="text-center fs-1 display-4">
                <?php echo $countBuku['buku'] ?>
            </p>
        </div>
    </div>
    <div class="card col-sm-4 col-md-3">
        <div class="card-header py-2">
            <h4 class="card-title fs-6 text-center
             text-text-black-50">Data Anggota Perpustakaan</h4>
        </div>
        <div class="card-body mt-2">
            <?php 
                $anggota = $konfigs->query("SELECT count(id_anggota) as anggota FROM anggota order by id_anggota asc");
                $countAnggota = mysqli_fetch_array($anggota);
            ?>
            <p class="text-center fs-1 display-4">
                <?php echo $countAnggota['anggota'] ?>
            </p>
        </div>
    </div>
</div>
<?php }else{ ?>
<p class="fs-1 display-4 text-center">Tidak Ada Data Master Aplikasi Perpustakaan</p>
<?php } ?>

<?php 
require_once("../ui/footer.php");
?>