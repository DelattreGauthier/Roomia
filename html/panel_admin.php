<?php
    require_once "../php/connexion/connexionbd.php";
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

        <section> <!-- Quelques liens plus ou moins utiles en attendant un meilleur affichage -->
            <div class="container">
                <h1>Panel Admin</h1>
                Liens placés temporairement :
                <a href="../index.php">Retour à l'accueil</a>
                <a href="../php/deconnexion.php">Déconnexion</a>
                <a href="../php/ajouter_salle.php">Ajouter une salle</a>
                <br>
            </div>
        </section>

        <section>
            <!-- Ajout d'un formulaire pour exécuter du PHP et afficher le résultat si besoin -->
            <div class="container">
                <h2>Exécuter une commande PHP</h2>
                <form method="post" action="">
                    <label for="phpCommand">Commande PHP :</label>
                    <input type="text" id="phpCommand" name="phpCommand" required>
                    <button type="submit">Exécuter</button>
                </form>
                <div class="result">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["phpCommand"])) {
                        $command = $_POST["phpCommand"];
                        try {
                            
                            $req = $conn->prepare($command);
                            if ("SELECT" === strtoupper(substr($command, 0, 6))) {
                                $req->execute();
                                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                            } else {
                                $req->execute();
                                $result = "Commande exécutée avec succès.";
                            }
                            
                            echo "<p>Résultat : " . htmlspecialchars($result) . "</p>"; // array pour SELECT
                            if (is_array($result)) {
                                echo "<pre>" . htmlspecialchars(print_r($result, true)) . "</pre>";
                            }
                        } catch (Throwable $e) {
                            echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
                        }
                    }
                    ?>
                </div>
            </div>

    </body>
</html>