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
        function fetchDataAnggota() {
            $.ajax({
                url: '../anggota/get_data.php', // Ganti dengan path ke file PHP Anda
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
        setInterval(fetchDataAnggota, 30000);
        // Fetch data saat pertama kali halaman dimuat
        fetchDataAnggota();
        </script>
    </head>

    <body onload="fetchDataAnggota();">
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
                        <a href="?page=anggota" aria-current="page" aria-label="Data Master"
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
                <a href="?page=anggota" aria-current="page" class="btn btn-info">
                    <i class="fa fa-refresh fa-1x"></i>
                    <span>Refresh Page</span>
                </a>
                <a href="?aksi=pendaftaran-anggota" aria-current="page" class="btn btn-danger">
                    <i class="fa fa-plus fa-1x"></i>
                    <span>Tambah Anggota</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <?php require_once("../anggota/function.php"); ?>
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
                        <div class="fs-6 d-flex justify-content-start align-items-start flex-wrap">
                            Status anggota :
                            <ol type="1">
                                <li>Jika Tidak Aktif akan berwarna abu - abu, dan</li>
                                <li>Jika Aktif akan berwarna biru</li>
                            </ol>
                        </div>
                        <div class="d-table">
                            <table class="table-layout" id="example1">
                                <thead>
                                    <tr>
                                        <th class="text-center table-layout-2">No.</th>
                                        <th class="text-center table-layout-2">Nim Anggota</th>
                                        <th class="text-center table-layout-2">Nama Anggota</th>
                                        <th class="text-center table-layout-2">Tempat Lahir</th>
                                        <th class="text-center table-layout-2">Tanggal Lahir</th>
                                        <th class="text-center table-layout-2">Jenis Kelamin</th>
                                        <th class="text-center table-layout-2">Prodi Kuliah</th>
                                        <th class="text-center table-layout-2">Status Anggota</th>
                                        <th class="text-center table-layout-2">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $data = $konfigs->query("SELECT * FROM anggota order by id_anggota asc");
                                        while($pro = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td class="text-center table-layout-2"><?php echo $no; ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['nim'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['nama_anggota'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['tempat_lahir'] ?></td>
                                        <td class="text-center table-layout-2"><?php echo $pro['tanggal_lahir'] ?></td>
                                        <td class="text-center table-layout-2">
                                            <?php if($pro['jenis_kelamin'] == 'L'){ echo "Laki - Laki"; }else{ echo "Perempuan"; } ?>
                                        </td>
                                        <td class="text-center table-layout-2"><?php echo $pro['prodi_kuliah'] ?></td>
                                        <td class="text-center table-layout-2">
                                            <form action="?aksi=status-konfirm" method="post">
                                                <input type="hidden" name="id_anggota"
                                                    value="<?php echo $pro['id_anggota']?>">
                                                <div class="form-switch form-check">
                                                    <input type="checkbox" name="status_anggota" value="0"
                                                        class="form-check-input" onchange="this.form.submit()"
                                                        <?php if($pro['status_anggota'] == "0"){?> checked <?php } ?>
                                                        required id=""> tidak aktif /
                                                    <input type="checkbox" name="status_anggota" value="1"
                                                        class="form-check-input" onchange="this.form.submit()"
                                                        <?php if($pro['status_anggota'] == "1"){?> checked <?php } ?>
                                                        required id=""> aktif
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-center table-layout-2">
                                            <a href="?aksi=ubah-anggota&id=<?php echo $pro['id_anggota']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin mengedit data anggota ini ?')"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit fa-1x"></i>
                                            </a>
                                            <a href="?aksi=hapus-anggota&id_anggota=<?php echo $pro['id_anggota']?>"
                                                aria-current="page"
                                                onclick="return confirm('Apakah anda ingin menghapus data anggota ini ?')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-alt fa-1x"></i>
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