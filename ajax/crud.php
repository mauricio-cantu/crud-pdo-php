<?php

require __DIR__ .'/db_connection.php';

class CRUD
{

    protected $db;

    function __construct()
    {
        $this->db = DB();
    }

    function __destruct()
    {
        $this->db = null;
    }

    
    public function create($data)
    {
        $query = $this->db->prepare("INSERT INTO users(first_name, last_name, email) VALUES (:first_name,:last_name,:email)");
        $query->bindParam("first_name", $data['first_name'], PDO::PARAM_STR);
        $query->bindParam("last_name", $data['last_name'], PDO::PARAM_STR);
        $query->bindParam("email", $data['email'], PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

  
    public function read()
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

   
    public function delete($user_id)
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
    }

    public function update($data)
    {
        $query = $this->db->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email  WHERE id = :id");
        $query->bindParam("first_name", $data['first_name'], PDO::PARAM_STR);
        $query->bindParam("last_name", $data['last_name'], PDO::PARAM_STR);
        $query->bindParam("email", $data['email'], PDO::PARAM_STR);
        $query->bindParam("id", $data['id'], PDO::PARAM_STR);
        $query->execute();
    }

   
    public function details($user_id)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }
}

$crud = new CRUD();

?>
