<?php
session_start();
require_once "connexion/connexionbd.php";
include "fonctions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['profile_picture'];

        // Vérifier si le fichier est une image valide
        if (!valider_photo($photo)) {
            $_SESSION['flash_error'] = "Le fichier n'est pas une image valide ou dépasse la taille autorisée.";
            header("Location: ../html/profil.php");
            exit;
        }

        // Lire le contenu du fichier image
        $photo_data = file_get_contents($photo['tmp_name']);

        try {
            // Mettre à jour la photo de profil dans la base de données
            $stmt = $conn->prepare("UPDATE users SET profile_picture = :photo WHERE id = :id");
            $stmt->bindParam(':photo', $photo_data, PDO::PARAM_LOB);
            $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Mettre à jour la session
            $_SESSION['user']['profile_picture'] = $photo_data;

            $_SESSION['flash_success'] = "Photo de profil mise à jour avec succès.";
        } catch (PDOException $e) {
            $_SESSION['flash_error'] = "Erreur lors de la mise à jour de la photo : " . $e->getMessage();
        }
    } else {
        $_SESSION['flash_error'] = "Aucune photo n'a été téléchargée.";
    }

    header("Location: ../html/profil.php");
    exit;
}
?>