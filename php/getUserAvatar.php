<?php
    require_once "connexion/connexionbd.php";

    $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
    $req = $conn->prepare("SELECT profile_picture FROM users WHERE id = :id");
    $req->bindParam(":id", $id);
    $req->execute();
    $blob = $req->fetchColumn();

    if ($blob) {
        // Détection automatique du type MIME à partir des données binaires
        $imageInfo = getimagesizefromstring($blob);
        if ($imageInfo === false) {
            http_response_code(400);
            exit("Données d'image invalides.");
        }

        $mime = $imageInfo["mime"];
        // Autorise uniquement les types PNG, JPEG et GIF
        $allowedTypes = ["image/png", "image/jpeg", "image/gif"];
        if (!in_array($mime, $allowedTypes)) {
            http_response_code(415); // Type de média non supporté
            exit("Format d'image non autorisé.");
        }

        // Envoie l'en-tête du bon type MIME
        header("Content-Type: $mime");
        echo $blob;
    } else {
        http_response_code(404);
        echo "Image non trouvée";
    }
?>