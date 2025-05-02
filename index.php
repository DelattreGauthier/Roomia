<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.php">
        <title>Roomia - Accueil</title>
        <link rel="icon" href="images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        <header>
            <?php
                session_start();
                include 'php/cookies.php';

                $theme = isset($_COOKIE["theme"]) ? $_COOKIE["theme"] : "blanc";
                $house = $theme === "blanc" ? "images/logo_home_black.png" : "images/logo_home_white.png";
            ?>

            <a class="logo_accueil_container" href="index.php"><img class="logo_accueil" onmouseout="this.src='<?= $house ?>';" onmouseover="this.src='images/logo_home_white.png';" src='<?= $house ?>' alt="ACCUEIL"></a>
            <nav>
                <ul>
                    <li><a href="html/batiments.php">Choisir un bâtiment</a></li>
                </ul>
                <input type="checkbox" id="menu_toggle" class="menu_toggle">
                <label for="menu_toggle" class="logo_menu">
                    <img src="images/menu.png" alt="Menu">
                </label>
                <div class="dropdown_menu">
                    <ul>
                        <li><a href="html/batiments.php">Choisir un bâtiment</a></li>
                        <?php
            
                        if(isset($_SESSION["user"])) { // si un utilisateur est authentifié
                            echo "<li><a href='html/profil.php'>Mon Profil</a></li>";
                        }
                        else{
                            echo"<li><a class='connexion' href='html/connexion.php'>Connexion</a></li>";
                        }
                        ?>
                    </ul>
                    
                </div>
            </nav>
            <?php
            
                if(isset($_SESSION["user"])) { // si un utilisateur est authentifié
                    $img = $_SESSION["user"]["profile_picture"] ? "php/picture.php" : "images/user.png";
                    echo "<a class='logo_profile_container' href='html/profil.php'><img  class='profil' src='$img'></a>";
                }
                else{
                    echo"<a class='connexion' href='html/connexion.php'>Connexion</a>";
                }
                
            ?>
        </header>
           
        <main id="page_bienvenue">
                <h1 class="texte_gauche">Roomia, c'est quoi ?</h1>
                <h5 class="texte_gauche">Roomia est une plateforme conçue pour centraliser toutes les informations essentielles sur les salles de Junia. Accessible et pratique, elle permet de trouver rapidement l’espace adapté à vos besoins, en rendant la gestion des lieux plus intuitive et efficace.</h5>
                <img class="img_droite" src="images/Isen_horizontal_3.JPG" alt="Bâtiment ISEN">
                <h1 class="texte_droite">Qui sommes-nous ?</h1>
                <h5 class="texte_droite">Nous sommes un groupe d'étudiants en première année du Cycle Informatique et Réseaux à Junia, au sein de l’ISEN. Ce projet a vu le jour dans le cadre de nos cours de Développement Web et répond à un problème concret que nous avons rencontré : trouver une salle libre pour travailler ou réviser est souvent un véritable casse-tête. Avec Roomia, nous avons voulu simplifier cette recherche et rendre l’accès aux salles plus rapide et intuitif pour tous.</h5>
                <img class="img_gauche"src="images/Isa_horizontal_1.JPG" alt="Bâtiment ISA">
                <h1 class="texte_gauche2">Vers un avenir radieux</h1>
                <h5 class="texte_gauche2">Roomia est conçu pour évoluer avec vos besoins. À terme, nous souhaitons intégrer des fonctionnalités comme la réservation en ligne ou l’affichage des disponibilités des salles en temps réel. Nous croyons que ce projet peut non seulement simplifier l’organisation quotidienne, mais aussi renforcer l’efficacité et la collaboration au sein de Junia. Vos retours seront essentiels pour améliorer continuellement Roomia et en faire un outil incontournable pour tous.</h5>
                <img class="img_droite2" src="images/Ns_horizontal_1.JPG" alt="Bâtiment NS">
        </main>

    <!-- </body> -->

        <footer id="footer">

        <?php
            require_once 'php/connexion/connexionbd.php';

            // --- GESTION COOKIES ---
            $cookie_accepted = isset($_COOKIE['cookie_yes']);
            if (!$cookie_accepted && isset($_POST['accept_cookies'])) {
                if (setcookie('cookie_yes', 'accepted', time() + (3600 * 24 * 365), "/")) {
                    $cookie_accepted = true;
                }
            }
            if (!$cookie_accepted) {
                echo '
                <div id="cookie-popup" class="cookie-popup">
                    <div class="cookie-content">
                        <form method="post">
                            <p>Ce site utilise des cookies pour améliorer l\'expérience utilisateur. En continuant à utiliser ce site, vous acceptez notre utilisation des cookies. Pour plus d\'informations vous pouvez cliquer <a href="html/cookies.php">ici</a></p>
                            <br>
                            <button type="submit" name="accept_cookies" value="yes">Accepter</button>
                        </form>
                    </div>
                </div>
                ';
            }

            // --- TRAITEMENT NEWSLETTER ---
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email-newsletter'])) {
                $email = htmlspecialchars(trim($_POST['email-newsletter']));

                if (empty($email)) {
                    $_SESSION['newsletter'] = 'empty';
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['newsletter'] = 'invalid';
                    header("Location: ".$_SERVER['PHP_SELF']);
                    exit();
                } else {
                    try {
                        $check = $conn->prepare("SELECT COUNT(*) FROM newsletter WHERE email = :email");
                        $check->bindParam(':email', $email);
                        $check->execute();
                        $exists = $check->fetchColumn();

                        if ($exists == 0) {
                            $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (:email)");
                            $stmt->bindParam(':email', $email);
                            $stmt->execute();
                            $_SESSION['newsletter'] = 'success';
                            header("Location: ".$_SERVER['PHP_SELF']);
                            exit();
                        } else {
                            $_SESSION['newsletter'] = 'exists';
                            header("Location: ".$_SERVER['PHP_SELF']);
                            exit();
                        }
                    } catch (PDOException $e) {
                        $_SESSION['newsletter'] = 'error';
                        header("Location: ".$_SERVER['PHP_SELF']);
                        exit();
                    }
                }
            }

            // --- MESSAGE AFFICHÉ COMME POPUP ---
            $toast = '';
            if (isset($_SESSION['newsletter'])) {
                switch ($_SESSION['newsletter']) {
                    case 'success':
                        $toast = "<div class='toast success'>Merci pour votre inscription !</div>";
                        break;
                    case 'exists':
                        $toast = "<div class='toast warning'>Cet email est déjà inscrit.</div>";
                        break;
                    case 'invalid':
                        $toast = "<div class='toast error'>Adresse email invalide.</div>";
                        break;
                    case 'empty':
                        $toast = "<div class='toast error'>Veuillez entrer votre adresse email.</div>";
                        break;
                    case 'error':
                        $toast = "<div class='toast error'>Une erreur est survenue. Veuillez réessayer.</div>";
                        break;
                }
                unset($_SESSION['newsletter']);
                echo $toast;
            }
            ?>

            <div class="grid-container">
                <div class="gauche">
                    <h4>Nous contacter</h4><br>
                    <div><a href="mailto:roomiacontact@gmail.com">roomiacontact@gmail.com</a></div>
                </div>
                <div class="centre"><h4>Roomia &#169;</h4></div>
                <div class="droite">
                    <h4>Notre Newsletter</h4><br>
                    <div id="Newsletter">
                        <form method="POST" action="">
                            <input type="email" name="email-newsletter" placeholder="Votre email" required>
                            <button onclick="location.href='#footer'" class="btn-footer"> > </button>
                        </form>
                    </div>
                </div>
            </div>

        </footer>
    </body>
</html>