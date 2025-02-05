<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Roomia - Connexion</title>
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        <header>
            <a href="../index.php"><img class="logo_accueil" onmouseout="this.src='../images/logo_home_black.png';" onmouseover="this.src='../images/logo_home_white.png';" src="../images/logo_home_black.png" alt="ACCUEIL"></a>
            <nav>
                <ul>
                    <li><a href="../html/batiments.php">Choisir un bâtiment</a></li>
                </ul>
                <input type="checkbox" id="menu_toggle" class="menu_toggle">
                <label for="menu_toggle" class="logo_menu">
                    <img src="../images/menu.png" alt="Menu">
                </label>
                <div class="dropdown_menu">
                    <ul>
                        <li><a href="../html/batiments.php">Choisir un bâtiment</a></li>
                        <li><a class="connexion" href="../html/connexion.php">Connexion</a></li>
                    </ul>
                </div>
            </nav>
            <a class="connexion" href="#">Connexion</a>
        </header>
        
        <main id="page_connexion">

            <form class="form-container">
                <fieldset>

                    <!-- Genre -->
                    <div class="form-group">
                        <label>Genre :</label>
                        <div class="radio-group">
                            <input type="radio" name="genre" id="madame">
                            <label class="radio-label" for="madame">Madame</label>
                            <input type="radio" name="genre" id="monsieur">
                            <label class="radio-label" for="monsieur">Monsieur</label>
                        </div>
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="lname">Nom :</label>
                        <input type="text" id="lname" placeholder="Votre nom">
                    </div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label for="fname">Prénom :</label>
                        <input type="text" id="fname" placeholder="Votre prénom">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Adresse email :</label>
                        <input type="email" id="email" placeholder="Votre email">
                    </div>

                    <!-- Boutons -->
                    <button type="submit" class="btn-submit">S'INSCRIRE</button>
                </fieldset>
            </form>
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
                        <input type="email" placeholder="Votre email">
                        <button type="submit" class="btn-footer"> > </button>
                    </div>
                </div>
            </div>

        </footer>

    </body>
</html>