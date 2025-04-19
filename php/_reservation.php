<?php
    session_start();

    include "../html/fonctions.php";
    require_once "connexion/connexionbd.php";

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

        $errors = [];

        if (count($errors) === 0) {
            // Gestion de la réservation
        }
        else {
            $_SESSION["errors"] = $errors;
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }
    }
    else { // Si quelqu'un accède directement à reservation.php sans soumettre le formulaire
        header("Location: ../index.php");
        exit;
    }
?>