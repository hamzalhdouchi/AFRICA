<?php
require __DIR__.'/../../CONTROLLER/ville.php';
require __DIR__.'/../../CONTROLLER/pays.php';

$pays = new pays();

$pays = $pays->readPays();
$ville = new Ville();

$affecherVille = $ville->readVilles();

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["ville"])) {
    echo $_POST['villename'];
    echo $_POST['country'];
    echo $_POST['isCapital'];
    echo $_POST['description'];
    echo $_POST['villeid'];
    $result = $ville->updateVille($_POST['villename'], $_POST["villeid"], $_POST["country"], $_POST['description'], $_POST["isCapital"]);

    
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["city"])) {
    try {
        // Validation des champs requis
        $requiredFields = ['cityName', 'pays', 'Capital', 'Description'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                die("Le champ $field est obligatoire.");
            }
        }

        // Afficher les données nettoyées pour validation (facultatif, utile pour le débogage)
        // echo "Données reçues : <br>";
        // echo htmlspecialchars($_POST['cityName']) . '<br>';
        // echo htmlspecialchars($_POST['pays']) . '<br>';
        // echo htmlspecialchars($_POST['Capital']) . '<br>';
        // echo htmlspecialchars($_POST['Description']) . '<br>';

        // Appel de la méthode createVille
        $result = $ville->createVille(
            htmlspecialchars(strip_tags($_POST['cityName'])),  // Nom de la ville
            (int) $_POST['pays'],                              // ID du pays
            $_POST['Capital'],   // Type (capital ou autre)
            htmlspecialchars(strip_tags($_POST['Description'])) // Description
        );

        // Afficher le résultat
        echo $result ? "Insertion réussie !" : "Erreur lors de l'insertion.";
    } catch (Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}


if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["Supprimer"])) {
    $id = $_POST['supr'];

    $result = $ville->deleteVille($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'  && isset($_GET['Modifier'])) {
    $id = $_GET['id_ville'];
    
    $modiferVille = $ville->Modifier($id);
    echo'<script>
    function formVille(e) {
        e.preventDefault();
        document.getElementById("formpays").classList.toggle("hidden");
    }
</script>';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afriqua Geo - Tableau de Bord des Villes</title>
    <link rel="stylesheet" href="https//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-green-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-3">
                <img src="../../src/img/logo.png" alt="Logo Africa Gio" class="w-12 h-12">
                <span class="text-2xl font-semibold text-white">Africa Gio</span>
            </a>
            <ul class="flex space-x-4">
                <li><a href="./login.php" class="text-white hover:text-green-200">log-out</a></li>
            </ul>
        </div>
    </nav>

    <div class="flex h-screen">
        <!-- Barre latérale -->
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
                <a href="../views/paysAdmin.php" class="flex items-center px-6 py-3 text-gray-600 hover:bg-green-600 hover:text-white transition-all duration-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Pays
                </a>
                <a href="../views/villeAdmin.php" class="flex items-center px-6 py-3 bg-green-600 text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Villes
                </a>
            </nav>
        </aside>

        <!-- Contenu Principal -->
        <main class="flex-1 overflow-auto">
            <div class="p-8">
                <!-- En-tête -->
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800">Tableau de Bord des Villes</h2>
                </div>

                <!-- Tableau des Villes -->
                <div class="bg-white shadow-xl mb-8">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Gestion des Villes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nom de la Ville</th>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">description</th>
                                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                    <?php
                                    foreach ($affecherVille as $Ville) {
                                    ?>
                                <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($Ville['nom_ville']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($Ville['description']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 ">
                                            <div class="flex gap-3">
                                            <form action="" method="GET">
                                                <input type="hidden" name="id_ville" value="<?= $Ville['id_ville'] ?>">
                                                <button type="submit" onclick="formVille(e)" name="Modifier" class="inline-flex items-center px-3 py-1.5 border border-green-400 text-sm font-medium text-black bg-white hover:bg-green-600 hover:text-white hover:transition-all duration-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                                                    Modifier
                                                </button>
                                            </form>
                                            <form action="" method="POST">
                                                <input type="hidden" name="supr" value="<?= $Ville['id_ville'] ?>">
                                                <button type="submit" name="Supprimer" class="inline-flex items-center px-3 py-1.5 border border-red-400 text-sm font-medium text-black bg-white hover:bg-red-700 hover:text-white hover:transition-all duration-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Supprimer
                                                </button>
                                            </form>
                                            </div>
                                            
                                        <?php } ?>
                                        </td>
                                </tr>
                    </div>
                    >

                    </tbody>
                    </table>
                </div>
            </div>

            <!-- Formulaire d'Ajout de Ville -->
            <div class="bg-white shadow-xl " id="ajoute_ville">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold">Ajouter une Ville</h2>
                </div>
                <div class="p-6">

                    <form class="space-y-6" method="POST" action="">

                        <?php
                        // Debugging to verify the array structure
                        // var_dump($modiferVille); 

                        // Safely access the first element of the array
                        $ville = $modiferVille[0] ?? null;
                        ?>
                                <div>
                            <input type="hidden" value="<?= htmlspecialchars($ville['id_ville'] ?? '') ?>" name="villeid" id="cityName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="cityName">Nom de la Ville</label>
                            <input type="text" value="<?= htmlspecialchars($ville['nom_ville'] ?? '') ?>" name="villename" id="cityName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="country">Pays</label>
                            <select name="country" id="country" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <?php
                                foreach ($pays as $country) {
                                    $selected = ($ville['id_pays'] ?? '') == $country['id_pays'] ? 'selected' : '';
                                ?>
                                    <option class="text-black" value="<?= htmlspecialchars($country['id_pays']) ?>" <?= $selected ?>><?= htmlspecialchars($country['nom_pays']) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="isCapital">Capitale</label>
                            <select name="isCapital" id="isCapital" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <option value="1" <?= ($ville['type_ville'] ?? 0) == 1 ? 'selected' : '' ?>>Capitale</option>
                                <option value="0" <?= ($ville['type_ville'] ?? 0) == 0 ? 'selected' : '' ?>>Autre</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="description">Description</label>
                            <input type="text" value="<?= htmlspecialchars($ville['description'] ?? '') ?>" name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button name="ville" type="submit" class="px-4 py-2 bg-white text-black hover:text-white hover:bg-green-600 hover:transition-all duration-500">
                                Enregistrer la Ville
                            </button>
                        </div>
                    </form>

                </div>
            </div>
    </div>
    </main>
    </div>




















    
    <div class="bg-white shadow-xl " id="form_ville">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold">Ajouter une Ville</h2>
        </div>
        <div class="p-6">

            <form class="space-y-6" method="POST" action="#">


                <div>
                    <label class="block text-sm font-medium text-gray-700" for="cityName">Nom de la Ville</label>
                    <input type="text" name="cityName" id="cityName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="country">Pays</label>
                    <select name="pays" id="country" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">

                        <?php
                        foreach ($pays as $contry) {

                        ?>
                            <option class="text-black" value="<?= $contry['id_pays'] ?>"><?= $contry['nom_pays'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="isCapital">Capitale</label>
                    <select name="Capital" id="isCapital" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="1">capital</option>
                        <option value="0">Autre</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700" for="description">Description</label>
                    <input type="text" name="Description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <div class="flex justify-end space-x-3">
                    <button name="city" type="submit" class="px-4 py-2 bg-white text-black hover:text-white hover:bg-green-600 hover:transition-all duration-500">
                        Enregistrer la Ville
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </main>
    </div>

    <!-- Pied de page -->
    <footer class="bg-green-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2023 Africa Gio. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Effet de survol des lignes du tableau
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

        function formVille() {
    document.getElementById('ajoute_ville').classList.toggle('hidden');
    document.getElementById('form_ville').classList.toggle('hidden');
}
    </script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
</body>

</html>