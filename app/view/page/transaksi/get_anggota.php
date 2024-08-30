<?php 
require_once("../../../database/koneksi.php");
$tamp = htmlspecialchars($_POST["tamp"]);
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];

$sql = "SELECT * FROM anggota WHERE id_anggota = '$kode_bar' and status_anggota = '1' order by id_anggota asc";
$data = $konfigs->query($sql);
    while($row = mysqli_fetch_array($data)) {
?>
<input type="hidden" name="id_anggota" value="<?php echo $kode_bar; ?>" id="id_anggota">
<div class="form-inline row justify-content-center align-items-center mt-2 mb-3">
    <div class="form-label col-sm-4 col-md-4">
        <label for="" class="label label-default fs-5 display-4 text-light">Nim Anggota</label>
    </div>
    <div class="col-sm-6 col-md-7">
        <input type="text" name="nim" value="<?php echo $row['nim']?>" aria-required="TRUE" readonly required id="nim"
            class="form-control">
    </div>
</div>
<?php
}
?>