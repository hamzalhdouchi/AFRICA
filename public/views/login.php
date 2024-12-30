<?php
require '../../CONTROLLER/user.php';
// require "../../CONTROLLER/person.php";
$user = new User();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["Sign"])) {
        $email = $_POST['email'];
        echo
        $user->setUser($_POST["name_user"], $email, $_POST["telephone"], $_POST["pswd"]);
}
}
    if (isset($_POST["login"])) {

        $user->loginUser($_POST["email"], $_POST["password"]);
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="./style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

<a href="./loginAdmin.php" class=" absolute top-4 h-10 w-24 bg-white flex justify-center items-center text-green-600 border-2 border-solid border-green-600 hover:text-white hover:bg-green-500  rounded-xl m-16">is Admin</a>

    <div class="main">
                <input type="checkbox" id="chk" aria-hidden="true">
        
        <div class="signup">
            <form method="post" action="">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input class="w-3/5 h-2 bg-gray-300 flex justify-center mx-auto my-5 px-3 py-3 rounded" id="name_user" type="text" name="name_user" placeholder="User name">
                <input class="w-3/5 h-2 bg-gray-300 flex justify-center mx-auto my-5 px-3 py-3 rounded" id="email" type="email" name="email" placeholder="Email">
                <input class="w-3/5 h-2 bg-gray-300 flex justify-center mx-auto my-5 px-3 py-3 rounded" id="telephone" type="tel" name="telephone" placeholder="telephone">
                <input class="w-3/5 h-2 bg-gray-300 flex justify-center mx-auto my-5 px-3 py-3 rounded"  id="pswd" type="password" name="pswd" placeholder="Password">
                <button class="w-3/5 h-10 mx-auto my-2 block text-green-600 bg-gray-300 text-base font-bold mt-8 rounded transition ease-in duration-200 hover:bg-green-600 hover:text-white cursor-pointer" type="submit" name="Sign"> submit</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="">
                <label for="chk" aria-hidden="true">Login</label>
                <input class="w-3/5 h-2 bg-gray-300 flex justify-center mx-auto my-5 px-3 py-3 rounded" type="email" name="email" placeholder="Email" required="">
                <input class="w-3/5 h-2 bg-gray-300 flex justify-center mx-auto my-5 px-3 py-3 rounded" type="password" name="password" placeholder="Password" required="">
                <button type="submit" class="w-3/5 h-10 mx-auto my-2 block text-green-600 bg-gray-300 text-base font-bold mt-8 rounded transition ease-in duration-200 hover:bg-green-600 hover:text-white cursor-pointer" name="login">Login</button>
            </form>
        </div>
    </div>
    <script src="./public/js/script.js"></script>
</body>

</html>