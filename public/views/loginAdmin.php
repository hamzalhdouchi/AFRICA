<?php
require '../../CONTROLLER/user.php';
$user = new User();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["Sign"])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }else{
        $user->setUser($_POST["name_user"], $email, $_POST["telephone"], $_POST["pswd"],$role);
    }
}

    if (isset($_POST["login"])) {

        $user->loginUser($_POST["email"], $_POST["password"]);
    }
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

    <!-- <div id="alert-border4" class="absolute hidden flex items-center z-50 top-0 h-16 w-[30vw] rounded-lg p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div id="message" class="ms-3 text-sm font-medium">
                        
                    </div>
                </div> -->
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">



        <!-- <div class="login"> -->
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










