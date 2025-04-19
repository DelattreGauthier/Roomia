<?php
    require_once "../php/connexion/connexionbd.php";
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Roomia - Profil</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>
    <?php include "../php/header2.php"; ?>
    <main id="profil">

        <?php
            $req = $conn->prepare("SELECT admin FROM users WHERE id = :id");
            $req->bindParam(":id", $_SESSION["user"]["id"]);
            $req->execute();
            $isAdmin = $req->fetchAll(PDO::FETCH_ASSOC)[0]["admin"];

            echo "<h1>Mon Profil" . ($isAdmin ? "   <a href='panel_admin.php'>Fais pas le fou</a>" : "") . "</h1>";
        ?>
        <h1>Mes réservations</h1>

        <!-- Les réservations doivent être gérées de façon dynamique -->
        <!--  -->
        <div class="profile_container">
            <?php
            $img = $_SESSION["user"]["profile_picture"] ? "../php/picture.php" : "../images/user.png";
            echo "<img class='img_profil' src='$img' alt='Photo de profil'>";
            echo "<h2>".$_SESSION['user']['fname']." ".$_SESSION['user']['lname']."</h2>";
            ?>
                <a href="../php/connexion/log_out.php" class="btn-deconnexion">SE DECONNECTER</a>
        </div>
        <div class="reservation_container">
            <table>
                <thead>
                    <tr>
                        <th><h3>Date</h3></th>
                        <th><h3>Heure de début</h3></th>
                        <th><h3>Heure de fin</h3></th>
                        <th><h3>Salle</h3></th>
                    </tr>
                </thead>


                <?php 

                $stmt = $conn->prepare("SELECT * FROM reservations WHERE user_id = :id");
                $stmt->bindParam(':id', $_SESSION['user']['id']);
                $stmt->execute();

                $tab_res= $stmt->fetchAll(PDO::FETCH_ASSOC);


                if ($tab_res) {
                    foreach ($tab_res as $reservation) {
                        // Convertit les dates en objet DateTime pour utiliser ->format()
                        $startDate = new DateTime($reservation['reservation_start']);
                        $endDate = new DateTime($reservation['reservation_end']);
                
                        echo "<tr>
                                <td>" . $startDate->format('d/m/Y') . "</td>
                                <td>" . $startDate->format('H\hi') . "</td>
                                <td>" . $endDate->format('H\hi') . "</td>";
                
                        // Récupère le nom de la salle
                        $stmt1 = $conn->prepare("SELECT name FROM rooms WHERE id = :room_id");
                        $stmt1->bindParam(':room_id', $reservation['room_id']);
                        $stmt1->execute();
                        $room_name = $stmt1->fetchColumn();

                        // Récupère le nom du bâtiment
                        $stmt2 = $conn->prepare("
                            SELECT b.name 
                            FROM batiments b
                            JOIN rooms r ON r.batiment_id = b.id
                            WHERE r.id = :room_id
                        ");
                        $stmt2->bindParam(':room_id', $reservation['room_id']);
                        $stmt2->execute();
                        $building_name = $stmt2->fetchColumn();

                        echo "<td><a href='salle.php?id=".$reservation['room_id']."'>".$building_name." ".$room_name."</a></td>";

                    }
                } else {
                    echo "<tr><td colspan='4'>Aucune réservation trouvée.</td></tr>";
                }
                ?>
            </table>
        </div>
        
        <h1>Historique des commentaires</h1>
        
        <?php

        $stmt3 = $conn->prepare("
        SELECT c.*, r.name as room_name 
        FROM comments c
        JOIN rooms r ON c.room_id = r.id
        WHERE user_id= :id");
        $stmt3->bindParam(':id', $_SESSION['user']['id']);
        $stmt3->execute();
        $comments = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        
        // Affichage des commentaires
       echo '<div class="comments_container">';
        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                echo '<div class="comment">';
                echo '<h3>Commentaire sur la Salle '.htmlspecialchars($comment['room_name']).' :</h3>';
                echo '<p>'.nl2br(htmlspecialchars($comment['comment'])).'</p>';
                echo '<p>Note donnée : '.htmlspecialchars($comment['note']).'/5</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucun commentaire trouvé.</p>";
        }
        echo '</div>';

        ?>

    </main>
<?php include "../php/footer2.php"; ?>
</body>
</html>

