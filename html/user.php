<?php
    include "../php/fonctions.php";
    require_once "../php/connexion/connexionbd.php";

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    if ($id <= 0) die("Le profil que vous cherchez n'existe pas.<br><a href='../index.php'>Retour à la page principale.</a>");

    // Récupération des informations de l'utilisateur
    $req = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if (!$user) die("Le profil que vous cherchez n'existe pas.<br><a href='../index.php'>Retour à la page principale.</a>");

    $username = htmlspecialchars($user["fname"] . " " . $user["lname"]);
    $avatarURL = $user["profile_picture"] ? "../php/getUserAvatar.php?id=$id" : "../images/user.png";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.php">
    <title>Roomia - Profil de <?= $username ?></title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>
    <?php include "../php/header.php"; include "../php/cookies.php";?>
    <main id="profil">

        <h1>Profil de <?= $username ?></h1>
        <h1>Historique des réservations</h1>

        <div class="profile_container">
            <img class="img_profil" src="<?= $avatarURL ?>" alt="Photo de profil">
            <h2><?= $username ?></h2>
        </div>

        <div class="reservation_container">
            <table>
                <thead>
                    <tr>
                        <th><h3>Date</h3></th>
                        <th><h3>Heure de début</h3></th>
                        <th><h3>Heure de fin</h3></th>
                        <th><h3>Salle / Amphi</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupération des réservations de l'utilisateur
                    $stmt = $conn->prepare("
                        SELECT r.reservation_start, r.reservation_end, rm.name AS room_name, b.name AS building_name, r.room_id
                        FROM reservations r
                        JOIN rooms rm ON r.room_id = rm.id
                        JOIN batiments b ON rm.batiment_id = b.id
                        WHERE r.user_id = :id
                        ORDER BY r.reservation_start DESC
                    ");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($reservations) {
                        foreach ($reservations as $reservation) {
                            $startDate = new DateTime($reservation['reservation_start']);
                            $endDate = new DateTime($reservation['reservation_end']);
                            echo "<tr>
                                    <td>" . $startDate->format('d/m/Y') . "</td>
                                    <td>" . $startDate->format('H\hi') . "</td>
                                    <td>" . $endDate->format('H\hi') . "</td>
                                    <td><a href='../html/salle.php?id=" . $reservation['room_id'] . "'>" . htmlspecialchars($reservation['building_name']) . " " . htmlspecialchars($reservation['room_name']) . "</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Aucune réservation trouvée.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h1>Historique des commentaires</h1>

        <div class="comments_container">
            <?php
            // Récupération des commentaires de l'utilisateur
            $stmt = $conn->prepare("
                SELECT c.comment, c.note, c.created_at, r.name AS room_name, c.room_id
                FROM comments c
                JOIN rooms r ON c.room_id = r.id
                WHERE c.user_id = :id
                ORDER BY c.created_at DESC
            ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($comments) {
                foreach ($comments as $comment) {
                    $date = date_formatter($comment["created_at"]);
                    echo '<div class="comment">';
                    echo '<h3>Commentaire sur la Salle ' . htmlspecialchars($comment['room_name']) . ' :</h3>';
                    echo '<p>' . $date . '</p>';
                    echo '<p>' . nl2br(htmlspecialchars($comment["comment"] ?? "")) . '</p>';
                    echo '<p>Note donnée : ' . htmlspecialchars($comment["note"] === 0 ? "aucune" : $comment["note"] . "/5") . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<h5>Aucun commentaire trouvé.</h5>";
            }
            ?>
        </div>

    </main>
    <?php include "../php/footer.php"; ?>
</body>
</html>