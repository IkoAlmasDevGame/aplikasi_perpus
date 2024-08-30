<?php 
require_once("../../../database/koneksi.php");
$hasil = mysqli_fetch_array($konfigs->query("SELECT * FROM sistem WHERE status = '1' order by id_sistem asc"));
/* Files Model & Files Controller */ 
/* Files Model */
require_once("../../../model/model_karyawan.php");
$userAuth = new model\PeopleAuth($konfigs);
require_once("../../../model/model_anggota.php");
$member = new model\memberList($konfigs);
require_once("../../../model/model_buku.php");
$list = new model\bukuList($konfigs);
require_once("../../../model/model_kategori.php");
require_once("../../../model/model_pengaturan.php");
$pengaturan = new model\pengaturan($konfigs);
require_once("../../../model/model_transaksi.php");
$peminjaman = new model\ListPeminjaman($konfigs);
require_once('../../../model/model_absensi.php');
$absensi = new model\absensi($konfigs);
require_once("../../../model/model_keterangan.php");
$keterangan = new model\keterangan($konfigs);
/* Files Controller */
require_once("../../../controller/controller.php");
$AuthUser = new controller\Authentication($konfigs);
$attedance = new controller\attedance($konfigs);
$document = new controller\document($konfigs);
$anggota = new controller\AnggotaList($konfigs);
$buku = new controller\ListBook($konfigs);
$setting = new controller\settings($konfigs);
$transaksi = new controller\Peminjaman($konfigs);

// Action & Page 
if(!isset($_GET['page'])){
}else{
    switch($_GET['page']){
        case 'beranda':
            require_once("../dashboard/index.php");
            break;
            
        case 'karyawan':
            $title = "Data Master Karyawan";
            require_once("../karyawan/karyawan.php");
            break;
            
        case 'absensi':
            $title = "Data Master absensi";
            require_once("../absensi/absensi.php");
            break;
            
        case 'keterangan':
            $title = "Data Master keterangan";
            require_once("../keterangan/keterangan.php");
            break;
            
        case 'settings':
            $title = "Data Master pengaturan";
            require_once("../pengaturan/pengaturan.php");
            break;

        # Master Jabatan Admin
  
        case 'anggota':
            $title = "Data Master anggota";
            require_once("../anggota/anggota.php");
            break;
  
        case 'buku':
            $title = "Data Master buku";
            require_once("../buku/buku.php");
            break;
  
        // case 'kategori':
        //     $title = "Data Master kategori lokasi buku";
        //     require_once("../kategori/kategori.php");
        //     break;
  
        case 'peminjaman':
            $title = "Data Master peminjaman buku";
            require_once("../transaksi/peminjaman.php");
            break;
  
        case 'pengembalian':
            $title = "Data Master Pengembalian buku";
            require_once("../transaksi/pengembalian.php");
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
        # Master Absensi
        case 'absensi-karyawan':
            require_once("../absensi/tambah.php");
            break;
            case 'simpan-absensi':
                $attedance->attdance();
                break;
        # Master Absensi

        # Master Pengaturan
        case 'update-settings':
            $setting->edit();
            break;
        # Master Pengaturan

        # Master Peminjaman
        case 'tambah-peminjaman':
            $title = "Tambah Peminjaman Buku";
            $title2 = "Data Master peminjaman buku";
            require_once("../transaksi/tambah.php");
            break;
        case 'kembali-peminjaman':
            $transaksi->pengembalian();
            break;
        case 'perpanjang-peminjaman':
            $transaksi->perpanjang();
            break;
            case 'perjanjian':
                $transaksi->buatPerjanjian();
                break;
        # Master Peminjaman

        # Master Anggota
        case 'pendaftaran-anggota':
            $title2 = "Data Master anggota";
            $title = "Pendaftaran anggota baru";
            require_once("../anggota/tambah.php");
            break;
        case 'ubah-anggota':
            $title2 = "Data Master anggota";
            $title = "ubah anggota baru";
            require_once("../anggota/ubah.php");
            break;
            case 'tambah-anggota':
                $anggota->buatedit();
                break;
            case 'status-konfirm':
                $anggota->status();
                break;
            case 'hapus-anggota':
                $anggota->hapus();
                break;
        # Master Anggota

        # Master Keterangan
        case 'keterangan-karyawan':
            require_once("../keterangan/tambah.php");
            break;
            case 'simpan-keterangan':
                $document->buat_keterangan();
                break;
        # Master Keterangan

        # Master Karyawan
        case 'pendaftaran-karyawan':
            $title = "Pendaftaran Karyawan Baru";
            require_once("../karyawan/tambah.php");
            break;
        case 'ubah-karyawan':
            $title = "ubah Karyawan";
            require_once("../karyawan/ubah.php");
            break;
            case 'tambah-karyawan':
                $AuthUser->buatedit();
                break;
            case 'hapus-karyawan':
                $AuthUser->hapus();
                break;
        # Master Karyawan

        # Master Buku
        case 'daftar-buku':
            $title2 = "Data Master Buku";
            $title = "Pendaftaran Buku baru";
            require_once("../buku/tambah.php");
            break;
        case 'ubah-buku':
            $title2 = "Data Master Buku";
            $title = "ubah Buku baru";
            require_once("../buku/ubah.php");
            break;
            case 'tambah-buku':
                $buku->buatedit();
                break;
            case 'hapus-buku':
                $buku->hapus();
                break;
        # Master Buku
            
        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>