<?php 
require_once("../../../database/koneksi.php");
$hasil = mysqli_fetch_array($konfigs->query("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc"));
/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../model/model_karyawan.php");
$userAuth = new model\PeopleAuth($konfigs);
require_once("../../../model/model_anggota.php");
require_once("../../../model/model_buku.php");
require_once("../../../model/model_kategori.php");
require_once("../../../model/model_pengaturan.php");
require_once("../../../model/model_transaksi.php");
/* Files Controller */
require_once("../../../controller/controller.php");
$AuthUser = new controller\Authentication($konfigs);

// Action & Page 
if(!isset($_GET['page'])){
}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;
                        
        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../auth/index.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
}else{
    switch ($_GET['aksi']) {
        case 'value':
            # code...
            break;
            
        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>