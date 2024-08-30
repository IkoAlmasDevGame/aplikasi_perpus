<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == 'admin'){
                require_once("../ui/header.php");
                require_once("../../../database/koneksi.php");
                require_once("../transaksi/function.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-body container bg-body-tertiary">
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo $title ?></h4>
                <div class="breadcrumb d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=peminjaman" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header">
                <h4 class="card-title"><?php echo $title ?></h4>
                <div class="col-sm-5 col-md-6">
                    <a href="?aksi=tambah-peminjaman" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Transaksi</a>
                </div>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <select name="length" id="example1_length" aria-controls="example2_length" required>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <input type="search" name="cari" aria-controls="example2_filter" id="example1_filter"
                                required>
                        </form>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <tr>
                                        <th class="text-center table-layout-2">No</th>
                                        <th class="text-center table-layout-2">NIM Anggota</th>
                                        <th class="text-center table-layout-2">Nama Anggota</th>
                                        <th class="text-center table-layout-2">Judul Buku</th>
                                        <th class="text-center table-layout-2">Tanggal Pinjam</th>
                                        <th class="text-center table-layout-2">Tanggal Kembali</th>
                                        <th class="text-center table-layout-2">Terlambat</th>
                                        <th class="text-center table-layout-2">Status</th>
                                        <th class="text-center table-layout-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $sql = $konfigs->query("SELECT transaksi.*, buku.id_buku, buku.judul_buku, anggota.nim, anggota.nama_anggota FROM transaksi LEFT JOIN buku ON transaksi.id_buku = buku.id_buku LEFT JOIN anggota ON transaksi.id_anggota = anggota.id_anggota WHERE transaksi.status = 'pinjam' order by transaksi.id_transaksi asc") or die(mysqli_error($konfigs));
                                        while($isi = mysqli_fetch_assoc($sql)){
                                            $expTgl_pinjam = explode("-", $isi['tgl_pinjam']);
                                            $expTgl_kembali = explode("-", $isi['tgl_kembali']);
                                    ?>
                                    <tr>
                                        <td class="text-center table-layout-2"><?php echo $no; ?></td>
                                        <td class="text-center table-layout-2"><?php echo $isi['nim']; ?></td>
                                        <td class="text-center table-layout-2"><?php echo $isi['nama_anggota']; ?></td>
                                        <td class="text-center table-layout-2" style="width: 180px; min-width: 100%;">
                                            <?php echo $isi['judul_buku']; ?>
                                        </td>
                                        <td class="text-center table-layout-2">
                                            <?php echo $expTgl_pinjam[2]."-".$expTgl_pinjam[1]."-".$expTgl_pinjam[0]; ?>
                                        </td>
                                        <td class="text-center table-layout-2">
                                            <?php echo $expTgl_kembali[2]."-".$expTgl_kembali[1]."-".$expTgl_kembali[0]; ?>
                                        </td>
                                        <td class="text-center table-layout-2">
                                            <?php 
                        	                    $denda = 1000;
                        	                    $tgl_dateline = $isi['tgl_kembali'];
                        	                    $tgl_kembali = date('d-m-Y');
                                                            
                        	                    $lambat = terlambat($tgl_dateline, $tgl_kembali);
                        	                    $denda1 = $lambat * $denda;
                                                            
                        	                    if($lambat > 0) { ?>
                                            <div style='color:red;'><?= $lambat ?> hari<br> (Rp.
                                                <?= number_format($denda1) ?>)</div>
                                            <?php
                        	                    } else {
                        	                    	echo $lambat . " Hari";
                        	                    }
                        	                ?>
                                        </td>
                                        <td class="text-center table-layout-2" style="width: 80px; min-width: 100%;">
                                            <?=$isi['status']; ?></td>
                                        <td class="text-center table-layout-2" style="width: 100px; min-width: 100%;">
                                            <a href="?aksi=kembali-peminjaman&id=<?=$isi['id_transaksi']; ?>&id_buku=<?=$isi['id_buku']; ?>"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-swatchbook fa-1x"></i>
                                            </a>
                                            <a href="?aksi=perpanjang-peminjaman&id=<?=$isi['id_transaksi']; ?>&id_buku=<?=$isi['id_buku']; ?>&lambat=<?=$lambat?>&tgl_kembali=<?=$isi['tgl_kembali']; ?>"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-book-reader fa-1x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>