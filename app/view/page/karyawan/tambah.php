<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <?php 
            if($_SESSION['role'] == "superadmin"){
                require_once("../ui/header.php");
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=beranda';</script>";
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
                        <a href="?aksi=pendaftaran-karyawan" aria-current="page" aria-label="Data Master"
                            class="text-decoration-none text-primary">
                            <?php echo $title ?>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-header">
                <?php require_once("../karyawan/function.php"); ?>
            </div>
            <div class="card-body mt-4">
                <div class="container">
                    <form action="?aksi=tambah-karyawan" enctype="multipart/form-data" method="post">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="card col-sm-7 col-md-8">
                                <div class="card-body mt-1 bg-secondary">
                                    <div class="card-header card-title text-center text-light shadow-sm bg-secondary">
                                        <?php echo $title ?>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">User Name</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="username" maxlength="100" class="form-control"
                                                    placeholder="masukkan username karyawan baru ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Nama Karyawan</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="nama" maxlength="80" class="form-control"
                                                    placeholder="masukkan nama karyawan ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">E - Mail</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="email" name="email" maxlength="255" class="form-control"
                                                    placeholder="masukkan email karyawan baru ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Password</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="password" name="password" maxlength="255"
                                                    class="form-control"
                                                    placeholder="masukkan password karyawan baru ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Repassword</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="password" name="password" maxlength="255"
                                                    class="form-control"
                                                    placeholder="masukkan ulangi password karyawan baru ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1 mt-lg-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Jabatan Karyawan</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <select name="role" required aria-required="TRUE" aria-disabled="false"
                                                    class="form-select" id="">
                                                    <option value="">Pilih Jabatan Karyawan</option>
                                                    <option value="admin">Admin Perpustakaan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center
                                             align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-5 text-light">Photo</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <div class="form-icon img-thumbnail w-25">
                                                    <img src="../../../../assets/admin/user_logo.png" id="preview"
                                                        alt="" width="64" class="img-rounded img-fluid">
                                                </div>
                                                <div class="form-control mt-1">
                                                    <input type="file" name="foto" accept="image/*"
                                                        class="form-control-file" required onchange="previewImage(this)"
                                                        aria-required="true">
                                                </div>
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
        <?php require_once("../ui/footer.php") ?>