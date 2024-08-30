<?php 
namespace model;

class bukuList {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUpdate($judul, $pengarang, $penerbit, $tahun, $isbn, $jumlah, $lokasi, $tanggal){
        $judul = htmlentities($_POST['judul_buku']) ? htmlspecialchars($_POST['judul_buku']) : strip_tags($_POST['judul_buku']);
        $pengarang = htmlentities($_POST['pengarang_buku']) ? htmlspecialchars($_POST['pengarang_buku']) : strip_tags($_POST['pengarang_buku']);
        $penerbit = htmlentities($_POST['penerbit_buku']) ? htmlspecialchars($_POST['penerbit_buku']) : strip_tags($_POST['penerbit_buku']);
        $tahun = htmlentities($_POST['tahun_terbit']) ? htmlspecialchars($_POST['tahun_terbit']) : strip_tags($_POST['tahun_terbit']);
        $isbn = htmlspecialchars($_POST['number1'])."-".htmlspecialchars($_POST['number2'])."-".htmlspecialchars($_POST['number3'])."-".htmlspecialchars($_POST['number4'])."-".htmlspecialchars($_POST['number5']);
        $jumlah = htmlentities($_POST['jumlah_buku']) ? htmlspecialchars($_POST['jumlah_buku']) : strip_tags($_POST['jumlah_buku']);
        $lokasi = htmlentities($_POST['lokasi_buku']) ? htmlspecialchars($_POST['lokasi_buku']) : strip_tags($_POST['lokasi_buku']);
        $tanggal = htmlentities($_POST['tanggal_input']) ? htmlspecialchars($_POST['tanggal_input']) : strip_tags($_POST['tanggal_input']);
        $uid = htmlentities($_POST['id_buku']) ? htmlspecialchars($_POST['id_buku']) : strip_tags($_POST['id_buku']);

        $table = "buku";
        $select = $this->db->query("SELECT * FROM $table WHERE id_buku = '$uid'");
        $select = mysqli_num_rows($select);

        if($select > 0){
            if(isset($_POST['ubahsetuju'])){
                $update = "UPDATE $table SET judul_buku = '$judul', pengarang_buku = '$pengarang', penerbit_buku = '$penerbit', tahun_terbit = '$tahun', 
                isbn = '$isbn', jumlah_buku = '$jumlah', lokasi_buku = '$lokasi', tanggal_input = '$tanggal' WHERE id_buku = '$uid'";
                $data = $this->db->query($update);
                if($data != null){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?page=buku&info=ubah';</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?page=buku';</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?aksi=ubah-buku&id=$uid';</script>";
                die;
            }
        }else{
            if(isset($_POST['setuju'])){
                $insert = "INSERT INTO $table SET judul_buku = '$judul', pengarang_buku = '$pengarang', penerbit_buku = '$penerbit', tahun_terbit = '$tahun', 
                isbn = '$isbn', jumlah_buku = '$jumlah', lokasi_buku = '$lokasi', tanggal_input = '$tanggal'";
                $data = $this->db->query($insert);
                if($data != null){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?page=buku&info=berhasil';</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?page=buku&info=gagal';</script>";
                    die;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?aksi=daftar-buku';</script>";
                die;
            }
        }
    }

    public function delete($id_buku){
        $id_buku = htmlspecialchars($_GET['id_buku']) ? htmlentities($_GET['id_buku']) : strip_tags($_GET['id_buku']);
        $table = "buku";
        $select = $this->db->query("SELECT * FROM $table WHERE id_buku = '$id_buku'");
        $array = mysqli_fetch_array($select);

        if($array['id_buku'] > 0){
            echo "<script><script>document.location.href = '../ui/hedaer.php?page=buku'</script></script>";
            die;
        }else{
            $data = $this->db->query("DELETE FROM $table WHERE id_buku = '$id_buku'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/hedaer.php?page=buku'</script>";
                    die;
                    }
            }else{
                echo "<script>document.location.href = '../ui/hedaer.php?page=buku&info=gagal'</script>";
                die;                
            }            
        }
    }
}

?>