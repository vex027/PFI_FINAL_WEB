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

    public function load_album($id){
        $TDG = AlbumTDG::get_instance();
        $res = $TDG->get_by_id($id);
    
        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $this->albumID = $res['albumId'];
        $this->title = $res['title'];
        $this->authorID = $res['authorID'];
        $this->description = $res['description'];
        $this->date = $res['date'];

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

    public function update_description($description,$albumID){

        if(!$this->load_album($albumID))
        {
            return false;
        }

        if(empty($description)){
            return false;
        }

        $this->description = $description;

        $TDG = AlbumTDG::get_instance();
        $res = $TDG->update_description($albumID);

        $TDG = null;
        return $res;
    }
}