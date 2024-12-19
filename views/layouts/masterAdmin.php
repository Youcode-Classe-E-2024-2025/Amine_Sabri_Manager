<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Admin Dashboard'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <?php include '../include/navAdmin.php'; ?>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-700">Bienvenue, Admin</h2>
                <div class="flex items-center space-x-4">
                <button class="bg-blue-600 text-white py-2 px-4 rounded">Nouveau</button>
                <button class="bg-gray-200 py-2 px-4 rounded">Déconnexion</button>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="users bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800">Users</h3>
                    <?php 
                        $sqlCount = $pdo->prepare("SELECT COUNT(*) FROM \"user\" WHERE status = 'actif'");
                        $sqlCount->execute();
                        $total_users = $sqlCount->fetchColumn();
                    ?>
                    <p class="text-2xl font-bold text-blue-600"><?php echo $total_users?></p>
                </div>
                <div class="archive bg-white p-6 shadow-lg rounded-lg" >
                    <h3 class="text-xl font-semibold text-gray-800">Archive</h3>
                    <?php 
                        $sqlCount = $pdo->prepare("SELECT COUNT(*) FROM \"user\" WHERE status = 'archivé'");
                        $sqlCount->execute();
                        $total_users_archive = $sqlCount->fetchColumn();
                    ?>
                    <p class="text-2xl font-bold text-blue-600"><?php echo $total_users_archive?></p>
                </div>
                <div class="bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800">Commandes</h3>
                    <p class="text-2xl font-bold text-blue-600">78</p>
                </div>
            </div>
            <section class="UserActif">
                <?php echo $content; ?>
            </section>
            <section class="usersArchive hidden">
            <?php echo $userArchif; ?>
            </section>
        </div>

    </div>

    <script>
        const UserActif = document.querySelector(".UserActif");  
        const usersArchive = document.querySelector(".usersArchive"); 
        const users = document.querySelector(".users");  
        const archive = document.querySelector(".archive"); 

        archive.addEventListener('click', function() {
            usersArchive.classList.remove('hidden');
            UserActif.classList.add('hidden');
        });
        users.addEventListener('click', function() {
            UserActif.classList.remove('hidden');
            usersArchive.classList.add('hidden');
        });
    </script>
</body>
</html>