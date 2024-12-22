<?php  
    include("../../db.php");

    $sql = "SELECT u.full_name , d.dossier_id ,d.date_dossie , d.diagnostic , d.traitement , c.num AS \"N° Chambre\" , c.type , c.statut AS \"Statut Chambre\"
    FROM \"user\" u
    JOIN dossier_medical d ON u.id = d.user_id
    JOIN chambre c ON d.dossier_id = c.chambre_id";

    $sqlState = $pdo->query($sql);
    $results = $sqlState->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($results as $row) {
    //     echo "Full Name: " . htmlspecialchars($row['full_name']) . "<br>";
    //     echo "Date Dossier: " . htmlspecialchars($row['date_dossie']) . "<br>";
    //     echo "Diagnostic: " . htmlspecialchars($row['diagnostic']) . "<br>";
    //     echo "Traitement: " . htmlspecialchars($row['traitement']) . "<br>";
    //     echo "N° Chambre: " . htmlspecialchars($row['N° Chambre']) . "<br>";
    //     echo "Type: " . htmlspecialchars($row['type']) . "<br>";
    //     echo "Statut Chambre: " . htmlspecialchars($row['Statut Chambre']) . "<br><hr>";
    // }

    $content_dossier= '
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Full Name</th>
                        <th class="px-4 py-3">Date Dossier</th>
                        <th class="px-4 py-3">Diagnostic</th>
                        <th class="px-4 py-3">Traitement</th>
                        <th class="px-4 py-3">N° Chambre</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Statut Chambre</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">';

    foreach ($results as $row) {
        $content_dossier .=  '
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">' . $row['full_name'] . '</td>
            <td class="px-4 py-3 text-sm">' . $row['date_dossie'] . '</td>
            <td class="px-4 py-3 text-sm">' . $row['diagnostic'] . '</td>
            <td class="px-4 py-3 text-sm">' . $row['traitement'] . '</td>
            <td class="px-4 py-3 text-sm">' . $row['N° Chambre'] . '</td>
            <td class="px-4 py-3 text-sm">' . $row['type'] . '</td>
            <td class="px-4 py-3 text-sm">' . $row['Statut Chambre'] . '</td>
            <td>
                <a href="delete_dossier.php?dossier_id=' . htmlspecialchars($row['dossier_id']) . '" class="text-red-500 hover:text-red-700">b</a>
            </td>
        </tr>';
    }
    $content_dossier .=  '
                </tbody>
            </table>
        </div>
    </div>';
?>

