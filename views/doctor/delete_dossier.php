
<?php
    include("../../db.php");
    if (isset($_GET['dossier_id'])) {
        $dossier_id = $_GET['dossier_id'];
        $sql = "DELETE FROM dossier_medical WHERE dossier_id = :dossier_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':dossier_id', $dossier_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ./doctor.php");
            exit();
        } else {
            echo "Error deleting record.";
        }
    } else {
        echo "No dossier_id provided.";
    }
?>