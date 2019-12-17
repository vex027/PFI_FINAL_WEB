<?php
include_once __DIR__ . "/userTDG.PHP";

class User{

    private $userID;   
    private $username;
    private $email;
    private $password;
    private $imageProfile;
    
    public function __construct(){}

    public function get_id(){
        return $this->userID;
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
        return $this->imageProfile;
    }

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

        $this->userID = $res['userID'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->imageProfile = $res['imageProfil'];

        $TDG = null;
        return true;
    }

    public function load_user_id($id){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->userID = $res['userID'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->imageProfile = $res['imageProfil'];

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

        $this->userID = $res['userID'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->imageProfile =$res['imageProfil'];

        $TDG = null;
        return true;
    }

    public function Login($email, $pw){

        if(!$this->load_user($email))
        {
            return false;
        }
        if(!password_verify($pw, $this->password))
        {
            return false;
        }

        return true;
    }

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

        if(!$this->validate_username_not_exists($username))
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

        if(empty($this->userID) || empty($newmail) || empty($newname)){
          return false;
        }

        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }

        if(!$this->validate_username_not_exists($newname) && $this->username != $newname)
        {
            return false;
        }

        $this->email = $newmail;
        $this->username = $newname;

        $TDG = UserTDG::getInstance();
        $res = $TDG->update_info($this->email, $this->username, $this->userID);

        if($res){
          $_SESSION["userName"] = $this->username;
          $_SESSION["userEmail"] = $this->email;
        }

        $TDG = null;
        return $res;
    }

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
        $res = $TDG->update_image($this->userID, $imageProfile);
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
    
    public static function list_all_user_like_username($username)
    {
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_like_username($username);
        $TDG = null;
        return $res;
    }
    public static function create_user_list_like_username($username)
    {
        $userList = array();
        $users = User::list_all_user_like_username($username);
        foreach($users as $res)
        {
            $user = new User();
            $user->load_user($res['email']);
            array_push($userList,$user);
        }
        return $userList;
    }

    public function display_user(){
        $img = $this->get_imagesProfile();
        $name = $this->get_username();
        echo "<div class='card bg-light'>";
        echo "<div class='card-footer'>";
        echo "<p class='card-text'><a class='text-decoration-none' href='profile.php?username=$name'>$name</a></p>";
        echo "<a href='profile.php?username=$name'><img src='$img' class='img-thumbnail' style='width:20%;height:60%'></a>";
        echo "</div>";
        echo "</div>";
    }
}
