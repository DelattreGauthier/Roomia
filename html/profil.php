<?php
    require_once "../php/connexion/connexionbd.php";
    include "../php/fonctions.php";
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.php">
    <title>Roomia - Profil</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>
    <?php
        include "../php/header.php";
        include "../php/cookies.php";
        if (!isset($_SESSION["user"]["id"])) {
            header("Location: ../index.php");
            exit();
        }

        if (isset($_POST["theme"])) {
            setcookie("theme", $_POST["theme"], time() + 86400 * 365, "/");
            $theme = $_POST["theme"];
            unset($_POST["theme"]);
            header("Location: " . $_SERVER["PHP_SELF"]);
        } else {
            $theme = $_COOKIE["theme"] ?? "blanc";
        }
        
    ?>
    
    <main id="profil">

        <?php
            $req = $conn->prepare("SELECT admin FROM users WHERE id = :id");
            $req->bindParam(":id", $_SESSION["user"]["id"]);
            $req->execute();
            $isAdmin = $req->fetchAll(PDO::FETCH_ASSOC)[0]["admin"];

            echo "<h1>Mon Profil" . "</h1>";
        ?>
        <h1>Mes réservations</h1>

        <!-- Les réservations doivent être gérées de façon dynamique -->
        <!--  -->
        <div class="profile_container">
            <form action="../php/update_profile_picture.php" method="POST" enctype="multipart/form-data">
                <label for="profile_picture" style="cursor: pointer;">
                    <img class="img_profil" src="<?= $img ?>" alt="Photo de profil">
                    <img class="camera_icon" src="../images/camera.png" alt="Modifier la photo">
                </label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display: none;" onchange="this.form.submit()">
            </form>
            <h2><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'] ?></h2>
            <a href="../php/connexion/log_out.php" class="btn-deconnexion">SE DECONNECTER</a>
            <form method="post">
                <button class="btn-deconnexion" type="submit" name="theme" value="<?= isset($_COOKIE["theme"] ) ? ($_COOKIE["theme"] === "blanc" ? "noir" : "blanc") : "blanc" ?>">CHANGER DE THEME</button>
            </form>

            <?= $isAdmin ? '<a href="panel_admin.php?bd=users" style="margin-top:-10px;" class="btn-deconnexion">PANEL ADMIN</a>' : '' ?>
            <?php
            if (!empty($_SESSION['flash_error'])) {
                echo "<div class='popup error'>" . $_SESSION['flash_error'] . "</div>";
                unset($_SESSION['flash_error']);
            }
            if (!empty($_SESSION['flash_success'])) {
                echo "<div class='popup success'>" . $_SESSION['flash_success'] . "</div>";
                unset($_SESSION['flash_success']);
            }
            ?>
        </div>
        <div class="reservation_container">
            <table>
                <thead>
                    <tr>
                        <th><h3>Date</h3></th>
                        <th><h3>Heure de début</h3></th>
                        <th><h3>Heure de fin</h3></th>
                        <th><h3>Salle</h3></th>
                        <th><h3>Supprimer</h3></th>
                    </tr>
                </thead>


                <?php 

                $stmt = $conn->prepare("SELECT * FROM reservations WHERE user_id = :id ORDER BY reservation_start ASC");
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
                        echo "<td><a href='../php/supprimer.php?thing=reservations&id=" . $reservation['id'] . "&profil=1'>Supprimer</a></td>";

                    }
                } else {
                    echo "<tr><td colspan='5'>Aucune réservation trouvée.</td></tr>";
                }
                ?>
            </table>
        </div>
        
        <h1>Historique des commentaires</h1>
        
        <?php

        $stmt3 = $conn->prepare("
        SELECT c.*, r.name as room_name , c.created_at
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
                $date = date_formatter($comment["created_at"]);
                echo '<div class="comment">';
                echo '<h3>Commentaire sur la Salle '.htmlspecialchars($comment['room_name']).' :</h3>';
                echo '<p>'.$date.'</p>'; // Ajout de la date
                echo '<p>' . nl2br(htmlspecialchars($comment["comment"] ?? "")) . '</p>';
                echo '<p>Note donnée : ' . htmlspecialchars($comment["note"] == 0 ? "aucune" : $comment["note"] . "/5") . '</p>';
                echo '</div>';
            }
        } else {
            echo "<h5>Aucun commentaire trouvé.</h5>";
        }
        echo '</div>';

        ?>

    </main>
<?php include "../php/footer.php"; ?>
</body>
</html>

