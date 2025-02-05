<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>Roomia - Accueil</title>
        <link rel="icon" href="images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        <header>
            <a href="index.php"><img class="logo_accueil" onmouseout="this.src='images/logo_home_black.png';" onmouseover="this.src='images/logo_home_white.png';" src="images/logo_home_black.png" alt="ACCUEIL"></a>
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
                        <li><a class="connexion" href="html/connexion.php">Connexion</a></li>
                    </ul>
                    
                </div>
            </nav>
            <a class="connexion" href="html/connexion.php">Connexion</a>

 

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

        <footer>
            
            <div class="grid-container">
                <div class="gauche">
                    <h4>Nous contacter</h4><br>
                    <div><a href="mailto:roomiacontact@gmail.com">roomiacontact@gmail.com</a></div>
                </div>
                <div class="centre"><h4>Roomia &#169;</h4></div>
                <div class="droite">
                    <h4>Notre Newsletter</h4><br>
                    <div id="Newsletter">
                        <input type="email" id="email" placeholder="Votre email">
                        <button type="submit" class="btn-footer"> > </button>
                    </div>
                </div>
            </div>

        </footer>
    </body>
</html>