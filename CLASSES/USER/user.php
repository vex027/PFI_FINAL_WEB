<?php
include_once __DIR__ . "/userTDG.PHP";

class User{

    private $userId;   
    private $username;
    private $email;
    private $password;
    private $imageProfile
    
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

    public function get_imagesProfile(){
        return $this->$imageProfile;
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
        $TDG = new UserTDG();
        $res = $TDG->get_by_email($email);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];

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
    public function validate_email_not_exists($email){
        $TDG = new UserTDG();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }

    public function register($email, $username, $pw, $vpw){

        //check is both password are equals
        if(!($pw === $vpw) || empty($pw) || empty($vpw))
        {
            return false;
        }

        //check if email is used
        if(!$this->validate_email_not_exists($email))
        {
            return false;
        }

        //add user to DB
        $TDG = new UserTDG();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT));
        $TDG = null;
        return true;
    }

    public function update_user_info($email, $newmail, $newname){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($this->id) || empty($newmail) || empty($newname)){
          return false;
        }

        //check if email is already used
        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }

        $this->email = $newmail;
        $this->username = $newname;

        $TDG = new UserTDG();
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

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        //check if passed param are valids
        if(empty($pw) || $pw != $pwv){
          return false;
        }

        //verify password
        if(!password_verify($oldpw, $this->password))
        {
            return false;
        }

        //create TDG and update to new hash
        $TDG = new UserTDG();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->password = $NHP;
        $TDG = null;
        //only return true if update_user_pw returned true
        return $res;
    }

    public static function get_username_by_ID($id){
        $TDG = new UserTDG();
        $res = $TDG->get_by_id($id);
        $TDG = null;
        return $res["username"];
    }
}
