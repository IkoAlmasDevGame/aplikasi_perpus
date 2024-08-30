<?php 
namespace model;

class memberList {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function statusCreate($status, $id_anggota){
        $status = htmlspecialchars($_POST['status_anggota']) ? htmlentities($_POST['status_anggota']) : strip_tags($_POST['status_anggota']);
        $id_anggota = htmlspecialchars($_POST['id_anggota']) ? htmlentities($_POST['id_anggota']) : strip_tags($_POST['id_anggota']);
        $table = "anggota";
        $update = "UPDATE $table SET status_anggota = '$status' WHERE id_anggota='$id_anggota'";
        $data = $this->db->query($update);
        if($data != null){
            if($data){
                echo "<script>document.location.href = '../ui/header.php?page=anggota'</script>";
                die;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=anggota'</script>";
            die;
        }
    }

    public function delete($id_akun){
        $id_akun = htmlspecialchars($_GET['id_anggota']) ? htmlentities($_GET['id_anggota']) : strip_tags($_GET['id_anggota']);
        $table = "anggota";
        $select = $this->db->query("SELECT * FROM $table WHERE id_anggota = '$id_akun'");
        $array = mysqli_fetch_array($select);

        if($array['id_anggota'] > 0){
            echo "<script><script>document.location.href = '../ui/hedaer.php?page=anggota'</script></script>";
            die;
        }else{
            $data = $this->db->query("DELETE FROM $table WHERE id_anggota = '$id_akun'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/hedaer.php?page=anggota'</script>";
                    die;
                    }
            }else{
                echo "<script>document.location.href = '../ui/hedaer.php?page=anggota&info=gagal'</script>";
                die;                
            }            
        }
    }

    public function CreateUpdate($nim,$nama,$tempat,$tanggal,$jenis,$prodi){
        $nim = htmlentities($_POST['nim']) ? htmlspecialchars($_POST['nim']) : strip_tags($_POST['nim']);
        $nama = htmlentities($_POST['nama_anggota']) ? htmlspecialchars($_POST['nama_anggota']) : strip_tags($_POST['nama_anggota']);
        $tempat = htmlentities($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir']) : strip_tags($_POST['tempat_lahir']);
        $tanggal = htmlentities($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : strip_tags($_POST['tanggal_lahir']);
        $jenis = htmlentities($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $prodi = htmlentities($_POST['prodi_kuliah']) ? htmlspecialchars($_POST['prodi_kuliah']) : strip_tags($_POST['prodi_kuliah']);
        $id_anggota = htmlentities($_POST['id_anggota']) ? htmlspecialchars($_POST['id_anggota']) : strip_tags($_POST['id_anggota']);

        # code ...
        $table = "anggota";
        $select = $this->db->query("SELECT * FROM $table WHERE id_anggota = '$id_anggota'");
        $select = mysqli_num_rows($select);

        if($select > 0){
            if(isset($_POST['ubahsetuju'])){
                $update = "UPDATE $table SET nim = '$nim', nama_anggota = '$nama', tempat_lahir = '$tempat',
                 tanggal_lahir = '$tanggal', jenis_kelamin = '$jenis', prodi_kuliah = '$prodi' WHERE id_anggota = '$id_anggota'";
                $data = $this->db->query($update);
                if($data != null){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?page=anggota&info=ubah'</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?page=ubah-anggota&id=$id_anggota'</script>";
                    die;                    
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=anggota&info=gagal'</script>";
                die;
            }
        }else{
            if(isset($_POST['setuju'])){
                $insert = "INSERT INTO $table SET nim = '$nim', nama_anggota = '$nama', tempat_lahir = '$tempat', 
                tanggal_lahir = '$tanggal', jenis_kelamin = '$jenis', prodi_kuliah = '$prodi', status_anggota = '1'";
                $data = $this->db->query($insert);
                if($data != null){
                    if($data){
                        echo "<script>document.location.href = '../ui/header.php?page=anggota&info=berhasil'</script>";
                        die;
                    }
                }else{
                    echo "<script>document.location.href = '../ui/header.php?page=pendaftaran-anggota'</script>";
                    die;                    
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=anggota&info=gagal'</script>";
                die;
            }
        }
    }
}

?>