<?php
session_start();
include('../../db.php');

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Échec de la validation CSRF");
    }

    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = 'SELECT u.id, u.full_name, u.email, u.password,u.is_confirmed ,u.status,r.name
                FROM "user" u
                JOIN "role" r ON u.role_id = r.id
                WHERE u.email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['name'];

            if ($user['name'] === 'user') {
                if ($user['is_confirmed'] === false) {
                    echo "<script>
                            alert('Veuillez attendre que votre compte soit confirmé.');
                            window.location.href = 'login.php';
                          </script>";
                }elseif ($user['status'] === "archivé"){
                    echo "<script>
                            alert('Votre compte est bloqué temporairement.');
                            window.location.href = 'login.php';
                          </script>";
                }else {
                    header('Location: ../user/user.php');
                    exit;
                }
                 
            }
             elseif ($user['name'] === 'admin') {
                header('Location: ../admin/admin.php');
            } elseif ($user['name'] === 'doctor') {
                header('Location: ../doctor/doctor.php');
            } else {
                echo "Rôle inconnu, veuillez contacter l'administrateur.";
            }
            exit;
        } else {
            $error_message = "Identifiants incorrects.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex justify-center items-center min-h-screen">

<div class="bg-white shadow-lg rounded-lg w-full max-w-sm p-8">
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Se connecter</h2>

    <?php
    if (isset($error_message)) {
        echo '<div class="bg-red-200 text-red-800 p-4 mb-4 rounded">' . $error_message . '</div>';
    }
    ?>

    <form action="" method="POST" id="loginForm">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Mot de passe</label>
            <input type="password" id="password" name="password" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Se connecter</button>
        </div>
    </form>

    <p class="mt-4 text-center text-gray-600">Vous n'avez pas de compte ? <a href="../logout/logout.php" class="text-blue-600 hover:underline">S'inscrire</a></p>
</div>

</body>
</html>
