<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex justify-center items-center min-h-screen">

<div class="bg-white shadow-lg rounded-lg w-full max-w-sm p-8">
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Inscription</h2>

    <form action="insert_user.php" method="POST" id='signupForm'>
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <div class="mb-4">
            <label for="fullname" class="block text-gray-700">Nom complet</label>
            <input type="text" id="fullname" name="fullname" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Mot de passe</label>
            <input type="password" id="password" name="password" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
        </div>
        <div class="mt-6">
            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">S'inscrire</button>
        </div>
    </form>

    <p class="mt-4 text-center text-gray-600">Vous avez déjà un compte ? <a href="../login/login.php" class="text-blue-600 hover:underline">Se connecter</a></p>
</div>
<script src="../../assets/js/main.js"></script>
</body>
</html>
