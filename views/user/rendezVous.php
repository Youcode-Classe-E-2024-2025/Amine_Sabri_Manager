<?php
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
?>
<?php
session_start();
include("../../db.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $userId = $_SESSION['user_id'];
    $CNI = $_POST["cni"];
    $date = $_POST["date"];

    if (!empty($userId) && !empty($CNI) && !empty($date)) {
        $sql = "INSERT INTO rendez_vous (cni, date_rendez_vous, user_id) VALUES ('$CNI', '$date', '$userId')";

        try {
            $pdo->exec($sql);
            $_SESSION['message'] = "Rendez-vous successfully created!";
            $_SESSION['message_type'] = 'success'; 
            header("location: ./user.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
            $_SESSION['message_type'] = 'error';
            header("location: ./user.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields.";
        $_SESSION['message_type'] = 'error';
        header("location: ./user.php");
        exit();
    }
}
?>
