<?php
include_once __DIR__ . "/commentaireTDG.PHP";

class Commentaire{

    private $commentaireID;   
    private $typeCom;
    private $dateCreation;
    private $contenu;
    private $parentID;
    
    public function __construct(){
    }

    //getters
    public function get_commentaireID(){
        return $this->commentaireID;
    }

    public function get_typeCom(){
        return $this->typeCom;
    }

    public function get_dateCreation(){
        return $this->dateCreation;
    }

    public function get_contenu(){
        return $this->contenu;
    }

    public function get_parentID(){
        return $this->parentID;
    }

    //setters
    public function set_contenu($contenu){
        $this->contenu = $contenu;
    }

    public function load_Commentaire($id){
        $TDG = CommentaireTDG::getInstance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->commentaireID = $res['commentaireID'];
        $this->typeCom = $res['typeCom'];
        $this->dateCreation = $res['dateCreation'];
        $this->contenu = $res['contenu'];
        $this->parentID = $res['parentID'];

        $TDG = null;
        return true;
    }

    public function update_commentaire_info($id, $contenu){

        if(!$this->load_Commentaire($id))
        {
          return false;
        }

        $TDG = CommentaireTDG::getInstance();
        $res = $TDG->update_contenu($contenu,$id);
        $this->contenu = $contenu;    
        $TDG = null;
        return $res;
    }

    public function ajouter_commentaire($typeCom,$contenu,$parentID){
        
        if(empty($typeCom) || empty($contenu) || empty($parentID))
        {
            return false;
        }
        
        $TDG = CommentaireTDG::get_Instance();
        $res = $TDG->add_commentaire($typeCom, $contenu, $parentID);
        $TDG = null;
        return $res;
    }
}
