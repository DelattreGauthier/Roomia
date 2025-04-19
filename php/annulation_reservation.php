<?php
    session_start();
    require_once "connexion/connexionbd.php";

    if (!isset($_SESSION["user"]) || $_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    $user_id = $_SESSION["user"]["id"];
    $room_id = $_SESSION["room_id"];
    $days = (int)($_GET["days"] ?? 0);
    $location = $_SERVER["HTTP_REFERER"] . "&days=$days";
    $res_id  = (int)($_POST["res_id"] ?? 0);

    // Supprimer uniquement si appartient à l'utilisateur
    $req = $conn->prepare("
        DELETE FROM reservations
        WHERE id = ? AND user_id = ?
    ");
    $req->execute([$res_id, $user_id]);

    $_SESSION["flash_success"] = "Réservation annulée. reservation_id=$res_id, user_id=$user_id";
    
    header("Location: $location");
    exit;
?>