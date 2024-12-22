<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire Stylé</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
  <form action="actionDoctor.php" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Formulaire Commun : Dossier Médical et Chambre</h2>
    
    <div class="grid grid-cols-2 gap-6">
      <!-- Colonne 1: Dossier Médical -->
      <div>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Dossier Médical</h3>
        <div class="mb-4">
    <label for="patient" class="block text-gray-700 font-medium">Patient :</label>
    <?php 
        include("../../db.php");
        // Requête pour récupérer l'id et le full_name des utilisateurs en utilisant un alias pour la table "user"
        $sql = "SELECT u.id, u.full_name FROM \"user\" AS u"; // Ajout de l'alias "u"
        $sqlState = $pdo->prepare($sql);
        $sqlState->execute();
        $patients = $sqlState->fetchAll(); // Récupérer tous les résultats
    ?>
    <select name="patient" id="patient" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        <option value="">Choisir un patient</option>
        <?php 
            // Boucle pour afficher chaque patient dans une option
            foreach ($patients as $patient) {
                echo "<option value='" . $patient['id'] . "'>" . htmlspecialchars($patient['full_name']) . "</option>";
            }
        ?>
    </select>
</div>

        <div class="mb-4">
          <label for="date_dossier" class="block text-gray-700 font-medium">Date du Dossier :</label>
          <input type="date" id="date_dossier" name="date_dossier" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
          <label for="diagnostic" class="block text-gray-700 font-medium">Diagnostic :</label>
          <textarea id="diagnostic" name="diagnostic" placeholder="Entrer le diagnostic" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" required></textarea>
        </div>
        <div class="mb-4">
          <label for="traitement" class="block text-gray-700 font-medium">Traitement :</label>
          <textarea id="traitement" name="traitement" placeholder="Entrer le traitement" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" required></textarea>
        </div>
      </div>

      <!-- Colonne 2: Chambre -->
      <div>
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Chambre</h3>
        <div class="mb-4">
          <label for="num" class="block text-gray-700 font-medium">Numéro de la Chambre :</label>
          <input type="text" id="num" name="num" placeholder="Numéro de la chambre" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
          <label for="type" class="block text-gray-700 font-medium">Type de Chambre :</label>
          <input type="text" id="type" name="type" placeholder="Type de la chambre (ex: simple, double)" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
          <label for="statut" class="block text-gray-700 font-medium">Statut :</label>
          <select id="statut" name="statut" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" required>
            <option value="Disponible">Disponible</option>
            <option value="Occupée">Occupée</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Bouton Soumettre -->
    <div class="mt-6">
      <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200">Soumettre</button>
    </div>
  </form>
</body>
</html>
