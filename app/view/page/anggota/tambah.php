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
                        <a href="?page=anggota" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo $title2 ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=pendaftaran-anggota" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo $title ?></a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title"><?php echo $title;?></h4>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <div class="table-responsive">
                        <form action="?aksi=tambah-anggota" method="post">
                            <div class="d-flex justify-content-center align-items-center flex-wrap">
                                <div class="card col-sm-7 col-md-8 mt-3 mt-lg-3 bg-secondary">
                                    <div class="card-body mt-2 mt-lg-2 bg-secondary">
                                        <h4 class="card-header card-title text-center"><?php echo $title ?></h4>
                                        <!-- Code Form-Inline Start -->
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default 
                                                        display-4 fs-5 text-light">Nim Anggota</label>
                                                </div>
                                                <div class="col-sm-6 col-sm-7">
                                                    <input type="text" name="nim" maxlength="11" class="form-control"
                                                        placeholder="masukkan nim anggota ..." aria-required="TRUE"
                                                        inputmode="numeric" required id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default 
                                                        display-4 fs-5 text-light">Nama Anggota</label>
                                                </div>
                                                <div class="col-sm-6 col-sm-7">
                                                    <input type="text" name="nama_anggota" maxlength="100"
                                                        class="form-control" placeholder="masukkan nama anggota ..."
                                                        aria-required="TRUE" required id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default 
                                                        display-4 fs-5 text-light">Tempat Lahir</label>
                                                </div>
                                                <div class="col-sm-6 col-sm-7">
                                                    <input type="text" name="tempat_lahir" maxlength="255"
                                                        class="form-control"
                                                        placeholder="masukkan tempat lahir (anggota) ..."
                                                        aria-required="TRUE" required id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default 
                                                        display-4 fs-5 text-light">Tanggal Lahir</label>
                                                </div>
                                                <div class="col-sm-6 col-sm-7">
                                                    <input type="date" name="tanggal_lahir" maxlength=""
                                                        class="form-control"
                                                        placeholder="masukkan tanggal lahir (anggota) ..."
                                                        aria-required="TRUE" required id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default 
                                                        display-4 fs-5 text-light">Jenis Kelamin</label>
                                                </div>
                                                <div class="col-sm-6 col-sm-7">
                                                    <select name="jenis_kelamin" required aria-required="TRUE"
                                                        class="form-select" id="">
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="L">Laki - Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="form-label col-sm-4 col-md-4">
                                                    <label for="" class="label label-default 
                                                        display-4 fs-5 text-light">Prodi Kuliah</label>
                                                </div>
                                                <div class="col-sm-6 col-sm-7">
                                                    <input type="text" name="prodi_kuliah" maxlength="80"
                                                        class="form-control"
                                                        placeholder="masukkan prodi kuliah (anggota) ..."
                                                        aria-required="TRUE" required id="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Code Form-Inline Finish -->
                                        <div class="form-group">
                                            <div class="form-inline row justify-content-center align-items-center">
                                                <div class="col-sm-3 col-md-3 form-check ms-4 ms-lg-4">
                                                    <input type="checkbox" name="setuju" class="form-check-input">
                                                    <label for="" class="form-check-label text-light">
                                                        Klick ini Jika Setuju ...</label>
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
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>