<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class AlbumTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    private function __construct(){
        Parent::__construct();
        $this->tableName = "album";
    }

    public function getInstance(){
        if(is_null($this->_instance)){
            $this->_instance = new AlbumTDG();
        }
        return $this->_instance;
    }
    public function createTable(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "CREATE TABLE If NOT EXISTS Album(albumId integer(10) AUTO_INCREMENT primary key,
            titre varchar(60) not null,
            authorId integer(10) not null,
            description LONGTEXT,
            dateCreation date not null,            
            constraint FK_AUTHORID_ALBUM foreign key(authorID) references Usager(userID)
            );";
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
            $query = "SELECT * FROM $tableName WHERE albumId=:id";
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

    public function get_by_title($title){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE titre=:titre";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':titre', $title);
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

    public function get_by_authorID($id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE authorId=:authorID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':authorID', $id);
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

    public function get_all_albums(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName";
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

    public function add_album($title, $authorID, $description){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (titre, authorId, description) VALUES (:titre, :authorId, :description)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':titre', $title);
            $stmt->bindParam(':authorId', $authorID);
            $stmt->bindParam(':description', $description);
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

    public function update_description($description,$id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET description = :description where albumId = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id', $albumId);
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

    public function delete_album($albumId){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName where albumId = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $albumId);
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