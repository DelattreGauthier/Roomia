<?php
    session_start();


    include "fonctions.php";
    require_once "../php/connexion/connexionbd.php";

    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION["user"])) {
        header("Location: ../index.php");
        exit;
    }
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = [];

        $commentaire = isset($_POST["commentaire"]) ? nettoyer_donnees($_POST["commentaire"]) : "";
        $note = isset($_POST["note"]) ? (int)$_POST["note"] : 0;
        $room_id = isset($_POST["room_id"]) ? (int)$_POST["room_id"] : 0;

        if ($room_id <= 0) {
            header("Location: ../index.php");
            exit;
        }

        if (empty($commentaire) && empty($note)) {
            $errors["commentaire"] = "Veuillez fournir au moins un commentaire ou une note.";
        }

        if (!empty($commentaire) && strlen($commentaire) > 1000) { // limite aribitraire
            $errors["commentaire"] = "Le commentaire ne doit pas dépasser 1000 caractères.";
        }

        if (empty($errors)) { // On pourrait potentiellement envoyer un email sur le review
            $texte = !empty($commentaire) ? "$commentaire" : null;

            $req = $conn->prepare("INSERT INTO comments (user_id, comment, note, room_id) VALUES (?, ?, ?, ?)");
            $req->execute([
                $_SESSION["user"]["id"],
                $texte,
                $note,
                $room_id
            ]);

            // Récupération du nombre de reviews et de la note moyenne
            $req = $conn->prepare("SELECT reviews, rating FROM rooms WHERE id = :id");
            $req->bindParam(":id", $room_id);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            if (count($data) !== 0) {

                $data = $data[0];
                $reviews = $data["reviews"];
                $rating = $data["rating"];

                // Changement de la note moyenne
                if ($note !== 0) {
                    // Changement de la note moyenne
                    $rating = round(($rating * $reviews + $note) / ($reviews + 1), 2);
                    // Augmentation des reviews
                    $reviews = $reviews + 1;

                    $req = $conn->prepare("UPDATE rooms SET rating = :rating, reviews = :reviews WHERE id = :id");
                    $req->execute([
                        "rating" => $rating, 
                        "reviews" => $reviews, 
                        "id" => $room_id
                    ]);
                }

                // Redirection vers la page précédente avec un message de succès
                $_SESSION["commentaire_success"] = "Votre avis a été envoyé avec succès !";
                header("Location: ../html/salle.php?id=$room_id#commentaires");
                exit;
            }
            else {
                $_SESSION["errors"] = $errors;
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
            }
        } else { // Si quelqu'un accède directement à envoi.php sans soumettre le formulaire
            header("Location: ../index.php");
            exit;
        }
    }
?>
