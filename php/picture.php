<?php
session_start();

// Vérifie si l'utilisateur est connecté et si une image est présente
if (!isset($_SESSION["user"]["profile_picture"])) {
    http_response_code(404);
    exit("Image non trouvée.");
}

// Récupère l'image binaire depuis la session
$imageData = $_SESSION["user"]["profile_picture"];

// Tente d'obtenir les informations de type MIME de l'image
$imageInfo = getimagesizefromstring($imageData);

if ($imageInfo === false) {
    http_response_code(400);
    exit("Données d'image invalides.");
}

$mime = $imageInfo['mime'];

// Autorise uniquement les types PNG, JPEG et JPG
$allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

if (!in_array($mime, $allowedTypes)) {
    http_response_code(415); // Unsupported Media Type
    exit("Format d'image non autorisé.");
}

// Envoie l'en-tête du bon type MIME
header("Content-Type: $mime");
echo $imageData;
?>
