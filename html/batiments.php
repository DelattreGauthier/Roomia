<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Roomia - Bâtiments</title>
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
                        <li><a class="connexion" href="connexion.php">Connexion</a></li>
                    </ul>
                </div>
            </nav>
            <a class="connexion" href="connexion.php">Connexion</a>
        </header> 

        <main id="page_batiments">
            <!-- Îlot Colson 1 -->
            <a href="IC1.php">
            <img id="ic1" src="../images/Ic1_horizontal_1_cropped.jpg" alt="Îlot Colson 1"> 
            <h1>IC1</h1>
            </a>
            <!-- Îlot Colson 2 -->
             <a href="IC2.php">
            <img id="ic2" src="../images/Isen_vertical_1.JPG" alt="Îlot Colson 2">
            <h1>IC2</h1>
            </a>
            <!-- Albert Le Grand -->
             <a href="ALG.php">
            <img id="alg" src="../images/Isa_vertical_1.JPG" alt="Albert Le Grand">
            <h1>ALG</h1>
            </a>
            <!-- Norbert Ségard -->
            <a href="NS.php">
            <img id="ns" src="../images/Ns_vertical_1.JPG" alt="Norbert Ségard">
            <h1>NS</h1>
            </a>
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