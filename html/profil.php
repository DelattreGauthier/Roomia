<?php



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
    <?php include '../php/header2.php' ?>
    <main id="profil">
        <h1>Mon Profil</h1>
        <h1>Mes réservations</h1>

        <!-- Les réservations doivent être gérées de façon dynamique -->
        <!--  -->
        <div class="profile_container">
            <?php
            echo "<img class='img_profil' src='../php/picture.php' alt='Photo de profil'>";
            echo "<h2>".$_SESSION['user']['lname']." ".$_SESSION['user']['fname']."</h2>";
            ?>
                <a href="../php/connexion/log_out.php" class="btn-deconnexion">SE DECONNECTER</a>
        </div>
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
                    <tr>
                        <td>14:00</td>
                        <td>16:00</td>
                        <td>Salle 101</td>
                    </tr>
                    <tr>
                        <td>10:00</td>
                        <td>12:00</td>
                        <td>Salle 102</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h1>Historique des commentaires :</h1>

    </main>
    <?php include '../php/footer2.php' ?>
</body>
</html>
