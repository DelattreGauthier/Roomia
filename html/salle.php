<?php

    // HTML et CSS à revoir pour la zone commentaires/réservations

    if (!isset($_GET["id"]) || !is_numeric($_GET["id"]) || (int)$_GET["id"] <= 0) {
        // Redirection douce vers la page principale
        header("Location: ../index.php");
        exit;
    }
    $id = (int)$_GET["id"];

    require_once "../php/connexion/connexionbd.php";
    include "../php/fonctions.php";

    // Récupération de informations de la salle
    $req = $conn->prepare("SELECT * FROM rooms WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $room = $req->fetch(PDO::FETCH_ASSOC);
    
    if (!$room) {
        header("Location: ../index.php");
        exit;
    }
    
    include "../php/header.php"; // Instruction mise ici et pas plus haut pour éviter un affichage cassé
    include "../php/cookies.php";

    $type = $room["type"];
    $salle = $type === "salle" ? "Salle " . $room["name"] : "Amphithéâtre " . $room["name"];
    $avgNote = $room["rating"] ? "Note moyenne : ". $room["rating"] . " / 5" : "Pas encore de note.";
    $reviews = $room["reviews"];
    $places = $room["sits"];
    $prises = $room["sockets"];
    $tableaux = $room["boards"];
    $retroprojecteurs = $room["proj"];
    $batiment_id = $room["batiment_id"];
    $image = $room["image"];
    $img = $image ? "../php/getSalleImg.php?id=$id" : ($type === "salle" ? "../images/salle.jpg" : "../images/AmphiType.jpg");

    $places_s = $places > 1 ? "s" : "";
    $tableaux_x = $tableaux > 1 ? "x" : "";
    $prises_s = $prises > 1 ? "s" : "";
    $retroprojecteurs_s = $retroprojecteurs > 1 ? "s" : "";

    // Récupération du nom du bâtiment
    $req2 = $conn->prepare("SELECT name FROM batiments WHERE id = :id");
    $req2->bindParam(":id", $batiment_id);
    $req2->execute();
    $batiment = $req2->fetchColumn();

    if ($reviews === 0) $commentaires = "<h5>Aucun commentaire pour le moment.</h5>";
    else {
        // Récupération des commentaires de la salle
        $req3 = $conn->prepare("SELECT * FROM comments WHERE room_id = :id");
        $req3->bindParam(":id", $id);
        $req3->execute();
        $comments = $req3->fetchAll(PDO::FETCH_ASSOC);

        if (count($comments) === 0) { // Si rooms.reviews n'est pas mis à jour lorsqu'un commentaire est envoyé (problématique)
            $commentaires = "<h5>Aucun commentaire pour le moment.</h5>";
        }
        else {
            $commentaires = [];
            
            foreach ($comments as $comment) {
                $userID = $comment["user_id"];
                $date = date_formatter($comment["created_at"]);
                $text = $comment["comment"] ? "<pre>      " . $comment["comment"] . "</pre>" : "";
                $note = $comment["note"] ? " (" . $comment["note"] . "/5)" : "";
                
                // Récupération des données de l'utilisateur
                $r = $conn->prepare("SELECT fname, lname, profile_picture FROM users WHERE id = :id");
                $r->bindParam(":id", $userID);
                $r->execute();
                $user = $r->fetchAll(PDO::FETCH_ASSOC);
                if (count($user) === 0) {
                    $user = [
                        "fname" => "Utilisateur", 
                        "lname" => "anonyme", 
                        "profile_picture" => NULL
                    ];
                } else $user = $user[0];

                $username = $user["fname"] . " " . $user["lname"];
                $avatarURL = $user["profile_picture"] ? "../php/getUserAvatar.php?id=$userID" : "../images/user.png";

                array_push($commentaires, "
                    <div class='commentaire'>
                        <div class='avatar-nom'>
                            <a href='user.php?id=$userID'><img src='$avatarURL' alt='Avatar de $username' class='avatar'></a>
                            <h3>$username$note</h3> <span>$date</span>
                        </div>
                        $text
                    </div>
                ");
            }

            $commentaires = implode("\n", $commentaires);
        }
    }

    // Récupération de l'historique des réservations
    $req = $conn->prepare("SELECT user_id, reservation_start, reservation_end FROM reservations WHERE room_id = :id ORDER BY reservation_start DESC");
    $req->bindParam(":id", $id);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);

    if (count($res) === 0) {
        $reservations = "<h5>Aucune réservation pour le moment.</h5>";
    }
    else {
        $reservations = [];

        foreach($res as $reservation) {
            $userID = $reservation["user_id"];
            $jour = date_formatter($reservation["reservation_start"], true); // Peut-être mettre un style particulier aux réservations passées/actuelles/futures
            $start = date_formatter($reservation["reservation_start"], false, true);
            $end = date_formatter($reservation["reservation_end"], false, true);

            $r = $conn->prepare("SELECT fname, lname, profile_picture FROM users WHERE id = :id");
            $r->bindParam(":id", $userID);
            $r->execute();
            $user = $r->fetchAll(PDO::FETCH_ASSOC)[0];
            $username = $user["fname"] . " " . $user["lname"];
            $avatarURL = $user["profile_picture"] ? "../php/getUserAvatar.php?id=$userID" : "../images/user.png";

            array_push($reservations, "<tr>
                    <td>$jour</td>
                    <td>$start</td>
                    <td>$end</td>
                    <td><a href='user.php?id=$userID'><img class='img_profil' src='$avatarURL' alt='Photo de profil de $username'><p>$username</p></a></td>
                </tr>");
        }

        $reservations = implode("\n", $reservations);
    }
    ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.php">
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
        <title>Roomia - <?= $batiment ?> - <?= $salle ?></title>
    </head>
    <body>
        <main id="salles">
            <h1 class="texte_droite"><?= $salle ?></h1>
            <h5 class="texte_droite">
                <ul>
                    <li><?= $places ?> place<?= $places_s ?></li>
                    <li><?= $tableaux ?> tableau<?= $tableaux_x ?></li>
                    <li><?= $prises ?> prise<?= $prises_s ?></li>
                    <li><?= $retroprojecteurs ?> rétroprojecteur<?= $retroprojecteurs_s ?></li>
                    <li><?= $avgNote ?></li>
                </ul>
            </h5>
            <img class="img_gauche" src="<?= $img ?>" alt="<?= $salle ?>">
        

            <?php
                $room_id = (int)($_GET["id"] ?? 1);
                $days = isset($_GET["days"]) ? (int)$_GET["days"] : 0;
                $user_id = isset($_SESSION["user"]) ? (int)$_SESSION["user"]["id"] : null;

                // Affichage des messages flash :
                if (!empty($_SESSION["flash_error"])) {
                    echo "<div class='popup error'>".$_SESSION["flash_error"]."</div>";
                    unset($_SESSION["flash_error"]);
                }
                if (!empty($_SESSION["flash_success"])) {
                    echo "<div class='popup success'>".$_SESSION["flash_success"]."</div>";
                    unset($_SESSION["flash_success"]);
                }
            ?>
            <h1 class="dispo">Horaires de disponibilité (<?php
                $date = new DateTime();
                $date->modify("+$days days"); // Les jours négatifs ne sont pas pris en compte
                $date = date_formatter($date->format("Y-m-d H:i:s"), true);
                echo $date;
                
                ?>)</h1>
            <div class="salle-dispo-container">
                <ul>
                    <?= gen_horaires("../php/reservation.php", $room_id, 8, 20, 1, $user_id, $days); ?>
                </ul>
            </div>
            <nav class="days-nav">
                <a href="?id=<?= $room_id ?>&days=<?= $days > 0 ? $days - 1 : 0?>" class="day-button">« Jour précédent</a>
                <a href="?id=<?= $room_id ?>&days=0" class="day-button today">Aujourd'hui</a>
                <a href="?id=<?= $room_id ?>&days=<?= $days + 1 ?>" class="day-button">Jour suivant »</a>
            </nav>
            <h1 class="historique_reservations" style="text-align: center">Historique des réservations</h1>
            <div class="reservation_container">
                <?php if (count($res) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th><h3>Jour</h3></th>
                                <th><h3>Heure de début</h3></th>
                                <th><h3>Heure de fin</h3></th>
                                <th><h3>Réservée par</h3></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $reservations ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h5>Aucune réservation pour le moment.</h5>
                <?php endif; ?>
            </div>
            <br>

            <h1 id ="commentaires" class="commentaires">Commentaires</h1>
            <div class="commentaires-container">
                <?= $commentaires ?>
            </div>

            <?php if (isset($_SESSION["user"])): ?>
                <div class="commentaires-submit-container">
                    <form method="POST" class="form-commentaires" action="../php/envoi_commentaire.php#commentaires">
                        <input type="hidden" name="room_id" value="<?= $id ?>">

                        <label for="note"><h5>Note :</h5></label>
                        <div class="star-rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" id="star<?= $i ?>" name="note" value="<?= $i ?>">
                                <label for="star<?= $i ?>"></label>
                            <?php endfor; ?>
                        </div>
                        

                        <label for="commentaire"><h5>Commentaire :</h5></label>
                        <textarea name="commentaire" id="commentaire" rows="5" placeholder="Écrivez votre commentaire ici..."></textarea>

                        <button type="submit" class="btn-commentaire">Envoyer</button>
                    </form>

                    <?php if (isset($_SESSION["errors"]["commentaire"])): ?>
                        <div class="commentaire-connexion">
                            <p><?= htmlspecialchars($_SESSION["errors"]["commentaire"]) ?></p>
                        </div>
                    <?php endif; ?>
                    <?php unset($_SESSION["errors"]); ?>

                    <?php if (isset($_SESSION["commentaire_success"])): ?>
                        <div>
                            <p class="commentaire-success"><?= htmlspecialchars($_SESSION["commentaire_success"]) ?></p>
                        </div>
                    <?php unset($_SESSION["commentaire_success"]); endif; ?>
                </div>
            <?php else: ?>
                <p class="commentaire-connexion"><a href="connexion.php">Connectez-vous</a> pour laisser un commentaire ou une note.</p>
            <?php endif; ?>
        </main>
        <?php include "../php/footer.php"; ?>
    </body>
</html>