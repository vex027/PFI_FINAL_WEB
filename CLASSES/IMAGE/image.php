<?php
include_once __DIR__ . "/userTDG.PHP";

class Image{

    private $imageId;
    private $imageUrl;
    private $albumId;
    private $description;
    private $dateCreation;

    public function __construct(){
        
    }

    //getters
    public function get_imageId(){
        return $this->imageId;
    }

    public function get_imageUrl(){
        return $this->imageUrl;
    }

    public function get_albumId(){
        return $this->albumId;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_dateCreation(){
        return $this->dateCreation;
    }

    //setters
    public function set_imageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }

    public function set_albumId($albumId){
        $this->albumId = $albumId;
    }

    public function set_description($description){
        $this->description = $description;
    }

    public function set_dateCreation($dateCreation){
        $this->dateCreation = $dateCreation;
    }

    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_image($imageId){
        $TDG = new ImageTDG();
        $res = $TDG->get_by_imageId($imageId);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->imageId = $res['imageId'];
        $this->imageUrl = $res['imageUrl'];
        $this->albumId = $res['albumId'];
        $this->description = $res['description'];
        $this->dateCreation = $res['dateCreation'];

        $TDG = null;
        return true;
    }

    public function update_image_description($imageId, $description){

        //load user infos
        if(!$this->load_image($imageId))
        {
          return false;
        }

        if(empty($this->imageId)){
          return false;
        }

        $this->description = $description;

        $TDG = ImageTDG::getInstance(); // get instance -> voir albumTDG
        $res = $TDG->update_description($this->imageId, $this->description); 

        $TDG = null;
        return $res;
    }
}
