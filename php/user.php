<?php
    include "../html/fonctions.php";
    require_once "connexion/connexionbd.php";

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    if ($id <= 0) die("Le profil que vous cherchez n'existe pas.<br><a href='../index.php'>Retour à la page principale.</a>");

    $req = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $user = $req->fetchAll(PDO::FETCH_ASSOC);
    if (count($user) === 0) die("Le profil que vous cherchez n'existe pas.<br><a href='../index.php'>Retour à la page principale.</a>");
    $user = $user[0];

    $username = $user["fname"] . " " . $user["lname"];
    $avatarURL = $user["profile_picture"] ? "getUserAvatar.php?id=$id" : "../images/user.png";

    // Récupération de l'historique des réservations'
    $req = $conn->prepare("SELECT room_id, reservation_start, reservation_end FROM reservations WHERE user_id = :id ORDER BY reservation_start DESC");
    $req->bindParam(":id", $id);
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_ASSOC);

    if (count($res) === 0) {
        $reservations = "Aucune réservation pour le moment.";
    }
    else {
        $reservations = [];

        foreach($res as $reservation) {
            $room_id = $reservation["room_id"];
            $jour = date_formatter($reservation["reservation_start"], true); // Peut-être mettre un style particulier aux réservations passées/actuelles/futures
            $start = date_formatter($reservation["reservation_start"], false, true);
            $end = date_formatter($reservation["reservation_end"], false, true);

            $r = $conn->prepare("SELECT rooms.name, batiments.name AS batiment_name FROM rooms JOIN batiments ON batiments.id = rooms.batiment_id WHERE rooms.id = :id");
            $r->bindParam(":id", $room_id);
            $r->execute();
            $names = $r->fetchAll(PDO::FETCH_ASSOC)[0];
            $salle = $names["name"];
            $batiment = $names["batiment_name"];

            array_push($reservations, "<tr>
                    <td>" . $jour . "</td>
                    <td>" . $start . "</td>
                    <td>" . $end . "</td>
                    <td><a href='../html/salle.php?id=$room_id'>Salle $batiment $salle</a></td>
                </tr>");
        }

        $reservations = implode("\n", $reservations);
    }

    // Récupération des commentaires de l'utilisateur
    $req2 = $conn->prepare("SELECT * FROM comments WHERE user_id = :id");
    $req2->bindParam(":id", $id);
    $req2->execute();
    $comments = $req2->fetchAll(PDO::FETCH_ASSOC);

    if (count($comments) === 0) {
        $commentaires = "Aucun commentaire pour le moment.";
    }
    else {
        $commentaires = [];
        
        foreach ($comments as $comment) {
            $room_id = $comment["room_id"];
            $text = $comment["comment"];
            $note = $comment["note"] ? " (" . $comment["note"] . "/5)" : "";
            $date = date_formatter($comment["created_at"]);

            $r = $conn->prepare("SELECT rooms.name, batiments.name AS batiment_name FROM rooms JOIN batiments ON batiments.id = rooms.batiment_id WHERE rooms.id = :id");
            $r->bindParam(":id", $room_id);
            $r->execute();
            $names = $r->fetchAll(PDO::FETCH_ASSOC)[0];
            $salle = $names["name"];
            $batiment = $names["batiment_name"];

            array_push($commentaires, "
                <div class='commentaire'>
                    <div class='avatar-nom'>
                        <a href='user.php?id=$id'><img src='$avatarURL' alt='Avatar de $username' class='avatar'></a>
                        <h5>$username$note</h5> <span style='font-size: 0.7rem;font-style: italic;color: grey'>$date</span>
                    </div>
                    <pre><a href='../html/salle.php?id=$room_id'>$batiment $salle</a> : $text</pre>
                </div>
            ");
        }
    }

    $commentaires = implode("\n", $commentaires);

    echo '<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Roomia - Profil</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>';
    include "header2.php";
    echo '<main id="profil">
        <h1>Profil utilisateur</h1>
        <h1>Historique des réservations</h1>

        <div class="profile_container">
            <img class="img_profil" src="' . $avatarURL . '" alt="Photo de profil">
            <h2>' . $username . '</h2>
        </div>
        <div class="reservation_container">
            <table>
                <thead>
                    <tr>
                        <th><h3>Jour</h3></th>
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
        <h1>Historique des commentaires :</h1>
            ' . $commentaires . '
    </main>';
    include "footer2.php";
    echo '
</body>
</html>'

?>