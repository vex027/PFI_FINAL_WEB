<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class CommentaireTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        Parent::__construct();
        $this->tableName = "Commentaire";
    }

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new CommentaireTDG();
        }
        return self::$_instance;
    }
    //create table
    public function createTable(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "create table if not exists Commentaire
            (
            commentaireID integer(10) auto_increment primary key,
            typeCom char(3) constraint type_commentaire check(type = 'IMG' or type = 'ALB'),
            dateCreation date not null,
            contenu LONGTEXT not null,
            parentID integer(10) not null,
            )";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }

        $conn = null;
        return $resp;
    }


    //drop table
    public function drop_table(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DROP TABLE $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        }


        catch(PDOException $e)
        {
            $resp = false;
        }

        $conn = null;
        return $resp;
    }


    public function get_by_id($id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE userID=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        return $result;
    }

    public function get_all_commentaire_albumId($limite,$albumid){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableNam where parentID = :albumID and typeCom = 'ALB' order by dateCreation limit :limite";
            $stmt->bindParam(':albumID', $albumid);
            $stmt->bindParam(':password', $limite);
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_all_commentaire_imageId($limite,$albumid){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableNam where parentID = :albumID and typeCom = 'IMG' order by dateCreation limit :limite";
            $stmt->bindParam(':albumID', $albumid);
            $stmt->bindParam(':password', $limite);
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function add_commentaire($typeCom, $contenu, $parentID){ // password déja hash

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (typeCom,dateCreation,contenu,parentID) VALUES (:typecom , :dateDreation , :contenu, :parentID)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':typeCom', $typeCom);
            $stmt->bindParam(':dateCreation', date("Y-m-d"));
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':parentID', $parentID);
            $stmt->execute();
            $resp =  true;
        }

        catch(PDOException $e)
        {
            $resp =  false;
        }
        $conn = null;
        return $resp;
    }

    public function update_contenu($contenu,$id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET contenu=:contenu WHERE userID=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }
        $conn = null;
        return $resp;
    }
}
