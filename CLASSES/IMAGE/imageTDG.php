<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class ImageTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    private function __construct(){
        Parent::__construct();
        $this->tableName = "image";
    }

    public static function get_Instance(){
        if(is_null(self::$_instance)){
            self::$_instance = new ImageTDG();
        }
        return self::$_instance;
    }

    public function createTable(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "create table if not exists Image
            (
            imageID integer(10) auto_increment primary key,
            imageUrl LONGTEXT not null,
            albumID integer(10) not null,
            description longtext default '',
            dateCreation date not null,

            constraint FK_albumID_Image foreign key(albumID) references Album(albumID)
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
            $query = "SELECT * FROM $tableName WHERE imageID=:id";
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

    public function get_by_albumId($albumId){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE albumID=:albumID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumId);
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

    
    public function get_all_images(){

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

    public function add_image($imageUrl, $albumID, $description){

        try{
            date_default_timezone_set('America/New_York');
            $date = date('Y-m-d H:i:s');
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (imageUrl, albumID, description, dateCreation) VALUES (:imageUrl, :albumID, :description, :dateCreation)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageUrl', $imageUrl);
            $stmt->bindParam(':albumID', $albumID);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':dateCreation', $date);
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

    public function update_description($description, $id){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET description = :description where imageID = :id";
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

    public function delete_image($imageId){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName where imageID = :imageID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageID', $imageId);
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

    public function get_firstImagePosted($albumID)
    {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE albumID=:id ORDER BY dateCreation LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $albumID);
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

    public function get_likes_number($imageID)
    {
        try{
            $conn = $this->connect();
            $tableName = "User_Images_Likes";
            $query = "SELECT COUNT(:imageID) as likes FROM $tableName where imageID = :imageID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageID', $imageID);
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

    public function add_like($imageID,$userID)
    {
        try{
            $conn = $this->connect();
            $tableName = "User_Images_Likes";
            $query = "INSERT INTO $tableName VALUES (:userID, :imageID)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':imageID', $imageID);
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

    public function get_number_image_album($albumID)
    {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT COUNT(:albumID) as nombre FROM $tableName where albumID = :albumID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':albumID', $albumID);
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
}