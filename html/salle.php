<?php

    // HTML et CSS à revoir pour la zone commentaires/réservations

    include '../php/header2.php';
    

    include "fonctions.php";
    require_once "../php/connexion/connexionbd.php";

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    if ($id <= 0) die("La salle que vous cherchez n'existe pas.");

    // Récupération de informations de la salle
    $req = $conn->prepare("SELECT * FROM rooms WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $room = $req->fetchAll(PDO::FETCH_ASSOC);
    if (count($room) === 0) die("La salle que vous cherchez n'existe pas.");
    $room = $room[0];
    
    $salle = $room["name"];
    $avgNote = $room["rating"] ? "Note moyenne : ". $room["rating"] . " / 5" : "Pas encore de note.";
    $reviews = $room["reviews"];
    $places = $room["sits"];
    $prises = $room["sockets"];
    $tableaux = $room["boards"];
    $retroprojecteurs = $room["proj"];
    $batiment_id = $room["batiment_id"];
    $image = $room["image"];
    $img = $image ? "../php/getSalleImg.php?id=$id" : "../images/salle.jpg";

    $type = "Salle";
    $horaires = gen_horaires("#");

    $places_s = $places > 1 ? "s" : "";
    $tableaux_x = $tableaux > 1 ? "x" : "";
    $prises_s = $prises > 1 ? "s" : "";
    $retroprojecteurs_s = $retroprojecteurs > 1 ? "s" : "";

    // Récupération du nom du bâtiment
    $req2 = $conn->prepare("SELECT name FROM batiments WHERE id = :id");
    $req2->bindParam(":id", $batiment_id);
    $req2->execute();
    $batiment = $req2->fetchColumn();

    if ($reviews === 0) $commentaires = "Aucun commentaire pour le moment.";
    else {
        // Récupération des commentaires de la salle
        $req3 = $conn->prepare("SELECT * FROM comments WHERE room_id = :id");
        $req3->bindParam(":id", $id);
        $req3->execute();
        $comments = $req3->fetchAll(PDO::FETCH_ASSOC);

        if (count($comments) === 0) { // Si rooms.reviews n'est pas mis à jour lorsqu'un commentaire est envoyé (problématique)
            $commentaires = "Aucun commentaire pour le moment.";
        }
        else {
            $commentaires = [];
            
            foreach ($comments as $comment) {
                $userID = $comment["user_id"];
                $date = date_formatter($comment["created_at"]);
                $text = $comment["comment"] ? "<pre>      " . $comment["comment"] . "</pre>" : "";
                $note = $comment["note"] ? " (" . $comment["note"] . "/5)" : "";
                
                // Récupération des données de l'utilisateur
                $r = $conn->prepare("SELECT fname, lname, profile_picture FROM account WHERE id = :id");
                $r->bindParam(":id", $userID);
                $r->execute();
                $user = $r->fetchAll(PDO::FETCH_ASSOC);
                if (count($user) === 0) {
                    $user = [
                        "fname" => "Utilisateur", 
                        "lname" => "anonyme"
                    ];
                } else $user = $user[0];

                $username = $user["fname"] . " " . $user["lname"];
                $avatarURL = "../php/getUserAvatar.php?id=$userID";

                array_push($commentaires, "
                    <div class='commentaire'>
                        <div class='avatar-nom'>
                            <a href='../php/user.php?id=$userID'><img src='$avatarURL' alt='Avatar de $username' class='avatar'></a>
                            <h5>$username$note</h5> <span style='font-size: 0.7rem;font-style: italic;color: grey'>$date</span>
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
        $reservations = "Aucune réservation pour le moment.";
    }
    else {
        $reservations = [];

        foreach($res as $reservation) {
            $userID = $reservation["user_id"];
            $start = new DateTime($reservation["reservation_start"]); // Peut-être mettre un style particulier aux réservations passées/actuelles/futures
            $end = new DateTime($reservation["reservation_end"]);

            $r = $conn->prepare("SELECT fname, lname, profile_picture FROM account WHERE id = :id");
            $r->bindParam(":id", $userID);
            $r->execute();
            $user = $r->fetchAll(PDO::FETCH_ASSOC)[0];
            $username = $user["fname"] . " " . $user["lname"];
            $avatarURL = "../php/getUserAvatar.php?id=$userID";

            array_push($reservations, "<tr>
                    <td>". $start->format("d/m/Y H:i") . "</td>
                    <td>". $end->format("d/m/Y H:i") . "</td>
                    <td><a href='../php/user.php?id=$userID'><img class='img_profil' src='$avatarURL' alt='Photo de profil de $username'>$username</a></td>
                </tr>");
        }

        $reservations = implode("\n", $reservations);
    }

    echo '<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
        <title>Roomia - ' . $batiment . "-" . $salle.'</title>
    </head>
    <body>
        <main id="salles">
            <h1 class="texte_droite">' . $type . ' ' . $salle . '</h1>
            <h5 class="texte_droite">
                <ul>
                    <li>' . $places . ' place' . $places_s . '</li>
                    <li>' . $tableaux . ' tableau' . $tableaux_x . '</li>
                    <li>' . $prises . ' prise' . $prises_s . '</li>
                    <li>' . $retroprojecteurs . ' rétroprojecteur' . $retroprojecteurs_s . '</li>
                    <!-- <li>Ma note :
                        <form class="star-form" action="envoi_commentaire.php" method="post">
                        <div class="star-rating">
                            <input type="radio" id="star5" name="note" value="5">
                            <label for="star5"></label>
                            
                            <input type="radio" id="star4" name="note" value="4">
                            <label for="star4"></label>
                            
                            <input type="radio" id="star3" name="note" value="3">
                            <label for="star3"></label>
                            
                            <input type="radio" id="star2" name="note" value="2">
                            <label for="star2"></label>
                            
                            <input type="radio" id="star1" name="note" value="1">
                            <label for="star1"></label>
                        </div>
                        </form>
                    </li> -->
                    <li>' . $avgNote . '</li>
                </ul>
            </h5>
            <img class="img_gauche" src="' . $img . '" alt="Salle ' . $salle . '">
            <h1 class="dispo">Horaires de disponibilité :</h1>
            <div class="salle-dispo-container">
                <ul>
                    ' . $horaires . '
                </ul>
            </div>
            <br>

            <!-- Espace des réservations -->

            <h1 class="historique_reservations" style="text-align: center">Historique des réservations</h1>

            <div class="reservation_container">
                <table>
                    <thead>
                        <tr>
                            <th><h3>Heure de début</h3></th>
                            <th><h3>Heure de fin</h3></th>
                            <th><h3>Salle</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $reservations . '
                    </tbody>
                </table>
            </div>
            <br>

            <!-- Espace commentaires -->
            
            <div class="commentaires-container">
                ' . $commentaires . '
            </div>

            <!-- Espace commentaires -->'; ?>
                <h1 class="commentaires">Commentaires</h1>

                <!-- Formulaire de soumission -->
                <?php if (isset($_SESSION["user"])): ?>
                    <div class="commentaires-submit-container">
                        <form method="POST" class="form-commentaires" action="envoi_commentaire.php">
                            <input type="hidden" name="room_id" value="<?= $id ?>">

                            <label for="note">Note :</label>
                            <div class="star-rating">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <input type="radio" id="star<?= $i ?>" name="note" value="<?= $i ?>">
                                    <label for="star<?= $i ?>"></label>
                                <?php endfor; ?>
                            </div>

                            <label for="commentaire">Commentaire :</label>
                            <textarea name="commentaire" id="commentaire" rows="5" placeholder="Écrivez votre commentaire ici... (optionnel)"></textarea>

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
        <?php include '../php/footer2.php'; ?>
    </body>
</html>