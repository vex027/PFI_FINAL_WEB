<?php
include_once __DIR__ . "/albumTDG.PHP";

class Album{

    private $albumID;
    private $title;
    private $authorID;
    private $description;
    private $date;

    public function __construct(){
    }

    public function get_id(){
        return $this->albumID;
    }

    public function get_title(){ 
        return $this->title;
    }

    public function get_authorID(){
        return $this->authorID;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_date(){
        return $this->date;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function set_description($description){
        $this->description = $description;
    }

    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
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

    public function add_album($title, $authorID, $description){

        if(empty($tile) || empty($authorID) || empty($description))
        {
            return false;
        }

        $TDG = AlbumTDG::get_instance();
        $res = $TDG->add_album($title, $authorID, $description);
        $TDG = null;
        return true;
    }

    public function update_album($description){

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

        $TDG = null;
        return $res;
    }

    public static function get_username_by_ID($id){
        $TDG = new UserTDG();
        $res = $TDG->get_by_id($id);
        $TDG = null;
        return $res["username"];
    }
}