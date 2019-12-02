<?php
include_once __DIR__ . "/imageTDG.PHP";

class Image{

    private $imageID;
    private $imageUrl;
    private $albumID;
    private $description;
    private $dateCreation;
    private $likes;

    public function __construct(){ }
    
    public function get_imageID(){
        return $this->imageID;
    }

    public function get_imageUrl(){
        return $this->imageUrl;
    }

    public function get_albumID(){
        return $this->albumID;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_dateCreation(){
        return $this->dateCreation;
    }

    public function get_likes(){
        return $this->likes;
    }

    public function set_imageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }

    public function set_albumID($albumID){
        $this->albumID = $albumID;
    }

    public function set_description($description){
        $this->description = $description;
    }

    public function set_dateCreation($dateCreation){
        $this->dateCreation = $dateCreation;
    }
    public function load_image($imageID){
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->get_by_id($imageID);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->imageID = $res['imageID'];
        $this->imageUrl = $res['imageUrl'];
        $this->albumID = $res['albumID'];
        $this->description = $res['description'];
        $this->dateCreation = $res['dateCreation'];
        $this->likes = $res['likes'];

        $TDG = null;
        return true;
    }

    public function update_image_description($imageID, $description){
        //load user infos
        if(!$this->load_image($imageID))
        {
          return false;
        }

        if(empty($this->imageID)){
          return false;
        }

        $this->description = $description;

        $TDG = ImageTDG::get_Instance(); // get instance -> voir albumTDG
        $res = $TDG->update_description($this->imageID, $this->description); 

        $TDG = null;
        return $res;
    }

    public static function add_image($imageUrl, $albumID, $description)
    {
        if(empty($imageUrl) || empty($albumID))
        {
            return false;
        }
        $TDG = ImageTDG::get_Instance();
        $TDG->add_image($imageUrl,$albumID,$description);
        $TDG=null;
        return true;
    }

    public function get_firstImagePosted($albumID)
    {
        $tdg = ImageTDG::get_Instance();
        $res = $tdg->get_firstImagePosted($albumID);
        $this->load_image($res['imageID']);
        return $res;
    }

    /*/public static function list_images_by_albums($albumID)
    {
        $TDG = ImageTDG::get_Instance();
        $res = $TDG->get_by_albumId($albumID);
        $TDG = null;
        return $res;
    }

    public static function create_image_list()
    {
        $imageList = array();
        $images = Image::list_images_by_albums();
        foreach($images as $res)
        {
            $image = new Image();
            $image->load_album($res['albumID']);
            array_push($imageList,$image);
        }
        return $imageList;
    }*/

    public function display()
    {


    }
}
