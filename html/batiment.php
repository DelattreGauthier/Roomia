<?php
    include "fonctions.php";
    require_once "../php/connexion/connexionbd.php";

    $batID = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    if ($batID < 1 || $batID > 4) die("Le bâtiment que vous cherchez n'existe pas.<br><a href='../index.php'>Retour à la page principale.</a>");

    // Récupération du nom du bâtiment
    $req = $conn->prepare("SELECT name FROM batiments WHERE id = :id");
    $req->bindParam(":id", $batID);
    $req->execute();
    $bat = $req->fetchAll(PDO::FETCH_ASSOC)[0]["name"];

    // Récupération des salles du bâtiment
    $req = $conn->prepare("SELECT id, name, image FROM rooms WHERE batiment_id = :id ORDER BY name ASC");
    $req->bindParam(":id", $batID);
    $req->execute();
    $rooms = $req->fetchAll(PDO::FETCH_ASSOC);
    if (count($rooms) === 0) die("Ce bâtiment ne contient aucune salle.<br><a href='../index.php'>Retour à la page principale.</a>");

    // Génération du code pour les salles
    $salles = [];
    $i = 0;
    foreach ($rooms as $room) {
        $i++;
        if ($i === 10) break;
        $id = $room["id"];
        $salle = $room["name"];
        $image = $room["image"];
        $img = $image ? "../php/getSalleImg.php?id=$id" : "../images/salle.jpg";
        $horaires = gen_horaires("#");

        $salles[] = "<!-- Salle $i -->
                    <div class='salle'>
                        <a href='salle.php?id=$id' class='nom-salle'>Salle $salle</a>
                        <div class='img-container'><a href='salle.php?id=$id'><img src='$img' alt='Salle $salle'></a></div>
                        <!-- Liste des équipements de la salle -->
                        <div class='infos'>
                            <a href='salle.php?id=$id'>Plus d'informations...</a>
                        </div>
                        
                        <!-- Conteneur des horaires pour la salle -->
                        <div class='horaires-container'>
                            <ul>
                                $horaires
                            </ul>
                        </div>
                    </div>";
    }
    $salles = implode("\n                        ", $salles);

    // Génération du code pour les amphithéâtres
    $amphis = [];
    for ($i = 1; $i <= 3; $i++) {
        $id = 0;
        $horaires = gen_horaires("#");
        $img = "../images/AmphiType.jpg";

        $amphis[] = "<!-- Amphithéâtre $i -->
                    <div class='salle'>
                        <a href='salle.php?id=$id' class='nom-salle'>Amphithéâtre $i</a>
                        <div class='img-container'><a href='salle.php?id=$id'><img src='$img' alt='Amphithéâtre $i'></a></div>
                        <!-- Liste des équipements de l'amphithéâtre -->
                        <div class='infos'>
                            <a href='salle.php?id=$id'>Plus d'informations...</a>
                        </div>
                        
                        <!-- Conteneur des horaires pour l'amphithéâtre -->
                        <div class='horaires-container'>
                            <ul>
                                $horaires
                            </ul>
                        </div>
                    </div>";
    }
    $amphis = implode("\n                        ", $amphis);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Roomia - <?php echo $bat; ?></title>
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        <?php include "../php/header2.php"; ?>   
        <main id="batiment">
            <div class="titre"> 
                <h1>Bâtiment <?php echo $bat; ?></h1>
            </div>

            <div class="dropdownSC">
                <!-- Checkbox pour activer/désactiver -->
                <input type="checkbox" id="dropdown-toggleSC">
                <label for="dropdown-toggleSC"> Salles Classiques</label>
                <!-- Contenu qui s'affiche directement sur la page -->
                <div class="dropdownSC-content">
                    <!-- Conteneur principal pour toutes les salles -->
                    <div class="salles-container">
                        <?php echo $salles; ?>                        
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
                        <?php echo $amphis; ?>
                    </div>
                </div>
            </div>

        </main>

        <?php include "../php/footer2.php"; ?>

    </body>
</html>