<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class CommentaireTDG extends DBAO{
    private $tableName;
    private static $_instance = null;

    public function __construct(){
        Parent::__construct();
        $this->tableName = "commentaire";
    }

    public static function get_Instance(){
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
            $query = "create table if not exists $tableName
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
            $query = "SELECT * FROM $tableName WHERE commentaireID=:id";
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

    public function get_all_commentaire_albumId($albumid,$limite){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName where parentID=:albumID and typeCom = 'ALB' ORDER BY dateCreation LIMIT $limite";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumid);
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

    public function get_all_commentaire_imageId($imageId,$limite){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName where parentID = :imageId and typeCom = 'IMG' order by dateCreation limit $limite";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageId', $imageId);
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

    public function add_commentaire($typeCom, $contenu, $parentID,$authorID){ 

        try{
            $date = date("Y-m-d");
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (typeCom,dateCreation,contenu,parentID,authorID) VALUES (:typeCom , :dateCreation , :contenu, :parentID,:authorID)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':typeCom', $typeCom);
            $stmt->bindParam(':dateCreation', $date);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':parentID', $parentID);
            $stmt->bindParam(':authorID', $authorID);
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

    public function get_likes_number($commentID)
    {
        try{
            $conn = $this->connect();
            $tableName = "User_Comments_Likes";
            $query = "SELECT COUNT(:commentID) as likes FROM $tableName where commentID = :commentID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':commentID', $commentID);
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

    public function add_like($commentID,$userID)
    {
        try{
            $conn = $this->connect();
            $tableName = "User_Comments_Likes";
            $query = "INSERT INTO $tableName VALUES (:userID, :commentID)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':commentID', $commentID);
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
}
