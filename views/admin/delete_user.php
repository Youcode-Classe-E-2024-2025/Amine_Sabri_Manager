<?php
session_start();
include('../../db.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = $pdo->prepare("DELETE FROM \"user\" WHERE id = :id");
    $sql->bindParam(':id', $user_id, PDO::PARAM_INT);

    if ($sql->execute()) {
        $_SESSION['success_message'] = "Utilisateur supprimé avec succès.";
    } else {
        $_SESSION['error_message'] = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
    }
} else {
    $_SESSION['error_message'] = "ID de l'utilisateur invalide.";
}

header('Location:./admin.php');
exit();
?>
