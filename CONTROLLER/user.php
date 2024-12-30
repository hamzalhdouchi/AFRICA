<?php
require_once __DIR__ . "/./person.php";

class User extends Person
{
    private $name;
    private $telephone;
    private $role;

    public function __construct()
    {
        parent::__construct(); 
    }


    public function readUser(){
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->connect->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function setUser($name, $email, $telephone, $password)
    {
    
            $this->name = htmlspecialchars($name);
            $this->email = htmlspecialchars($email);
            $this->telephone = htmlspecialchars($telephone);
            $this->password = password_hash($password, PASSWORD_BCRYPT);

            // Utilisation de $this->connect hérité de la classe Person
            $stmt = $this->connect->prepare("INSERT INTO utilisateur(name_utilisateur, Email, telephone, password) VALUES (?, ?, ?, ?)");
            
            $stmt->execute([$this->name, $this->email, $this->telephone, $this->password]);

            if ($stmt->rowCount() > 0) {
                echo "hhhhhhhhhhhhh";
                header("Location: login.php");
                exit;
            } else {
                echo "errur en login";
            }
        }
    }

