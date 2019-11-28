<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class CommentaireTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        Parent::__construct();
        $this->tableName = "Commentaire";
    }

    public function getInstance(){
        if(is_null($this->_instance)){
            $this->_instance = new CommentaireTDG();
        }
        return $this->_instance;
    }
    //create table
    public function createTable(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "create table if not exists Commentaire
            (
            commentaireId integer(10) auto_increment primary key,
            typeCom char(3) constraint type_commentaire check(type = 'IMG' or type = 'ALB'),
            dateCreation date not null,
            contenu LONGTEXT not null,
            parentID integer(10),
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
            $query = "SELECT commentaireId,typeCom, email, imageProfile FROM $tableName WHERE userID=:id";
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


    public function get_by_email($email){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE email=:email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
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


    public function get_by_username($username){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE username=:username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
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


    public function get_all_users(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT userId, username, email,imageProfile FROM $tableName";
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


    public function add_user($email, $username, $password ){ // password déja hash

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (email, username, password) VALUES (:email, :username, :password)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
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

    public function update_info($email, $username, $id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET email=:email, username=:username WHERE userId=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
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

    public function update_password($NHP, $id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET password=:password WHERE userId=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $NHP);
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

    public function update_image($id, $imageProfile){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET imageProfil= :imageProfil WHERE userId=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imageProfil', $imageProfile);
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
