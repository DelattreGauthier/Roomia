<?php
    require_once "../php/connexion/connexionbd.php";
    include "../php/header.php";
    include "../php/cookies.php";
    
    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION["user"]["id"])) {
        header("Location: ../index.php");
        exit();
    }

    // Vérifier si l'utilisateur est admin
    $req = $conn->prepare("SELECT admin FROM users WHERE id = :id");
    $req->bindParam(":id", $_SESSION["user"]["id"]);
    $req->execute();
    $isAdmin = $req->fetch(PDO::FETCH_ASSOC)["admin"] ?? null;

    // Si ce n'est pas un admin, on redirige
    if (!$isAdmin) {
        header("Location: ../index.php");
        exit();
    }

    // Valeur par défaut pour le tableau affiché
    if (!isset($_GET["bd"]) || !in_array($_GET["bd"], ["users", "rooms", "reservations", "comments", "newsletter", "admins"])) {
        $_GET["bd"] = "users";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.php">
    <title>Roomia - Panel Admin</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>
    <main id="panel_admin">
    <div class="container">
            <h1>Panel Admin</h1>
        </div>
        <section>
            <!-- Formulaire pour exécuter une commande SQL -->
            <div class="sql-command">
                <form method="post">
                    <input type="text" id="sqlCommand" name="sqlCommand" required placeholder="Exécuter une commande SQL ici">
                    <button class="btn-submit" type="submit">EXECUTER</button>
                </form>
            </div>

            <div class="result">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sqlCommand"])) {
                    $command = $_POST["sqlCommand"];
                    try {
                        $req = $conn->prepare($command);
                        if (strtoupper(substr($command, 0, 6)) === "SELECT") {
                            $req->execute();
                            $result = $req->fetchAll(PDO::FETCH_ASSOC);
                        } else {
                            $req->execute();
                            $result = "Commande exécutée avec succès.";
                        }

                        if (is_array($result)) {
                            echo "<pre>╭ " . htmlspecialchars($command) . "\n|\n╰ " . htmlspecialchars(print_r($result, true)) . "</pre>";
                        } else {
                            echo "<p style='color:green;'>" . htmlspecialchars($command) . " => " . htmlspecialchars($result) . "</p>";
                        }
                    } catch (Throwable $e) {
                        echo "<p style= 'color:red;'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
                    }
                }
                ?>
            </div>
        </section>
        <section>
            <div class="stats-grid">
                <?php
                    
                // Définir la table à afficher
                $bd = isset($_GET['bd']) ? ($_GET['bd']!="admins" ? $_GET['bd'] : "users") : "users";
                
                $stats = ["users" => 0, "rooms" => 0, "reservations" => 0, "comments" => 0, "newsletter" => 0];

                foreach ($stats as $key => $value) {
                    $r = $conn->prepare("SELECT COUNT(id) n FROM $key");
                    $r->execute();
                    $stats[$key] = $r->fetch(PDO::FETCH_ASSOC)["n"];
                }

                $r = $conn->prepare("SELECT COUNT(id) n FROM users WHERE admin = 1");
                $r->execute();
                $stats["admins"] = $r->fetch(PDO::FETCH_ASSOC)["n"];


                foreach ($stats as $key => $value) {
                    echo '<a class="stats-links" href="panel_admin.php?bd=' . htmlspecialchars($key) . '">
                        <div '.(($_GET['bd']==$key)?"class='current-stats-card'" : "class='stats-card'").'>
                            <div class="stats-label">' . htmlspecialchars($key) . '</div>
                            <div '.(($_GET['bd']==$key)?"class='current-stats-value'" : "class='stats-value'").'>' . htmlspecialchars($value) . '</div>
                        </div>
                    </a>';
                }
                ?>
            </div>
        </section>
        <?php
            if ($_GET['bd']=="rooms"){
                echo '<button class="btn-submit" onclick="location.href=\'../php/ajouter_salle.php\'">AJOUTER UNE SALLE</button>';
            }
        ?>    

        <?php

            // Récupération des colonnes de la table
            $requetetab = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table ");
            $requetetab->bindParam(":table", $bd);
            $requetetab->execute();
            $columns = $requetetab->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='dbadmin-container'>";
            echo "<table class='dbadmin'><thead><tr>";
            foreach ($columns as $c) {
                $columnName = $c['COLUMN_NAME'];
                if (!in_array($columnName, ['USER', 'CURRENT_CONNECTIONS', 'TOTAL_CONNECTIONS', 'password', 'admin'])) {
                    echo "<th>" . htmlspecialchars($columnName) . "</th>";
                }
            }
            if ($bd === "rooms") {
                echo "<th colspan='2'>Modification / Suppression</th>";
            } else {
                echo "<th>Suppression</th>";
            }
            echo "</tr></thead><tbody>";

            // Récupération des données de la table
            $admincondition = ($_GET["bd"]=="admins") ? "WHERE admin=1;" : "";
            $requetesalle = $conn->prepare("SELECT * FROM $bd ".$admincondition);
            $requetesalle->execute();
            $elements = $requetesalle->fetchAll(PDO::FETCH_ASSOC);

            foreach ($elements as $elt) {
                echo "<tr>";
                foreach ($elt as $key => $value) {
                    if ($key === "image") {
                        $img = $value ? "../php/getSalleImg.php?id=" . $elt["id"] : "../images/salle.jpg";
                        echo "<td><img src='" . htmlspecialchars($img) . "' alt='Image'></td>";
                    } elseif ($key === "profile_picture") {
                        $img = $value ? "../php/getUserAvatar.php?id=" . $elt["id"] : "../images/user.png";
                        echo "<td><img src='" . htmlspecialchars($img) . "' alt='Avatar'></td>";
                    } elseif ($key !== "password" && $key!="admin") {
                        echo "<td>" . htmlspecialchars(($key === "note" && $value === 0) ? "/" : $value ?? ($key === "comment" ? "Aucun commentaire." : "")) . "</td>";
                    }
                }
                if ($bd === 'rooms') {
                    echo "<td><a href='../php/modifier.php?thing=room&id=" . $elt["id"] . "'>Modifier</a></td>";
                    echo "<td><a href='../php/supprimer.php?thing=" . $bd . "&id=" . $elt["id"] . "'>Supprimer</a></td>";
                } else {
                    echo "<td><a href='../php/supprimer.php?thing=" . $bd . "&id=" . $elt["id"] . "'>Supprimer</a></td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
        ?>
    </main>
    <?php include "../php/footer.php"; ?>
</body>
</html>