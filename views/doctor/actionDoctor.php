<?php
include('../../db.php'); // Assurez-vous que le fichier db.php est bien inclus

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données du formulaire
    $patient = trim($_POST['patient']);
    $date_dossier = trim($_POST['date_dossier']);
    $diagnostic = trim($_POST['diagnostic']);
    $traitement = trim($_POST['traitement']);
    $num = trim($_POST['num']);
    $type = trim($_POST['type']);
    $statut = trim($_POST['statut']);

    // Affichage des valeurs pour le débogage
    // echo "Date Dossier: '$patient' <br>";
    // echo "Date Dossier: '$date_dossier' <br>";
    // echo "Diagnostic: '$diagnostic' <br>";
    // echo "Traitement: '$traitement' <br>";
    // echo "Num: '$num' <br>";
    // echo "Type: '$type' <br>";
    // echo "Statut: '$statut' <br>";

    if (!empty($patient) && !empty($date_dossier) && !empty($diagnostic) && !empty($traitement) && !empty($num) && !empty($num) && !empty($type) && !empty($statut)) {
        try {
            $sql1 = "INSERT INTO dossier_medical (date_dossie, diagnostic, traitement, user_id) VALUES (:date_dossie, :diagnostic, :traitement, :user_id)";
            $sqlState = $pdo->prepare($sql1);
            $sqlState->execute([
                ':date_dossie' => $date_dossier,
                ':diagnostic' => $diagnostic,
                ':traitement' => $traitement,
                ':user_id' => $patient
            ]);

            // Récupérer l'ID du dossier médical inséré
            $dossier_id = $pdo->lastInsertId(); // Récupérer l'ID du dossier
            echo $dossier_id;
            $sql2 = "INSERT INTO chambre  (num, type, statut, dossier_id) VALUES (:num, :type, :statut, :dossier_id)";
            $sqlState = $pdo->prepare($sql2);
            $sqlState->execute([
                ':num' => $num,
                ':type' => $type,
                ':statut' => $statut,
                ':dossier_id' => $dossier_id
            ]);

            header("location:./doctor.php");
            // echo "Dossier médical ajouté avec succès !";


        } catch (Exception $e) {
            // Si une erreur survient pendant l'exécution des requêtes
            echo "Erreur lors de l'ajout du dossier médical: " . $e->getMessage();
        }
    } else {
        // Afficher un message d'erreur si les champs sont invalides
        echo "Tous les champs sont requis et le numéro doit être un nombre valide.";
    }
}
?>
