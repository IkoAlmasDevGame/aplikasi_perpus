<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
                require_once("../../../database/koneksi.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda';</script>";
                die;
            }
        ?>
        <script type="text/javascript">
        function fetchDataBuku() {
            $.ajax({
                url: '../buku/get_data.php', // Ganti dengan path ke file PHP Anda
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#data-container').html(JSON.stringify(data, null, 2));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#data-container').html('Error: ' + textStatus);
                }
            });
        }
        // Fetch data setiap 30 detik
        setInterval(fetchDataBuku, 30000);
        // Fetch data saat pertama kali halaman dimuat
        fetchDataBuku();
        </script>
    </head>

    <body onload="fetchDataBuku();">
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
                        <a href="?page=buku" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-header my-1">
                <h4 class="card-title"><?php echo $title ?></h4>
                <a href="?page=buku" aria-current="page" class="btn btn-info">
                    <i class="fa fa-refresh fa-1x"></i>
                    <span>Refresh Page</span>
                </a>
                <a href="?aksi=daftar-buku" aria-current="page" class="btn btn-danger">
                    <i class="fa fa-plus fa-1x"></i>
                    <span>Tambah Buku</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <?php require_once("../buku/function.php"); ?>
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
                        <div id="data-container" hidden></div>
                        <div class="d-table">
                            <table class="table-layout-buku" id="example1">
                                <thead>
                                    <tr>
                                        <th class="table-layout-2 text-center">No.</th>
                                        <th class="table-layout-2 text-center">Judul Buku</th>
                                        <th class="table-layout-2 text-center">Pengarang Buku</th>
                                        <th class="table-layout-2 text-center">Penerbit Buku</th>
                                        <th class="table-layout-2 text-center">Tahun Terbit</th>
                                        <th class="table-layout-2 text-center">I. S. B. N</th>
                                        <th class="table-layout-2 text-center">Jumlah Buku</th>
                                        <th class="table-layout-2 text-center">Lokasi Rak</th>
                                        <th class="table-layout-2 text-center">Tanggal Input</th>
                                        <th class="table-layout-2 text-center">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $table = "buku";
                                        $data = $konfigs->query("SELECT * FROM $table order by id_buku asc");
                                        while($pro = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td class="text-center table-layout-2"><?php echo $no; ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['judul_buku'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['pengarang_buku'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['penerbit_buku'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['tahun_terbit'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['isbn'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['jumlah_buku'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['lokasi_buku'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['tanggal_input'] ?></td>
                                        <td class="text-center table-layout-2">
                                            <a href="?aksi=hapus-buku&id_buku=<?php echo $pro['id_buku']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin menghapus buku ini ?')"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash-alt fa-1x"></i>
                                            </a>
                                            <a href="?aksi=ubah-buku&id=<?php echo $pro['id_buku']?>"
                                                aria-current="page" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit fa-1x"></i>
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