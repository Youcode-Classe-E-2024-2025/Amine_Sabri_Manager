
<?php
    include("../../db.php");

    // Check if the dossier_id is provided
    if (isset($_GET['dossier_id'])) {
        $dossier_id = $_GET['dossier_id'];

        // Prepare the DELETE SQL query
        $sql = "DELETE FROM dossier_medical WHERE dossier_id = :dossier_id";
        $stmt = $pdo->prepare($sql);

        // Bind the dossier_id to the query and execute it
        $stmt->bindParam(':dossier_id', $dossier_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirect to the contentAdmin page after successful deletion
            header("Location: ./doctor.php");  // Adjust this URL as per your structure
            exit();
        } else {
            echo "Error deleting record.";
        }
    } else {
        echo "No dossier_id provided.";
    }
?>