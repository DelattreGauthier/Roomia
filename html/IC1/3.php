<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../css/styles.css">
        <link rel="icon" href="../../images/Logo_Roomia.png" type="image/x-icon">
        <title>Roomia - IC1 - 3</title>
    </head>
    <body>
        <header>
            <a href="../../index.php"><img class="logo_accueil" onmouseout="this.src='../../images/logo_home_black.png';" onmouseover="this.src='../../images/logo_home_white.png';" src="../../images/logo_home_black.png" alt="ACCUEIL"></a>
            <nav>
                <ul>
                    <li><a href="../../html/batiments.php">Choisir un bâtiment</a></li>
                </ul>
                <input type="checkbox" id="menu_toggle" class="menu_toggle">
                <label for="menu_toggle" class="logo_menu">
                    <img src="../../images/menu.png" alt="Menu">
                </label>
                <div class="dropdown_menu">
                    <ul>
                        <li><a href="../../html/batiments.php">Choisir un bâtiment</a></li>
                        <li><a class="connexion" href="../connexion.php">Connexion</a></li>
                    </ul>
                </div>
            </nav>
            <a class="connexion" href="../connexion.php">Connexion</a>
        </header> 
        <main id="salles">
            <h1 class="texte_droite">Amphithéâtre 3</h1>
            <h5 class="texte_droite">
                <ul>
                    <li>100 places</li>
                    <li>1 tableau</li>
                    <li>10 prises</li>
                    <li>1 rétroprojecteur</li>
                </ul>
            </h5>
            <img class="img_gauche" src="../../images/AmphiType.jpg" alt="Salle 3">
            <h1 class="dispo">Horaires de disponibilité :</h1>
            <div class="salle-dispo-container">
                <ul>
                    <li class="horaire"><h5>08:00 - 09:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>09:00 - 10:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>10:00 - 11:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>11:00 - 12:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>12:00 - 13:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>13:00 - 14:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>14:00 - 15:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>15:00 - 16:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>16:00 - 17:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>17:00 - 18:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                </ul>
            </div>
            
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
