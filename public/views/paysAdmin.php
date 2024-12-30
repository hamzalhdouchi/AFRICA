<?php
require_once "../../CONTROLLER/pays.php";
$pays = new Pays();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['save_country'])) {
        $nom_pays = $_POST['countryName'];
        $population = $_POST['population'];
        $language = $_POST['language'];
        $continent = $_POST['continent'];

        $result = $pays->addPays($nom_pays, $population, $language, $continent);

        $message = $result ? "Pays ajouté avec succès!" : "Erreur lors de l'ajout du pays.";
    }

    if (isset($_POST['Supprimer'])) {
        $id = $_POST['supr'];
        $result = $pays->deletePays($id);
        $message = $result ? "Pays supprimé avec succès!" : "Erreur lors de la suppression du pays.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["save_update"])) {
    // echo $_POST['paysname'];
    // echo $_POST['pup'];
    // echo $_POST['lang'];
    // echo $_POST['cont'];
    // echo $_POST['pays_id'];

    $result = $pays->updatePays($_POST['paysname'], $_POST["pup"], $_POST["lang"], $_POST['cont'], $_POST['pays_id']);
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['Modifier'])) {

    $id = $_GET['modifer'];

    $payes = $pays->modifierpays($id);
    echo '<script>
        function formpays(e) {
            e.preventDefault();
            document.getElementById("formpays").classList.toggle("hidden");
        }
    </script>';
}


$paysList = $pays->readPays();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afriqua Geo - Pays Admin Dashboard</title>
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
                <li><a href="#" class="text-white hover:text-green-200">log-out</a></li>
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
                <a href="../views/continentAdmin.php" class="flex items-center px-6 py-3 text-gray-600 hover:bg-green-600 hover:text-white transition-all duration-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Continent
                </a>
                <a href="../views/paysAdmin.php" class="flex items-center px-6 py-3 bg-green-600 text-white">
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
        <main class="flex-1 overflow-auto bg-gray-100">
            <div class="p-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Pays Dashboard</h2>
                    <button onclick="toggleModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500 transition-all">Ajouter un Pays</button>
                </div>

                <!-- Countries Table -->
                <div class="bg-white shadow-xl mb-8 rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Gestion des Pays</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nom du Pays</th>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Population</th>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Langue</th>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Continent</th>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($paysList as $row) { ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($row['nom_pays']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($row['POPULATION']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($row['LANGAUGE_PAYS']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Africa</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <div class="flex space-x-2">
                                                <form action="" method="get">
                                                    <input type="hidden" value="<?= htmlspecialchars($row['id_pays']) ?>" name="modifer">
                                                    <button type="submit" onclick="formpays(event)" name="Modifier" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition-all">Modifier</button>
                                                </form>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="supr" value="<?= $row['id_pays'] ?>">
                                                    <button type="submit" name="Supprimer" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500 transition-all">Supprimer</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Add New Pays Form (Modal) -->
                <div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg w-96 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un Pays</h2>
                        <form method="POST" action="">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="countryName">Nom du Pays</label>
                                <input type="text" name="countryName" id="countryName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="population">Population</label>
                                <input type="number" name="population" id="population" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="language">Langue</label>
                                <input type="text" name="language" id="language" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="continent">Continent</label>
                                <select name="continent" id="continent" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                    <option value="1">Africa</option>
                                    <!-- Add more continents here -->
                                </select>
                            </div>

                            <div class="flex justify-end space-x-3">
                                <button type="submit" name="save_country" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition-all">Enregistrer</button>
                                <button type="button" onclick="toggleModal()" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400 transition-all">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>


    <!-- form de modification -->
    <form class="space-y-6 hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50" method="POST" action="" id="formpays">
        <?php $pays = $payes[0] ?>
        <input type="hidden" value="<?= $pays['id_pays'] ?>" name="pays_id" id="pays_id">

        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le Pays</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="countryName">Nom du Pays</label>
                <input type="text" name="paysname" id="paysname" value="<?= $pays['nom_pays'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="population">Population</label>
                <input type="number" name="pup" id="population" value="<?= $pays['POPULATION'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="language">Langue</label>
                <input type="text" name="lang" id="lang" value="<?= $pays['LANGAUGE_PAYS'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="continent">Continent</label>
                <select name="cont" id="continent" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <option value="1" <?= $pays['ID_CONTINENT'] == 'Africa' ? 'selected' : '' ?>>Africa</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="submit" name="save_update" class="px-4 py-2 bg-white text-black hover:text-white hover:bg-green-600 transition-all duration-500">Sauvegarder</button>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <footer class="bg-green-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2023 Africa Gio. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }
    </script>
</body>

</html>