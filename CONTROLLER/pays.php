<?php

require_once __DIR__ . '/../Config/db.php';

class Pays {

    private $connect;

    public function __construct() {
        try {
            $db = new Database();
            $this->connect =  $db->getdatabase();
        } catch (PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
        }
    }

    public function readPays() {
        try {
            $sql = "SELECT * FROM pays";
            $stmt = $this->connect->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur Connection: " . $e->getMessage();
        }
    }

    public function modifierpays($id)
    {
        try {
            $sql = "SELECT * FROM pays  WHERE id_pays = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $pays = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pays;
        } catch (PDOException) {
            return "Erreur : ";
        }
    }

    public function addPays($nom_pays, $population, $language, $id_continent) {
        try {
            $insert_sql = "INSERT INTO pays (nom_pays, POPULATION, LANGAUGE_PAYS, ID_CONTINENT) 
                           VALUES (:nom_pays, :population, :language, :continent)";
            $stmt = $this->connect->prepare($insert_sql);

            
            $stmt->bindParam(':nom_pays', $nom_pays);
            $stmt->bindParam(':population', $population);
            $stmt->bindParam(':language', $language);
            $stmt->bindParam(':continent', $id_continent);

            return $stmt->execute();
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function updatePays( $nom_pays, $population, $language, $id_continent,$id) {
        try {

            $update_sql = "UPDATE pays 
                        SET nom_pays = :nom_pays, POPULATION = :population, 
                        LANGAUGE_PAYS = :language, ID_CONTINENT = :continent 
                        WHERE id_pays = :id";
            $stmt = $this->connect->prepare($update_sql);

            $stmt->bindParam(':nom_pays', $nom_pays);
            $stmt->bindParam(':population', $population);
            $stmt->bindParam(':language', $language);
            $stmt->bindParam(':continent', $id_continent);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                // echo 'gjdflgfjdljglfjlgdlgd';
            }else {
                // echo 'you';
            }
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function deletePays($id_pays) {
        try {
            $delete_sql = "DELETE FROM pays WHERE id_pays = :id";
            $stmt = $this->connect->prepare($delete_sql);

            $stmt->bindParam(":id", $id_pays, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }


  
}
