<?php
    require_once "../php/connexion/connexionbd.php";
    include "../php/header2.php";

    $req = $conn->prepare("SELECT admin FROM users WHERE id = :id");
    $req->bindParam(":id", $_SESSION["user"]["id"]);
    $req->execute();
    $isAdmin = $req->fetchAll(PDO::FETCH_ASSOC)[0]["admin"];

    if (!isset($isAdmin) || !$isAdmin) {
        header("Location: ../index.php");
        exit();
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Roomia - Panel Admin</title>
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
    </head>
    
    <body>
        <main>
            <?php
                $requetesalle = $conn->prepare("SELECT * FROM rooms");
                $requetesalle->execute();
                $salles = $requetesalle->fetchAll(PDO::FETCH_ASSOC);

                echo "<table class='dbadmin'><thead><tr>
                <th>Id</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Reviews</th>
                <th>Sits</th>
                <th>Sockets</th>
                <th>Boards</th>
                <th>Proj</th>
                <th>Batiment_Id</th>
                <th>Image</th>
                <th></th>
                <th></th>
                </tr></thead><tbody>";

                foreach ($salles as $salle) {

                    echo "<tr>";
                    foreach ($salle as $key => $value) {
                        if ($key == "image") {
                            $img = $value ? "../php/getSalleImg.php?id=".$salle["id"] : "../images/salle.jpg";
                            echo "<td><img src='". $img ."' style='width: 100px; height: auto;'></td>";
                        } else {
                            echo "<td>".$value."</td>";
                        }
                    }
                    echo "<td><a href='../php/modifier.php?thing=room&id=". $salle["id"] ."'>Modifier</a></td>";
                    echo "<td><a href='../php/supprimer.php?thing=room&id=". $salle["id"] ."'>Supprimer</a></td>";
                    echo "</tr>";
                }
            ?>

        </main>

        <br><br><br><br><br><br>

        <div class="container">
            <h1 style="text-align: center">Panel Admin</h1>
            Liens placés temporairement :
            <a href="../index.php">Retour à l'accueil</a>
            <a href="../php/connexion/log_out.php">Déconnexion</a>
            <a href="../php/ajouter_salle.php">Ajouter une salle</a>
            <br>
        </div>

        <section>
            <!-- Ajout d'un formulaire pour exécuter du SQL et afficher le résultat si besoin -->
            <div>
                <form method="post" action="" style="border: none">
                    <div>
                        <h2 style="margin-top: 0; font-family: Arial, sans-serif;">Exécuter une commande SQL</h2>
                        <input type="text" id="sqlCommand" name="sqlCommand" required 
                            placeholder="Insérez la commande ici" 
                            style="width: 100%; padding: 12px; border-radius: 10px; border: 2px solid #000; font-size: 16px;">
                    </div>

                    <button type="submit">Exécuter</button>
                </form>

                <div class="result">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sqlCommand"])) {
                        $command = $_POST["sqlCommand"];
                        try {
                            $req = $conn->prepare($command);
                            if ("SELECT" === strtoupper(substr($command, 0, 6))) {
                                $req->execute();
                                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                            } else {
                                $req->execute();
                                $result = "Commande exécutée avec succès.";
                            }

                            if (is_array($result)) echo "<pre>╭$command<br>|<br>╰-> " . htmlspecialchars(print_r($result, true)) . "</pre>";
                            else echo "<p>$command => " . htmlspecialchars($result) . "</p>";
                        } catch (Throwable $e) {
                            echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section>
            <h1 style="text-align: center;color: #4a4aff;">On pourrait cliquer sur chaque stat pour avoir le panel admin associé</h1>
            <div class="stats-grid">
                <?php
                    $stats = ["users" => 0, "rooms" => 0, "reservations" => 0, "comments" => 0, "newsletter" => 0];

                    foreach ($stats as $key => $value) {
                        $r = $conn->prepare("SELECT COUNT(id) n FROM $key");
                        $r->execute();
                        $stats[$key] = $r->fetchAll(PDO::FETCH_ASSOC)[0]["n"];
                    }

                    $r = $conn->prepare("SELECT COUNT(id) n FROM users WHERE admin = 1");
                    $r->execute();
                    $stats["admins"] = $r->fetchAll(PDO::FETCH_ASSOC)[0]["n"];

                    foreach ($stats as $key => $value) {
                        echo '<div class="stats-card">
                            <div class="stats-label">' . htmlspecialchars($key) . '</div>
                            <div class="stats-value">' . htmlspecialchars($value) . '</div>
                        </div>';
                    }
                ?>
            </div>
        </section>
    </body>
</html>