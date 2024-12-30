<?php
require __DIR__ . "/../../CONTROLLER/continent.php";

require __DIR__ . "/../../CONTROLLER/user.php";
require __DIR__ . "/../../CONTROLLER/Admin.php";

$admin = new Admin();


$user = new User();

$user = $user->readUser();



$continent = new continent();

$continent = $continent->readAll();

if (isset($_POST['delet'])) {
    $id = $_POST['id'];

    $admin->deletuser($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afriqua Geo - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="bg-green-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-3">
                <img src="../../src/img/logo.png" alt="Africa Gio Logo" class="w-12 h-12">
                <span class="text-2xl font-semibold text-white">Africa Gio</span>
            </a>
            <ul class="flex space-x-4">
                <li><a href="./login.php" class="text-white hover:text-green-200">log-out</a></li>
            </ul>
        </div>
    </nav>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r">
            <div class="p-6">
                <h1 class="text-xl font-semibold text-gray-800">Navigation</h1>
            </div>
            <nav class="mt-6">
                <a href="../views/continentAdmin.php" class="flex items-center px-6 py-3 bg-green-600 text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Continent
                </a>
                <a href="../views/paysAdmin.php" class="flex items-center px-6 py-3 text-gray-600 hover:bg-green-600 hover:text-white transition-all duration-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Pays
                </a>
                <a href="../views/villeAdmin.php" class="flex items-center px-6 py-3 text-gray-600 hover:bg-green-600 hover:text-white transition-all duration-500">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Ville
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800">Continent Dashboard</h2>
                </div>

                <!-- Users Table -->
<div class="bg-white shadow-xl mb-8">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800">Users Management</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full overflow-y-hidden">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Telephone</th>
                    <th class="text-right px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php
                foreach ($user as $row) {
                    if ($row['id_role'] == 2) {
                ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($row['name_utilisateur']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($row['Email']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($row['telephone']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delet" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium text-gray-400 bg-gray-100 hover:bg-green-600 hover:text-white transition-all duration-300 rounded-lg">
                                    Delete User
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Continent Table -->
<div class="bg-white shadow-xl mb-8">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800">Continent Table</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Continent Nom</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de Pays</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php
                foreach ($continent as $row) {
                ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $row['nom_continent'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= $row['nombre_de_pays'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



                <!-- Footer -->
                <footer class="bg-green-800 text-white py-8 mt-12">
                    <div class="max-w-7xl mx-auto px-4 text-center">
                        <p>&copy; 2023 Africa Gio. All rights reserved.</p>
                    </div>
                </footer>

                <script>
                    // Add any necessary JavaScript here
                    document.addEventListener('DOMContentLoaded', function() {
                        // Mobile menu toggle
                        const burgerMenu = document.getElementById('burger-menu');
                        const mobileMenu = document.getElementById('mobile-menu');

                        burgerMenu.addEventListener('click', function() {
                            mobileMenu.classList.toggle('hidden');
                        });

                        // Table row hover effect
                        const tableRows = document.querySelectorAll('tbody tr');
                        tableRows.forEach(row => {
                            row.addEventListener('mouseenter', function() {
                                this.classList.add('bg-gray-50');
                            });
                            row.addEventListener('mouseleave', function() {
                                this.classList.remove('bg-gray-50');
                            });
                        });
                    });
                </script>
</body>

</html>