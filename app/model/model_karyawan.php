<?php 
namespace model;

class PeopleAuth {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function table(){}
    public function create(){}
    public function delete(){}

    public function Login($userInput, $password){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        password_verify($password, PASSWORD_DEFAULT);

        if($userInput == "" || $password == ""){
            echo "<script>document.location.href = '../auth/index.php?info=kosong'</script>";
            die;
        }

        $table = "users";
        $sql = "SELECT * FROM $table WHERE username = '$userInput' and password = '$password' || email = '$userInput' and password = '$password'";
        $data = $this->db->query($sql);

        if(mysqli_num_rows($data) > 0){
            $response = array($userInput, $password);
            $response['users'] = array($userInput, $password);
            if($row = mysqli_fetch_assoc($data)){
                if($row['role'] == "superadmin"){
                    $_SESSION['status'] = true;
                    $_SERVER['HTTPS'] = "on";
                    // SESSION DataBase
                    $_SESSION['id'] = $row['id_akun'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "superadmin";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                }elseif($row['role'] == "admin"){
                    $_SESSION['status'] = true;
                    $_SERVER['HTTPS'] = "on";
                    // SESSION DataBase
                    $_SESSION['id'] = $row['id_akun'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['foto'] = $row['foto'];
                    $_SESSION['role'] = "admin";
                    echo "<script>document.location.href = '../page/ui/header.php?page=beranda';</script>";
                }
                $_COOKIE['cookies'] = $userInput;
                setcookie($response[$table], $row[$userInput], time() + (86400*30), "/");
                array_push($response['users'], $row);
                exit;
            }
        }else{
            $_SESSION['status'] = false;
            $_SERVER['HTTPS'] = "off";
            echo "<script>document.location.href = '../auth/index.php?info=gagal';</script>";
            exit;
        }
    }
}
?>