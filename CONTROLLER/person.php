<?php
require_once __DIR__ . "/../Config/db.php";

class Person
{
    protected $email;
    protected $password;
    protected $connect;
    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->getdatabase();
    }

    public function loginUser($email, $password)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
            $this->email = htmlspecialchars($email);

            $stmt = $this->connect->prepare("SELECT * FROM utilisateur WHERE Email = ?");
            $stmt->execute([$this->email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            //  var_dump($user);
            if ($user && password_verify($password, $user['password'])) {

                session_start();
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["name_utilisateur"];
                $_SESSION["user_role"] = $user["id_role "];

                echo "<script>alert('Login successful!');</script>";
                if ($user["id_role"] == 1) {
                    header("Location: ../views/continentAdmin.php");
                }elseif($user["id_role"] == 2){
                    header("Location: ../index.php");
                }
                
                exit;
            } else {

                echo "<script>alert('Invalid email or password.');</script>";
            }
        }
        }
    }


   
// $data = new person();
// $data = $data->getuser();


// var_dump($data);



// public function getuser(){
        
        
            
//     $query = "SELECT * FROM utilisateur";
//     $result  = $this->connect->prepare($query);
//     $result->execute();
    
//     $users = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
//     return $users;
//     }

// public function setUser($name,$email,$telephone,$password){
//     // $this->name = $name;
//     // $this->email = $email;
//     // $thisy->telephone

//     if (isset($_POST['Sign'])) {
//             $name_user = trim($_POST['name_user']);
//             $email = trim($_POST['email']);
//             $telephone = trim($_POST['telephone']);
//             $password = trim($_POST['pswd']);
        
//             if (!empty($name_user) && !empty($email) && !empty($telephone) && !empty($password)) {
//                 $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
//                 $stmt = $this->connect->prepare("INSERT INTO utilisateur (name_utilisateur, Email, telephone, password) VALUES (?, ?, ?, ?)");
//                 $stmt->bind_param("ssss", $name_user, $email, $telephone, $hashed_password);
//                 $stmt->execute();
//             }
// }


// }


// public function getLogin(){

// }  