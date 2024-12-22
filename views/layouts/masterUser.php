<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../login/login.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medic - Template Tailwind CSS</title>
    <!-- Thème médical réalisé par Seb Code https://seb-code.fr
        Formation Tailwind CSS : https://sebcode.systeme.io/apprendre-tailwindcss
    -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }
        .message-banner {
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .success {
            background-color: #4CAF50;
            color: white;
        }
        .error {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body class="poppins text-gray-500">
  <div class="flex justify-center">
      <?php
      if (isset($_SESSION['message'])) {
          $message = $_SESSION['message'];
          $messageType = $_SESSION['message_type']; 
          echo "<div class='message-banner w-fit " . $messageType . "'>$message</div>";
          unset($_SESSION['message']);
          unset($_SESSION['message_type']);
      }
      ?>
  </div>

    <!-- Section hero et barre de navigation -->
    <section class="bg-light pb-6">
        <div class="container px-4 mx-auto">
            <nav class="py-2 flex flex-col space-y-6 items-center md:flex-row md:justify-between md:space-y-0">
                <a class="text-indigo-700 font-bold text-4xl" href="#">
                    <img class="h-16 inline" src="../../assets/images/logo.svg" alt="Medic" > Medic
                </a>
                <ul class="font-bold flex flex-col space-y-2 items-center md:flex-row md:space-y-0 md:space-x-6">
                    <li><a class="hover:text-indigo-700" href="#">A propos</a></li>
                    <li><a class="hover:text-indigo-700" href="#">Services</a></li>
                    <li><a class="hover:text-indigo-700" href="#">Témoignages</a></li>
                </ul>
                <div class="flex gap-2">
                    <?php
                        if (isset($_SESSION['full_name'])) {
                            echo "<h1 class=\"border-2 border-indigo-700 text-white rounded-lg p-[2px] pl-10 pr-10 bg-indigo-700\">" . $_SESSION['full_name'] . "</h1>";

                        } else {
                            echo "";
                        }
                    ?>  

                    <form action="" method="POST">
                        <button type="submit" name="logout" class="bg-indigo-700 text-white px-2 py-1 rounded hover:bg-gray-500"><i class="bi bi-box-arrow-right"></i>Logout</button>
                    </form>
                </div>
                
            </nav>
            <div class="my-10 flex flex-col items-center md:flex-row ">
                <div class="w-full px-4 py-8 mb-8 order-2 md:order-1 md:w-1/2  md:mb-0">
                    <h2 class="mb-8 text-3xl lg:text-5xl font-bold text-gray-800">Une équipe à votre écoute pour <span class="text-teal-500">vous soigner</span></h2>
                    <p class="mb-6 lg:text-lg">Notre clinique offre des soins de qualité dans un cadre moderne et accueillant, avec une équipe dédiée à votre bien-être et une large gamme de services médicaux personnalisés.</p>
                    <a href="#rendez_vous"  class=" inline-block px-6 py-3 text-white font-bold hover:bg-teal-500 rounded transition duration-200 bg-indigo-700" >Rendez-vous</a>
                </div>
                <div class="w-full md:w-1/2 px-4 order-1 md:order-2">
                    <img class="" src="../../assets/images/docteur.png" alt="Docteur" data-aos="fade-up" data-aos-duration="1500">
                </div>
            </div>
        </div>
    </section>
    <!-- Section services -->
    <section class="pt-12 bg-indigo-700" data-aos="fade-up" data-aos-duration="1500">
        <div class="container px-4 pb-32 mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="mb-4 text-2xl md:text-4xl text-white font-bold">Une clinique à la pointe pour vous proposer les meilleurs soins</h2>
                <p class="mb-6 text-gray-50 lg:text-lg">&Eacute;quipée des dernières technologies médicales, notre clinique s’engage à vous offrir des soins de qualité optimale. Avec une équipe d’experts dévoués, nous proposons des services personnalisés pour répondre à vos besoins de santé. Notre priorité est votre bien-être, dans un environnement moderne, sécurisé et chaleureux.</p>
                <a class="inline-block px-6 py-2 text-sm text-white font-bold bg-teal-500 border-2 border-teal-500 hover:bg-indigo-700 hover:border-teal-500 rounded transition duration-200"
                    href="#">Découvrir</a>
            </div>
            <div class="-mb-8 lg:-mb-64">
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/3 px-4 mb-8">
                        <div class="bg-gray-50 text-center p-6 rounded shadow-lg">
                            <img class="h-12 mx-auto mb-3" src="../../assets/images/icone-docteur.svg" alt="Médecins spécialistes">
                            <h3 class="mb-3 text-2xl text-gray-800 font-bold">Médecins spécialistes</h3>
                            <p class="leading-loose">Des médecins spécialistes expérimentés, dédiés à votre santé, offrant des diagnostics précis et des traitements adaptés à vos besoins.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4 mb-8">
                        <div class="bg-gray-50 text-center p-6 rounded shadow-lg">
                            <img class="h-12 mx-auto mb-3" src="../../assets/images/icone-urgence.svg" alt="Soins d'urgence">
                            <h3 class="mb-3 text-2xl text-gray-800 font-bold">Soins d'urgence</h3>
                            <p class="leading-loose">Des soins d'urgence rapides et efficaces, assurés par une équipe médicale qualifiée dans un environnement sécurisé.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4 mb-8">
                        <div class="bg-gray-50 text-center p-6 rounded shadow-lg">
                            <img class="h-12 mx-auto mb-3" src="../../assets/images/icone-disponibilite.svg" alt="Disponibilité 24/7">
                            <h3 class="mb-3 text-2xl text-gray-800 font-bold">Disponibilité 24/7</h3>
                            <p class="leading-loose">Un service accessible 24h/24 et 7j/7 pour assurer votre santé en toute heure, avec rapidité, efficacité et un accompagnement personnalisé.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section présentation -->
    <section class="mt-24 lg:py-16" data-aos="fade-up" data-aos-duration="1500">
        <div class="container p-4 mx-auto">
            <div class="flex flex-wrap items-center gap-y-6">
                <div class="w-full md:w-1/2 px-4 order-2 md:order-1">
                    <div class="lg:max-w-2xl">
                        <h2 class="mb-4 lg:mb-8 text-3xl lg:text-5xl font-bold text-gray-800">Votre confort commence dès votre arrivée</h2>
                        <p class="mb-6 text-lg text-gray-500 leading-loose">Notre clinique vous garantit un accueil professionnel et bienveillant. Notre équipe dévouée est à votre écoute pour vous offrir une expérience sereine et personnalisée dès votre arrivée.</p>
                        <a class="inline-block text-lg px-6 py-3 text-white font-bold hover:bg-teal-500 rounded transition duration-200 bg-indigo-700" href="#">En savoir plus</a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-4 order-1 md:order-2">
                    <img class="w-full rounded-lg" src="../../assets/images/accueil-clinique.jpg" alt="Présentation de la clinique">
                </div>
            </div>
        </div>
    </section>
    <!-- Section équipe médicale -->
    <section class="py-20">
        <div class="container px-4 mx-auto">
            <div class="max-w-3xl mx-auto mb-12 lg:mb-16 text-center" data-aos="fade-up" data-aos-duration="1500">
                <h2 class="mt-2 mb-4 text-4xl lg:text-5xl font-bold text-gray-800">Une équipe hautement qualifiée</h2>
                <p class="text-lg leading-loose">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
            <div class="flex flex-wrap" data-aos="fade-up" data-aos-duration="1500">
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="p-6 pb-12 bg-gray-50 text-center rounded-lg">
                        <img class="w-full mx-auto mb-6 rounded-lg" src="../../assets/images/team-01.png" alt="">
                        <h3 class="text-2xl font-bold text-gray-800">Charles KHUTE</h3>
                        <p class="mb-6 text-lg">Chirurgien</p>
                        <div>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="p-6 pb-12 bg-gray-50 rounded-lg text-center">
                        <img class="w-full mx-auto mb-6 rounded-lg" src="../../assets/images/team-02.png" alt="">
                        <h3 class="text-2xl font-bold text-gray-800">Eva TEXAMINET</h3>
                        <p class="mb-6 text-lg">Médecin généraliste</p>
                        <div>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                    <div class="p-6 pb-12 bg-gray-50 rounded-lg text-center">
                        <img class="w-full mx-auto mb-6 rounded-lg" src="../../assets/images/team-03.png" alt="">
                        <h3 class="text-2xl font-bold text-gray-800">Dan THYSTE</h3>
                        <p class="mb-6 text-lg">Chef de service</p>
                        <div>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 py-3">
                    <div class="p-6 pb-12 bg-gray-50 rounded-lg text-center">
                        <img class="w-full mx-auto mb-6 rounded-lg" src="../../assets/images/team-04.png" alt="">
                        <h3 class="text-2xl font-bold text-gray-800">Joss KULTH</h3>
                        <p class="mb-6 text-lg">Médecin urgentiste
                        </p>
                        <div>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 py-3">
                    <div class="p-6 pb-12 bg-gray-50 rounded-lg text-center">
                        <img class="w-full mx-auto mb-6 rounded-lg" src="../../assets/images/team-05.png" alt="">
                        <h3 class="text-2xl font-bold text-gray-800">Emma TAUME</h3>
                        <p class="mb-6 text-lg">Pédiatre</p>
                        <div>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 py-3">
                    <div class="p-6 pb-12 bg-gray-50 rounded-lg text-center">
                        <img class="w-full mx-auto mb-6 rounded-lg" src="../../assets/images/team-06.png" alt="">
                        <h3 class="text-2xl font-bold text-gray-800">Ray ANYMASSION</h3>
                        <p class="mb-6 text-lg">Anesthésiste</p>
                        <div>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200 mr-8" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a class="text-2xl text-teal-500 hover:text-indigo-700 transition duration-200" href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section formulaire -->
    <section class="relative py-20 " data-aos="fade-up" data-aos-duration="1500">
        <div class="absolute top-0 left-0 lg:bottom-0 h-[28rem] lg:h-auto w-full lg:w-8/12 bg-indigo-700"></div>
        <div class="relative container px-4 mx-auto">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-1/2 px-4 mb-12 lg:mb-0">
                    <div class="max-w-xl">
                        <h2 class="mb-6 text-4xl lg:text-5xl font-bold text-white">Prendre rendez-vous en ligne</h2>
                        <p class="text-gray-50 lg:pr-10 leading-loose">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-4" id="rendez_vous">
                    <div class="lg:max-w-md p-6 bg-gray-50  rounded-lg shadow-2xl">
                        <form action="rendezVous.php" method = "POST">
                            <h1 class="text-sm text-gray-500 font-semibold uppercase text-center">DEMANDE DE RENDEZ-VOUS</h1>
                            <div class="mb-4">
                                <!-- Label et champ pour le Numéro CNI -->
                                <label for="cni"  class=" text-sm text-gray-500 font-semibold mb-2   ">CNI :</label>
                                <input id="cni" name="cni" class="w-full py-3 pl-3 bg-white rounded-lg" type="text" placeholder="Numéro CNI" required>
                            </div>
                            <div>
                                <label for="date">Date :</label>
                                <input id = "id" name="date" class="w-full py-3 pl-3 mb-4 bg-white rounded-lg" type="date" placeholder="Date de Rendez-vous" required>
                            </div>
                            <label class="inline-block mb-4">
                                <input class="mr-1" type="checkbox" name="terms" value="1" required>
                                <span class="text-sm text-gray-500">En soumettant cette demande, vous acceptez notre politique concernant vos données personnelles.</span>
                            </label>
                            <button class="w-full inline-block px-6 py-3 mr-4 text-sm text-white font-bold leading-loose bg-teal-500 hover:bg-indigo-700 rounded transition duration-200">Envoyer la demande</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pied de page -->
    <footer class="bg-gray-50 pt-4">
        <div class="container p-4 mx-auto flex flex-col items-center space-y-4 md:flex-row md:space-y-0 md:justify-between">
            <a class="text-indigo-700 font-bold text-4xl" href="#">
                <img class="h-16 inline" src="../../assets/images/logo.svg" alt="Medic"> Medic
            </a>
            <ul class="flex flex-col text-center md:flex-row md:space-x-4 text-sm">
                <li><a class="hover:text-gray-900" href="#">A propos</a></li>
                <li><a class="hover:text-gray-900" href="#">La clinique</a></li>
                <li><a class="hover:text-gray-900" href="#">Services</a></li>
                <li><a class="hover:text-gray-900" href="#">Témoignages</a></li>
            </ul>
        </div>
        <div class="container p-4 mx-auto border-t-2 flex flex-col items-center md:flex-row md:justify-between">
            <p class="text-sm mt-2 order-1 md:order-none md:mt-0">Tous les droits réservés © <a class="text-indigo-700" href="https://seb-code.fr/">Seb Code</a> 2024</p>
            <div>
                <a class="text-2xl hover:text-gray-900 mr-4" href="https://www.youtube.com/@seb-code"><i class="fa-brands fa-youtube"></i></a>
                <a class="text-2xl hover:text-gray-900 mr-4" href="https://www.facebook.com/sebcode.fr"><i class="fa-brands fa-facebook"></i></a>
                <a class="text-2xl hover:text-gray-900" href="https://amzn.to/3mG5oMJ"><i class="fa-brands fa-amazon"></i></a>
            </div>
        </div>
    </footer>
    <script>
        AOS.init(); // Initialise AOS pour les animations au défilement
    </script>
</body>
</html>