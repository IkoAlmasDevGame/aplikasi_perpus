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
                        <a href="?page=buku" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo $title2 ?></a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=ubah-buku&id=<?php echo $_GET['id']?>" aria-current="page"
                            class="text-decoration-none text-primary"><?php echo $title ?></a>
                    </li>
                </div>
            </div>
        </div>
        <div class="card container mb-4">
            <div class="card-header py-2">
                <h4 class="card-title"><?php echo $title ?></h4>
            </div>
            <div class="card-body mt-1">
                <div class="container">
                    <?php if(isset($_GET['id'])){ ?>
                    <?php
                        $uid = htmlspecialchars($_GET['id']);
                        $data = $konfigs->query("SELECT * FROM buku WHERE id_buku = '$uid'");
                        while($isi = mysqli_fetch_array($data)){
                            $number = explode('-', $isi['isbn']);
                    ?>
                    <form action="?aksi=tambah-buku" method="post">
                        <input type="hidden" name="id_buku" value="<?php echo $uid;?>">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="card col-sm-7 col-md-8 mt-3 mt-lg-3 bg-secondary">
                                <div class="card-body mt-1 bg-secondary">
                                    <h4 class="card-header card-title text-center"><?php echo $title; ?></h4>
                                    <!--  -->
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Judul Buku</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="judul_buku"
                                                    value="<?php echo $isi['judul_buku']?>" class="form-control"
                                                    maxlength="200" placeholder="masukkan judul buku ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Pengarang Buku</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="pengarang_buku"
                                                    value="<?php echo $isi['pengarang_buku']?>" class="form-control"
                                                    maxlength="200" placeholder="masukkan pengarang buku ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Penerbit Buku</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" name="penerbit_buku"
                                                    value="<?php echo $isi['penerbit_buku']?>" class="form-control"
                                                    maxlength="200" placeholder="masukkan Penerbit buku ..." required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Tahun Terbit</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <select name="tahun_terbit" required aria-required="TRUE"
                                                    class="form-select" id="">
                                                    <option value="">Pilih Tahun Terbit</option>
                                                    <?php 
                                                        $year = date('Y');
                                                        for($i=$year - 34; $i <= $year; $i++){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"
                                                        <?php if($isi['tahun_terbit'] == $i){?> selected <?php } ?>>
                                                        <?php echo $i; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">I. S. B. N</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="hidden" name="isbn" value="<?php echo $isi['isbn']?>">
                                                <input type="text" name="number1" readonly
                                                    class="col-sm-2 col-md-2 border rounded-1 text-center"
                                                    value="<?php echo $number[0]; ?>" maxlength="5" required
                                                    aria-required="TRUE" id=""> -
                                                <input type="text" name="number2" readonly
                                                    value="<?php echo $number[1]; ?>" maxlength="5"
                                                    class="col-sm-2 col-md-2 border rounded-1 text-center" required
                                                    aria-required="TRUE" id=""> -
                                                <input type="text" name="number3" readonly
                                                    value="<?php echo $number[2]; ?>" maxlength="5"
                                                    class="col-sm-2 col-md-2 border rounded-1 text-center" required
                                                    aria-required="TRUE" id=""> -
                                                <input type="text" name="number4" readonly
                                                    value="<?php echo $number[3]; ?>" maxlength="5"
                                                    class="col-sm-2 col-md-2 border rounded-1 text-center" required
                                                    aria-required="TRUE" id=""> -
                                                <input type="text" name="number5" readonly
                                                    value="<?php echo $number[4]; ?>" maxlength="5"
                                                    class="col-sm-2 col-md-2 border rounded-1 text-center" required
                                                    aria-required="TRUE" id="">
                                                <small class="text-light fs-5 display-4">International Standart Book
                                                    Number</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Jumlah Buku</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <input type="text" inputmode="numeric" name="jumlah_buku"
                                                    class="form-control" maxlength="64"
                                                    value="<?php echo $isi['jumlah_buku']?>"
                                                    placeholder="masukkan Jumlah buku ..." required aria-required="TRUE"
                                                    id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Lokasi Buku</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <select name="lokasi_buku" required aria-required="TRUE"
                                                    class="form-select" id="">
                                                    <option value="">Pilih Lokasi Rak</option>
                                                    <?php 
                                                    $select = array("Umum", "Filsafat dan Psikologi", "Agama", "Sosial", "Bahasa",
                                                     "Sains dan Matematika", "Teknologi", "Seni dan Rekreasi", "Literartur dan Sastra", 'Sejarah dan Geografi');
                                                    $jlh_select = count($select);
                                                    $select1 = array('01', '02', '03', '04', '05', '06', '07', '08', '9', '10');
                                                    $no = 1;
                                                    for($c = 0; $c < $jlh_select; $c += 1){
                                                    ?>
                                                    <option value="<?php echo $select[$c]; ?>"
                                                        <?php if($isi['lokasi_buku'] == $select[$c]){?> selected
                                                        <?php } ?>>
                                                        <?php echo $select1[$c]." - ".$select[$c]; ?>
                                                    </option>
                                                    <?php
                                                    $no++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-1">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <label for="" class="label label-default fs-4
                                                 display-4 text-light">Tanggal Input</label>
                                            </div>
                                            <div class="col-sm-6 col-md-7">
                                                <?php $date = date('Y-m-d'); ?>
                                                <input type="date" name="tanggal_input" readonly
                                                    class="form-control date-formate"
                                                    value="<?php echo $isi['tanggal_input']; ?>" required
                                                    aria-required="TRUE" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <div class="form-inline row justify-content-center align-items-center">
                                            <div class="col-sm-3 col-md-3 form-check ms-4 ms-lg-4">
                                                <input type="checkbox" name="ubahsetuju" class="form-check-input">
                                                <label for="" class="form-check-label text-light">
                                                    Klick ini Jika Setuju ...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-secondary container mt-1">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save fa-1x"></i>
                                                <span>Update data</span>
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
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>