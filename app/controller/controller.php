<?php 
namespace controller;
use model\PeopleAuth;
class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new PeopleAuth($konfig);
    }

    public function SignIn(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $data = $this->konfig->Login($userInput, $password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

?>