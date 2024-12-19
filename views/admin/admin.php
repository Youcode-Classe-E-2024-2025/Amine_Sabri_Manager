<?php
include('../../db.php');

$limit = 3;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sqlCount = $pdo->prepare("SELECT COUNT(*) FROM \"user\"");
$sqlCount->execute();
$total_users = $sqlCount->fetchColumn();
$sql = $pdo->prepare("SELECT u.id as id_user, u.full_name, u.email, u.password, u.is_confirmed, u.status , r.name 
                      FROM \"user\" u 
                      JOIN \"role\" r ON u.role_id = r.id
                      LIMIT :limit OFFSET :offset");
$sql->bindParam(':limit', $limit, PDO::PARAM_INT);
$sql->bindParam(':offset', $offset, PDO::PARAM_INT);
$sql->execute();
$users = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
$title = 'Tableau de Bord';
$content = '
        <div class="bg-white p-6 shadow-lg rounded-lg">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Dernières Commandes</h3>
        <table class="w-full text-left table-auto">
          <thead>
            <tr class="border-b">
              <th class="py-2 px-4">ID</th>
              <th class="py-2 px-4">Utilisateur</th>
              <th class="py-2 px-4">Email</th>
              <th class="py-2 px-4">Role</th>
              <th class="py-2 px-4">status</th>
              <th class="py-2 px-4">Confirmation</th>
            </tr>
          </thead>
          <tbody>';

            
            foreach ($users as $user) {
                $confirmation = ($user['is_confirmed'] == 1) ? 'Confirmé' : 'Non confirmé';
                $content .= '
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">#' . htmlspecialchars($user['id_user']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['full_name']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['email']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['name']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['status']) . '</td>
                    <td class="py-2 px-4">' . $confirmation . '</td>
                    <td class="py-2 px-4">
                        <a href="edit_user.php?edit_id=' . $user['id_user'] . '" class="text-blue-500 hover:underline">Modifier</a> | 
                        <a href="#" class="text-red-500 hover:underline" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\')">Supprimer</a>
                    </td>
                </tr>';
            }

$content .= '
          </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center">
            <div>
                <span class="text-sm text-gray-700">Page ' . $page . ' sur ' . ceil($total_users / $limit) . '</span>
            </div>
            <div>
                <a href="?page=' . max($page - 1, 1) . '" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Précédent</a>
                <a href="?page=' . min($page + 1, ceil($total_users / $limit)) . '" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Suivant</a>
            </div>
        </div>
      </div>
';
?>


<!-- ############ Archivé user ########### -->
<?php
$sqlCount = $pdo->prepare("SELECT COUNT(*) FROM \"user\"");
$sqlCount->execute();
$total_users = $sqlCount->fetchColumn();
$sql = $pdo->prepare("SELECT u.id as id_user, u.full_name, u.email, u.password, u.is_confirmed, u.status , r.name 
                      FROM \"user\" u 
                      JOIN \"role\" r ON u.role_id = r.id
                      WHERE u.status = 'archivé'
                      LIMIT :limit OFFSET :offset");
$sql->bindParam(':limit', $limit, PDO::PARAM_INT);
$sql->bindParam(':offset', $offset, PDO::PARAM_INT);
$sql->execute();
$usersArchive = $sql->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
$userArchif = '
        <div class="bg-white p-6 shadow-lg rounded-lg">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Dernières Commandes</h3>
        <table class="w-full text-left table-auto">
          <thead>
            <tr class="border-b">
              <th class="py-2 px-4">ID</th>
              <th class="py-2 px-4">Utilisateur</th>
              <th class="py-2 px-4">Email</th>
              <th class="py-2 px-4">Role</th>
              <th class="py-2 px-4">status</th>
              <th class="py-2 px-4">Confirmation</th>
            </tr>
          </thead>
          <tbody>';

            
            foreach ($usersArchive as $user) {
                $confirmation = ($user['is_confirmed'] == 1) ? 'Confirmé' : 'Non confirmé';
                $userArchif .= '
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">#' . htmlspecialchars($user['id_user']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['full_name']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['email']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['name']) . '</td>
                    <td class="py-2 px-4">' . htmlspecialchars($user['status']) . '</td>
                    <td class="py-2 px-4">' . $confirmation . '</td>
                    <td class="py-2 px-4">
                        <a href="edit_user.php?edit_id=' . $user['id_user'] . '" class="text-blue-500 hover:underline">Modifier</a> | 
                        <a href="#" class="text-red-500 hover:underline" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\')">Supprimer</a>
                    </td>
                </tr>';
            }

$userArchif .= '
          </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="mt-4 flex justify-between items-center">
            <div>
                <span class="text-sm text-gray-700">Page ' . $page . ' sur ' . ceil($total_users / $limit) . '</span>
            </div>
            <div>
                <a href="?page=' . max($page - 1, 1) . '" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Précédent</a>
                <a href="?page=' . min($page + 1, ceil($total_users / $limit)) . '" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Suivant</a>
            </div>
        </div>
      </div>
';


include '../layouts/masterAdmin.php';
?>

