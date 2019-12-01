<?php
include_once __DIR__ . "/imageTDG.PHP";

class Image{

    private $imageId;
    private $imageUrl;
    private $parentID;
    private $description;
    private $dateCreation;
    private $likes;
    private $typeIMG;

    public function __construct(){
        
    }

    //getters
    public function get_imageId(){
        return $this->imageId;
    }

    public function get_imageUrl(){
        return $this->imageUrl;
    }

    public function get_parentID(){
        return $this->parentID;
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

    public function set_parentID($parentID){
        $this->parentID = $parentID;
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
        $this->parentID = $res['parentID'];
        $this->description = $res['description'];
        $this->dateCreation = $res['dateCreation'];
        $this->likes = $res['likes'];
        $this->type = $res['typeIMG'];

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

    public static function add_image($imageUrl, $parentID, $description, $dateCreation,$type)
    {
        
    }
}
