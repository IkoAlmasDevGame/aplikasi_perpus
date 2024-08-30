<?php 

namespace model;

class pengaturan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function update($uid_jam, $jam_masuk, $uid, $nama, $status){
        # code Jam Masuk
        $uid_jam = htmlspecialchars($_POST['id_jam']) ? htmlentities($_POST['id_jam']) : strip_tags($_POST['id_jam']);
        $jam_masuk = htmlspecialchars($_POST['jam_masuk']) ? htmlentities($_POST['jam_masuk']) : strip_tags($_POST['jam_masuk']);
        # code Sistem Website
        $uid = htmlspecialchars($_POST['id_sistem']) ? htmlentities($_POST['id_sistem']) : strip_tags($_POST['id_sistem']);
        $nama = htmlspecialchars($_POST['developer']) ? htmlentities($_POST['developer']) : strip_tags($_POST['developer']);
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        if(isset($_POST['ubah'])){
            # code update 1
            $uJam = "UPDATE jam_masuk SET jam_masuk = '$jam_masuk' WHERE id_jam = '$uid_jam'";
            $this->db->query($uJam);
            # code update 2
            $uSistem = "UPDATE sistem SET developer = '$nama', status = '$status' WHERE id_sistem = '$uid'";
            $this->db->query($uSistem);
            # code interaksi
            echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
            die;
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=settings'</script>";
            die;
        }
    }
}
?>