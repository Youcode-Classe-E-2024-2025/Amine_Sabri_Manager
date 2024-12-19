<?php
include('../../db.php');

if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];

    $editQuery = $pdo->prepare("SELECT u.*, r.name AS role_name
                                FROM \"user\" u
                                JOIN \"role\" r ON u.role_id = r.id
                                WHERE u.id = :id");
    $editQuery->bindParam(':id', $edit_id, PDO::PARAM_INT);
    $editQuery->execute();
    $user = $editQuery->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $role_id = isset($_POST['role']) ? (int)$_POST['role'] : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : 'actif';
    $is_confirmed = isset($_POST['is_confirmed']) ? 1 : 0;

    if (empty($full_name)) {
        echo "Le nom complet est requis.";
        exit;
    }

    if ($role_id <= 0) {
        echo "Le rôle sélectionné est invalide.";
        exit;
    }

    if (!in_array($status, ['actif', 'archivé'])) {
        echo "Le statut sélectionné est invalide.";
        exit;
    }

    $updateQuery = $pdo->prepare("UPDATE \"user\" 
                                  SET full_name = :full_name, 
                                      role_id = :role_id, 
                                      status = :status, 
                                      is_confirmed = :is_confirmed
                                  WHERE id = :id");

    $updateQuery->bindParam(':full_name', $full_name, PDO::PARAM_STR);
    $updateQuery->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $updateQuery->bindParam(':status', $status, PDO::PARAM_STR);
    $updateQuery->bindParam(':is_confirmed', $is_confirmed, PDO::PARAM_INT);
    $updateQuery->bindParam(':id', $edit_id, PDO::PARAM_INT);

    if ($updateQuery->execute()) {
        header('location: ./admin.php');
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Modifier Utilisateur</h2>

        <form method="POST">
            <!-- Nom complet -->
            <div class="mb-4">
                <label for="full_name" class="block text-sm font-medium text-gray-600">Nom complet</label>
                <input type="text" id="full_name" name="full_name" value="<?= isset($user['full_name']) ? htmlspecialchars($user['full_name']) : '' ?>" 
                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Rôle -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-600">Rôle</label>
                <select id="role" name="role" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    <?php
                    $rolesQuery = $pdo->query("SELECT * FROM \"role\"");
                    $roles = $rolesQuery->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($roles as $role) :
                    ?>
                        <option value="<?= htmlspecialchars($role['id']) ?>" <?= isset($user['role_id']) && $user['role_id'] == $role['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Statut</label>
                <select id="status" name="status" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="actif" <?= isset($user['status']) && $user['status'] == 'actif' ? 'selected' : '' ?>>Actif</option>
                    <option value="archivé" <?= isset($user['status']) && $user['status'] == 'archivé' ? 'selected' : '' ?>>Archivé</option>
                </select>
            </div>

            <!-- Confirmation -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" id="is_confirmed" name="is_confirmed" class="mr-2" <?= isset($user['is_confirmed']) && $user['is_confirmed'] == 1 ? 'checked' : '' ?>>
                <label for="is_confirmed" class="text-sm font-medium text-gray-600">Confirmation</label>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Modifier
            </button>
        </form>
    </div>

</body>
</html>
