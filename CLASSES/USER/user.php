<?php
include_once __DIR__ . "/userTDG.PHP";

class User{

    private $userId;   
    private $username;
    private $email;
    private $password;
    private $imageProfile;
    
    public function __construct(){

    }

    //getters
    public function get_id(){
        return $this->userId;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->password;
    }

    public function get_imagesProfile()
    {
        if(!file_exists($this->imageProfile))
        {
            $this->update_user_image($this->email,"Images_Profil/default.jpg");
        }
        return $this->imageProfile;
    }

    //setters
    public function set_email($email){
        $this->email = $email;
    }

    public function set_username($username){
        $this->username = $username;
    }

    public function set_password($password){
        $this->password = $password;
    }

    public function set_imageProfile($imageProfile){
        $this->imageProfile = $imageProfile;
    }


    public function load_user($email){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->userId = $res['userID'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];

        $TDG = null;
        return true;
    }

    public function load_user_username($username){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_username($username);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->userId = $res['userID'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->imageProfile =$res['imageProfil'];

        $TDG = null;
        return true;
    }


    //Login Validation
    public function Login($email, $pw){

        // Regarde si l'utilisateur existes deja
        if(!$this->load_user($email))
        {
            return false;
        }

        // Regarde si le password est verifiable
        if(!password_verify($pw, $this->password))
        {
            return false;
        }

        return true;
    }

    //Register Validation
    public static function validate_email_not_exists($email){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }
        return true;
    }

    public static function validate_username_not_exists($username){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_username($username);
        $TDG = null;
        if($res)
        {
            return false;
        }
        return true;
    }

    public function register($email, $username, $pw, $vpw){


        if(!($pw === $vpw) || empty($pw) || empty($vpw))
        {
            return false;
        }

        if(!$this->validate_email_not_exists($email))
        {
            return false;
        }

        $TDG = UserTDG::getInstance();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT));
        $TDG = null;
        return true;
    }

    public function update_user_info($email, $newmail, $newname){


        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($this->id) || empty($newmail) || empty($newname)){
          return false;
        }

        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }

        $this->email = $newmail;
        $this->username = $newname;

        $TDG = UserTDG::getInstance();
        $res = $TDG->update_info($this->email, $this->username, $this->id);

        if($res){
          $_SESSION["userName"] = $this->username;
          $_SESSION["userEmail"] = $this->email;
        }

        $TDG = null;
        return $res;
    }

    /*
      @var: current $email, oldpw, new pw, newpw validation
    */
    public function update_user_pw($email, $oldpw, $pw, $pwv){


        if(!$this->load_user($email))
        {
          return false;
        }


        if(empty($pw) || $pw != $pwv){
          return false;
        }

        if(!password_verify($oldpw, $this->password))
        {
            return false;
        }

        $TDG = UserTDG::getInstance();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->password = $NHP;
        $TDG = null;

        return $res;
    }


    public function update_user_image($email,$imageProfile){
        if(!$this->load_user($email))
        {
          return false;
        }
        if(empty($imageProfile)){
          return false;
        }
        $TDG = UserTDG::getInstance();
        $res = $TDG->update_image($this->userId, $imageProfile);
        $this->set_imageProfile($imageProfile);
        $TDG = null;

        return $res;
    }

    public static function get_username_by_ID($id){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_id($id);
        $TDG = null;
        return $res["username"];
    }

    public static function user_exists($id)
    {
        $res = get_username_by_ID($id);
        if($res ==null){
            return false;
        }
        return true;
    }
}
