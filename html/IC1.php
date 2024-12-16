<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Roomia - IC1</title>
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
           
        <main id="batiment">
            <div class="titre"> 
                <h1>Bâtiment IC1</h1>
            </div>

            <div class="dropdownSC">
                <!-- Checkbox pour activer/désactiver -->
                <input type="checkbox" id="dropdown-toggleSC">
                <label for="dropdown-toggleSC"> Salles Classiques</label>
                <!-- Contenu qui s'affiche directement sur la page -->
                <div class="dropdownSC-content">
                    <!-- Conteneur principal pour toutes les salles -->
                    <div class="salles-container">
                        <!-- Salle 2 -->
                        <div class="salle">
                            <a href="IC1/114.php" class="nom-salle">Salle 114</a>
                            <div class="img-container"><a href="IC1/114.php"><img src="../images/IC1_114_front.jpg" alt="Salle 114"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/114.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/114.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 3 -->
                        <div class="salle">
                            <a href="IC1/158.php" class="nom-salle">Salle 158</a>
                            <div class="img-container"><a href="IC1/158.php"><img src="../images/salle.jpg" alt="Salle 158"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/158.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/158.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 4 -->
                        <div class="salle">
                            <a href="IC1/173.php" class="nom-salle">Salle 173</a>
                            <div class="img-container"><a href="IC1/173.php"><img src="../images/salle.jpg" alt="Salle 173"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/173.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/173.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 5 -->
                        <div class="salle">
                            <a href="IC1/187.php" class="nom-salle">Salle 187</a>
                            <div class="img-container"><a href="IC1/187.php"><img src="../images/salle.jpg" alt="Salle 187"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/187.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/187.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 7 -->
                        <div class="salle">
                            <a href="IC1/217.php" class="nom-salle">Salle 217</a>
                            <div class="img-container"><a href="IC1/217.php"><img src="../images/IC1_217_front.jpg" alt="Salle 217"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/217.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/217.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 8 -->
                        <div class="salle">
                            <a href="IC1/256.php" class="nom-salle">Salle 256</a>
                            <div class="img-container"><a href="IC1/256.php"><img src="../images/salle.jpg" alt="Salle 256"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/256.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/256.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 9 -->
                        <div class="salle">
                            <a href="IC1/261.php" class="nom-salle">Salle 261</a>
                            <div class="img-container"><a href="IC1/261.php"><img src="../images/salle.jpg" alt="Salle 261"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/261.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/261.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 10 -->
                        <div class="salle">
                            <a href="IC1/264.php" class="nom-salle">Salle 264</a>
                            <div class="img-container"><a href="IC1/264.php"><img src="../images/salle.jpg" alt="Salle 264"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/264.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/264.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 12 -->
                        <div class="salle">
                            <a href="IC1/318.php" class="nom-salle">Salle 318</a>
                            <div class="img-container"><a href="IC1/318.php"><img src="../images/salle.jpg" alt="Salle 318"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/318.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/318.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 13 -->
                        <div class="salle">
                            <a href="IC1/332.php" class="nom-salle">Salle 332</a>
                            <div class="img-container"><a href="IC1/332.php"><img src="../images/salle.jpg" alt="Salle 332"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/332.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/332.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 14 -->
                        <div class="salle">
                            <a href="IC1/356.php" class="nom-salle">Salle 356</a>
                            <div class="img-container"><a href="IC1/356.php"><img src="../images/salle.jpg" alt="Salle 356"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/356.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/356.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 15 -->
                        <div class="salle">
                            <a href="IC1/453.php" class="nom-salle">Salle 453</a>
                            <div class="img-container"><a href="IC1/453.php"><img src="../images/salle.jpg" alt="Salle 453"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/453.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/453.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 16 -->
                        <div class="salle">
                            <a href="IC1/461.php" class="nom-salle">Salle 461</a>
                            <div class="img-container"><a href="IC1/461.php"><img src="../images/salle.jpg" alt="Salle 461"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/461.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/461.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 17 -->
                        <div class="salle">
                            <a href="IC1/518.php" class="nom-salle">Salle 518</a>
                            <div class="img-container"><a href="IC1/518.php"><img src="../images/salle.jpg" alt="Salle 518"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/518.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/518.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 18 -->
                        <div class="salle">
                            <a href="IC1/542.php" class="nom-salle">Salle 542</a>
                            <div class="img-container"><a href="IC1/542.php"><img src="../images/salle.jpg" alt="Salle 542"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/542.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/542.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        

                        <!-- Salle 19 -->
                        <div class="salle">
                            <a href="IC1/548.php" class="nom-salle">Salle 548</a>
                            <div class="img-container"><a href="IC1/548.php"><img src="../images/salle.jpg" alt="Salle 548"></a></div>
                            <!-- Liste des équipements de la salle -->
                            <div class="infos">
                                <a href="IC1/548.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour la salle -->
                            <div class="horaires-container">
                                <ul>
                                    <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/548.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="dropdownAMP">
                <!-- Checkbox pour activer/désactiver -->
                <input type="checkbox" id="dropdown-toggleAMP">
                <label for="dropdown-toggleAMP">Amphithéâtres</label>
                <!-- Contenu qui s'affiche directement sur la page -->
                <div class="dropdownAMP-content">
                    <!-- Conteneur principal pour tous les amphithéâtres -->
                    <div class="salles-container">
                      <!-- Amphithéâtre 1 -->
                        <div class="salle">
                            <a href="IC1/1.php" class="nom-salle">Amphithéâtre 1</a>
                            <div class="img-container"><a href="IC1/1.php"><img src="../images/AmphiType.jpg" alt="Amphithéâtre 1"></a></div>
                            <!-- Liste des équipements de l'amphithéâtre -->
                            <div class="infos">
                                <a href="IC1/1.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour l'amphithéâtre -->
                            <div class="horaires-container">
                                <ul>
                                  <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/1.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>

                      <!-- Amphithéâtre 1 -->
                        <div class="salle">
                            <a href="IC1/2.php" class="nom-salle">Amphithéâtre 2</a>
                            <div class="img-container"><a href="IC1/2.php"><img src="../images/AmphiType.jpg" alt="Amphithéâtre 2"></a></div>
                            <!-- Liste des équipements de l'amphithéâtre -->
                            <div class="infos">
                                <a href="IC1/2.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour l'amphithéâtre -->
                            <div class="horaires-container">
                                <ul>
                                  <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/2.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>

                      <!-- Amphithéâtre 1 -->
                        <div class="salle">
                            <a href="IC1/3.php" class="nom-salle">Amphithéâtre 3</a>
                            <div class="img-container"><a href="IC1/3.php"><img src="../images/AmphiType.jpg" alt="Amphithéâtre 3"></a></div>
                            <!-- Liste des équipements de l'amphithéâtre -->
                            <div class="infos">
                                <a href="IC1/3.php">Plus d'informations...</a>
                            </div>
                            
                            <!-- Conteneur des horaires pour l'amphithéâtre -->
                            <div class="horaires-container">
                                <ul>
                                  <li class="horaire">08:00 - 09:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">09:00 - 10:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">10:00 - 11:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">11:00 - 12:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">12:00 - 13:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">13:00 - 14:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">14:00 - 15:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">15:00 - 16:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">16:00 - 17:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                    <li class="horaire">17:00 - 18:00 : Libre<form action="IC1/3.php" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <footer>
            
            <div class="grid-container">
                <div class="gauche">
                    <h4>Nous contacter</h4><br>
                    <div><a href="mailto:roomiacontact@gmail.com">roomiacontact@gmail.com</a></div>
                </div>
                <div class="centre"><h4>Roomia &#169</h4></div>
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