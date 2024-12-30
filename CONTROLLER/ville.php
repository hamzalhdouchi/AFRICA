<?php

include __DIR__ . "/../Config/db.php";

class Ville
{

    private $Name_ville;
    private $Description;
    private $Type;
    private $connect;

    public function __construct()
    {
        $pdo = new Database();
        $this->connect = $pdo->getdatabase();
    }
    public function createVille($name, $idPays, $type, $description)
    {
        try {
            // Requête SQL préparée
            $sql = "INSERT INTO `ville` ( `nom_ville`, `description`, `type`, `id_pays`)
            
                    VALUES (:name, :description, :type, :idPays);";

            $stmt = $this->connect->prepare($sql);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':idPays', $idPays);

            // Exécution de la requête
            if ($stmt->execute()) {
                return true; // Succès
            } else {
                return false; // Échec
            }
        } catch (PDOException $e) {
            // Gestion d'erreur
            return "Erreur lors de l'insertion : " . $e->getMessage();
        }
    }


    // Read all Villes
    public function readVilles()
    {
        try {
            $sql = "SELECT * FROM ville";
            $stmt = $this->connect->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            return "Erreur : ";
        }
    }

    

    // Update a Ville
    public function updateVille($name,$id,$id_pays, $description, $type)
    {
        try {
            $sql = "UPDATE ville SET `nom_ville` = :name,`id_pays` = :id_pays ,`description` = :description, `type` = :type WHERE id_ville = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':id_pays' => $id_pays,
                ':name' => $name,
                ':description' => $description,
                ':type' => $type
            ]);
            return "Ville mise à jour avec succès !";
        } catch (PDOException) {
            return "Erreur : ";
        }
    }

    // Delete a Ville
    public function deleteVille($id)
    {
        try {
            $sql = "DELETE FROM ville WHERE id_ville = :id";
            $stmt = $this->connect->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "Ville supprimée avec succès !";
            };
        } catch (PDOException) {
            return "Erreur  ";
        }
    }

    public function Modifier($id)
    {
        try {
            $sql = "SELECT * FROM ville  WHERE id_ville = :id";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $ville = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ville;
        } catch (PDOException) {
            return "Erreur : ";
        }
    }

    public function readville($id)
{

    $sql = "SELECT * FROM ville WHERE id_pays = :id";
    
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $ville = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $ville;
}
}

// $data = new ville();
// $result = $data->updateVille('New Name', 'New Description', 1, 44);
// var_dump($result);

// $result = $ville->createVille($idPays, $typeVille, $nomVille, $description);

// $data = new Ville();
// $result = $data->createVille('azib darii', 'fia n3as asahbi', 1, 31);
// var_dump($result);