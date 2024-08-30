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

                # Code ...
                $tgl_pinjam = date('Y-m-d');
                $tujuh_hari = mktime(0,0,0, date('n'), date('j') + 7, date('Y'));
                $kembali = date('Y-m-d', $tujuh_hari);
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
                die;
            }
        ?>
    </head>

    <body>
        <?php 
            require_once("../ui/sidebar.php");
        ?>
        <div class="panel container panel-default bg-body-secondary">
            <div class="panel-body">
                <h4 class="panel-heading panel-title"><?php echo $title ?></h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap mx-2">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page"
                            class="text-decoration-none text-primary">Beranda</a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=peminjaman" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo $title2 ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambah-peminjaman" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo $title ?></a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-2">
            <div class="card-header py-2">
                <h4 class="card-title text-black-50 text-center"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-2">
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="form-group col-sm-7 col-md-8 mb-3">
                        <div class="form-inline row justify-content-center align-items-center flex-wrap">
                            <div class="form-label col-sm-4 col-md-4">
                                <label for="" class="label label-default fs-5 display-4 text-black">
                                    Anggota Perpustakaan
                                </label>
                            </div>
                            <div class="col-sm-6 col-md-7">
                                <select name="id_anggota" required class="form-select" id="cmb_anggota">
                                    <option value="">Pilih Nama Anggota</option>
                                    <?php
                                    $data = $konfigs->query("SELECT * FROM anggota WHERE status_anggota = '1' order by id_anggota asc"); 
                                    while($pro = mysqli_fetch_array($data)){
                                    ?>
                                    <option value="<?php echo $pro['id_anggota']?>">
                                        <?php echo $pro['nim']." - ".$pro['nama_anggota'] ?>
                                    </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="?aksi=perjanjian" method="post">
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="card col-sm-7 col-md-8 bg-secondary">
                            <div class="card-body">
                                <div class="form-group mt-1">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="label label-default fs-5 display-4 text-light">
                                                Buku Perpustakaan
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <select name="id_buku" required class="form-select" id="cmb_anggota">
                                                <option value="">Pilih Buku Perpustakaan</option>
                                                <?php
                                                $data = $konfigs->query("SELECT * FROM buku order by id_buku asc"); 
                                                while($pri = mysqli_fetch_assoc($data)){
                                                ?>
                                                <option value="<?php echo $pri['id_buku']?>">
                                                    <?php echo $pri['id_buku']." - ".$pri['judul_buku'] ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="tampung mt-1"></div>
                                </div>
                                <div class="form-group mt-1">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="label label-default fs-5 display-4 text-light">
                                                Tanggal Peminjaman
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <input type="date" name="tgl_pinjam" value="<?php echo $tgl_pinjam; ?>"
                                                class="form-control date-formate" required aria-required="TRUE" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-1">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="label label-default fs-5 display-4 text-light">
                                                Tanggal Kembalian
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <input type="date" name="tgl_kembali" value="<?php echo $kembali; ?>"
                                                class="form-control date-formate" required aria-required="TRUE" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-1">
                                    <div class="form-inline row justify-content-center align-items-center flex-wrap">
                                        <div class="form-label col-sm-4 col-md-4">
                                            <label for="" class="label label-default fs-5 display-4 text-light">
                                                Status Peminjaman
                                            </label>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <input type="text" name="status" value="pinjam" readonly required
                                                aria-required="TRUE" class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-inline row justify-content-center align-items-center">
                                        <div class="col-sm-5 col-md-5 form-check ms-5 ms-lg-auto me-4 me-lg-4">
                                            <input type="checkbox" name="setuju" class="form-check-input">
                                            <label for="" class="form-check-label text-light">
                                                Klick ini Jika Setuju untuk peminjaman buku ...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-secondary container mt-1">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save fa-1x"></i>
                                            <span>Simpan data</span>
                                        </button>
                                        <a href="?page=beranda" aria-current="page"
                                            class="btn btn-outline-light">Cancel</a>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fa fa-eraser fa-1x"></i>
                                            <span>Hapus semua</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>