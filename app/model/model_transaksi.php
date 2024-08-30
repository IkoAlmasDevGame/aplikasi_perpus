<?php 
namespace model;

class ListPeminjaman {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function LongReturn($uid,$id_buku,$tgl_kembali,$lambat){
        $uid = htmlspecialchars($_GET['id']) ? htmlentities($_GET['id']) : strip_tags($_GET['id']);
        $id_buku = htmlspecialchars($_GET['id_buku']) ? htmlentities($_GET['id_buku']) : strip_tags($_GET['id_buku']);
        $tgl_kembali = htmlspecialchars($_GET['tgl_kembali']) ? htmlentities($_GET['tgl_kembali']) : strip_tags($_GET['tgl_kembali']);
        $lambat = htmlspecialchars($_GET['lambat']) ? htmlentities($_GET['lambat']) : strip_tags($_GET['lambat']);
        if($lambat > 3){
            echo "";
            die;
        }else{
            $pecah_tgl_kembali = explode('-', $tgl_kembali);
	        $next7Hari = mktime(0,0,0, $pecah_tgl_kembali[1], $pecah_tgl_kembali[0] + 7, $pecah_tgl_kembali[2]);
	        $hari_next = date('Y-m-d', $next7Hari);
            # Code ...
            $sql = "UPDATE transaksi SET tgl_kembali = '$hari_next', id_buku = '$id_buku' WHERE id_transaksi = $uid";
            $data = $this->db->query($sql) or die(mysqli_errno($this->db));
            if($data != null){
                if($data){
                    echo "<script>alert('Perpanjang jangka waktu buku berhasil.'); document.location.href = '../ui/header.php?page=peminjaman';</script>";
                    die;
                }
            }else{
                echo "<script>alert('Perpanjang gagal.'); document.location.href = '../ui/header.php?page=peminjaman';</script>";
                die;
            }
        }
    }

    public function return($uid, $id_buku){
        $uid = htmlspecialchars($_GET['id']) ? htmlentities($_GET['id']) : strip_tags($_GET['id']);
        $id_buku = htmlspecialchars($_GET['id_buku']) ? htmlentities($_GET['id_buku']) : strip_tags($_GET['id_buku']);
        $this->db->query("UPDATE transaksi SET status = 'kembali' WHERE id_transaksi = $uid");
        $this->db->query("UPDATE buku SET jumlah_buku = (jumlah_buku+1) WHERE id_buku = '$id_buku'");
        echo "<script>alert('Proses, kembalian buku berhasil.'); document.location.href = '../ui/header.php?page=peminjaman';</script>";
        die;
    }

    public function create($id_buku,$id_anggota,$nim,$tgl_pinjam,$tgl_kembali,$status){
        if(isset($_POST['setuju'])){
            $id_buku = htmlspecialchars($_POST['id_buku']) ? htmlentities($_POST['id_buku']) : strip_tags($_POST['id_buku']);
            $id_anggota = htmlspecialchars($_POST['id_anggota']) ? htmlentities($_POST['id_anggota']) : strip_tags($_POST['id_anggota']);
            $nim = htmlspecialchars($_POST['nim']) ? htmlentities($_POST['nim']) : strip_tags($_POST['nim']);
            $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']) ? htmlentities($_POST['tgl_pinjam']) : strip_tags($_POST['tgl_pinjam']);
            $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']) ? htmlentities($_POST['tgl_kembali']) : strip_tags($_POST['tgl_kembali']);
            $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);

            $sql = $this->db->query("SELECT * FROM buku WHERE id_buku = '$id_buku'") or die(mysqli_errno($this->db));
            while($data = $sql->fetch_assoc()){
                $sisa = $data['jumlah_buku'];
                if($sisa == 0){
                    echo "<script>alert('Stok Buku Habis, Transaksi, tidak dapat dilakukan, silahkan tambahkan stok buku dulu.'); document.location.href = '../ui/header.php?aksi=tambah-peminjaman';</script>";
                    die;
                }else{
                    $this->db->query("INSERT INTO transaksi SET id_buku = '$id_buku', id_anggota = '$id_anggota', nim = '$nim', tgl_pinjam = '$tgl_pinjam', tgl_kembali = '$tgl_kembali', status = '$status'");
                    $this->db->query("UPDATE buku SET jumlah_buku = (jumlah_buku-1) WHERE id_buku = '$id_buku'") or die(mysqli_errno($this->db));
                    echo "<script>alert('Data transaksi berhasil ditambahkan.'); document.location.href = '../ui/header.php?page=peminjaman'</script>";
                    die;
                }
            }
        }
    }
}
?>