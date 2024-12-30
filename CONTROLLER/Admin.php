<?php

require_once  __DIR__ . "/.././CONTROLLER/person.php";

class Admin extends Person{

    private $role;

    public function __construct($role = 1)
    {
        parent::__construct();
        
        $this->role = $role;
    }
    public function statistique() {
        try {
            $query = "SELECT COUNT(*) AS total_users FROM utilisateur";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_users']);
            return $result['total_users'];

        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
        try {
            $query = "SELECT COUNT(*) AS total_continent FROM continent";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_continent']);
            return $result['total_continent'];
        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
        try {
            $query = "SELECT COUNT(*) AS total_pays FROM pays";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_pays']);
            return $result['total_pays'];
        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
        try {
            $query = "SELECT COUNT(*) AS total_ville FROM ville";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['total_ville']);
            return $result['total_ville'];
        } catch (PDOException) {
            echo "Error in statistique: " ;
            return null;
        }
    }

    
    public function userRolesStat() {
        try {
            $query = "SELECT id_role, COUNT(*) AS count FROM utilisateur GROUP BY id_role";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result; 
        } catch (PDOException) {
            echo "Error in userRolesStat: ";
            return null;
        }
    }
    public function deletuser($id){
        $query = "DELETE FROM utilisateur WHERE id = :id";
        $stmt = $this->connect->prepare($query);

        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        
        if ($stmt->execute()) {
            return "Utilisateur supprimé avec succès !";

    }

}
}

// $data = new Admin();
// $data = $data->userRolesStat();

// var_dump($data);