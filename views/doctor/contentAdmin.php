<?php
include("../../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $sql = "SELECT is_confirmed FROM rendez_vous WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $appointment = $stmt->fetch();
    if ($appointment) {
        $new_is_confirmed = ($appointment['is_confirmed'] == 0) ? 1 : 0;
        $update_sql = "UPDATE rendez_vous SET is_confirmed = ? WHERE id = ?";
        $update_stmt = $pdo->prepare($update_sql);
        if ($update_stmt->execute([$new_is_confirmed, $id])) {
            header("Location: ./doctor.php");
            exit();
        } else {
            echo "Error updating the appointment status.";
        }
    } else {
        echo "Appointment not found.";
    }
} 
?>






<?php
include("../../db.php");

// Pagination Settings
$results_per_page = 4;

// For All Appointments
$page_all = isset($_GET['page_all']) ? (int)$_GET['page_all'] : 1;
$start_from_all = ($page_all - 1) * $results_per_page;

$sql_total_all = "SELECT COUNT(*) FROM \"rendez_vous\"";
$stmt_total_all = $pdo->query($sql_total_all);
$total_records_all = $stmt_total_all->fetchColumn();
$total_pages_all = ceil($total_records_all / $results_per_page);

$sql_all = "SELECT u.full_name, r.id, r.cni, r.date_rendez_vous, r.date, r.is_confirmed
            FROM \"user\" u
            JOIN \"rendez_vous\" r
            ON u.id = r.user_id
            LIMIT $results_per_page OFFSET $start_from_all";
$sqlState_all = $pdo->query($sql_all);





// For Today's Appointments
$page_today = isset($_GET['page_today']) ? (int)$_GET['page_today'] : 1;
$start_from_today = ($page_today - 1) * $results_per_page;

$sql_total_today = "SELECT COUNT(*) FROM \"rendez_vous\" WHERE date::date = CURRENT_DATE";
$stmt_total_today = $pdo->query($sql_total_today);
$total_records_today = $stmt_total_today->fetchColumn();
$total_pages_today = ceil($total_records_today / $results_per_page);

$sql_today = "SELECT u.full_name, r.id, r.cni, r.date_rendez_vous, r.date, r.is_confirmed
            FROM \"user\" u
            JOIN \"rendez_vous\" r
            ON u.id = r.user_id
            WHERE r.date::date = CURRENT_DATE
            LIMIT $results_per_page OFFSET $start_from_today";
$sqlState_today = $pdo->query($sql_today);

// Content for All Appointments
$content = '
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">CNI</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">';

            while ($row = $sqlState_all->fetch(PDO::FETCH_ASSOC)) {
                $content .= '
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold">' . htmlspecialchars($row['full_name']) . '</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">' . htmlspecialchars($row['cni']) . '</td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight ' . 
                            ($row['is_confirmed'] == 1 ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100') . '">
                            ' . ($row['is_confirmed'] == 1 ? 'Approved' : 'Pending') . '
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">' . htmlspecialchars($row['date_rendez_vous']) . '</td>
                    <td class="px-4 py-3">
                        <!-- Add the form to update the confirmation status -->
                        <form method="POST" action="contentAdmin.php">
                            <input type="hidden" name="id" value="' . $row['id'] . '" />
                            <input type="checkbox" name="is_confirmed"  value="' . ($row['is_confirmed'] == 1 ? 'checked' : '') . '" />
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white">Update</button>
                        </form>
                    </td>
                </tr>';
            }
            
            
$content .= '
            </tbody>
        </table>
    </div>
</div>';

$content .= '<div class="pagination">
                    <ul class="flex justify-center space-x-4">';

if ($page_all > 1) {
    $content .= '<li><a href="?page_all=' . ($page_all - 1) . '" class="px-4 py-2 text-gray-600">Previous</a></li>';
}

for ($i = 1; $i <= $total_pages_all; $i++) {
    $content .= '<li><a href="?page_all=' . $i . '" class="px-4 py-2 text-gray-600 ' . ($i == $page_all ? 'bg-blue-500 text-white' : '') . '">' . $i . '</a></li>';
}

if ($page_all < $total_pages_all) {
    $content .= '<li><a href="?page_all=' . ($page_all + 1) . '" class="px-4 py-2 text-gray-600">Next</a></li>';
}

$content .= '</ul></div>';


// Content for Today's Appointments
$content_today = '
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">CNI</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">';

while ($row = $sqlState_today->fetch(PDO::FETCH_ASSOC)) {
    $content_today .= '
    <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3">
            <div class="flex items-center text-sm">
                <div>
                    <p class="font-semibold">' . htmlspecialchars($row['full_name']) . '</p>
                </div>
            </div>
        </td>
        <td class="px-4 py-3 text-sm">' . htmlspecialchars($row['cni']) . '</td>
        <td class="px-4 py-3 text-xs">
            <span class="px-2 py-1 font-semibold leading-tight ' . 
                ($row['is_confirmed'] == true ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100') . '">
                ' . ($row['is_confirmed'] == true ? 'Approved' : 'Pending') . '
            </span>
        </td>
        <td class="px-4 py-3 text-sm">' . htmlspecialchars($row['date_rendez_vous']) . '</td>
    </tr>';
}

$content_today .= '
            </tbody>
        </table>
    </div>
</div>';

$content_today .= '<div class="pagination">
                    <ul class="flex justify-center space-x-4">';

if ($page_today > 1) {
    $content_today .= '<li><a href="?page_today=' . ($page_today - 1) . '" class="px-4 py-2 text-gray-600">Previous</a></li>';
}

for ($i = 1; $i <= $total_pages_today; $i++) {
    $content_today .= '<li><a href="?page_today=' . $i . '" class="px-4 py-2 text-gray-600 ' . ($i == $page_today ? 'bg-blue-500 text-white' : '') . '">' . $i . '</a></li>';
}

if ($page_today < $total_pages_today) {
    $content_today .= '<li><a href="?page_today=' . ($page_today + 1) . '" class="px-4 py-2 text-gray-600">Next</a></li>';
}

$content_today .= '</ul></div>';

// Include layout file to display content
include_once '../layouts/masterDoctor.php';
?>
