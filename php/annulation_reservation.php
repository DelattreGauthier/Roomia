<?php
    session_start();
    require_once "connexion/connexionbd.php";

    if (!isset($_SESSION["user"]) || $_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

    $user_id = $_SESSION["user"]["id"];
    $days = (int)($_GET["days"] ?? 0);
    $location = $_SERVER["HTTP_REFERER"];
    $reservation_id  = (int)($_POST["reservation_id"] ?? 0);

    $stmt = $conn->prepare("SELECT reservation_start, reservation_end FROM reservations WHERE id = :id");
    $stmt->bindParam(':id', $reservation_id);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    $start = new DateTime($reservation['reservation_start']);
    $end = new DateTime($reservation['reservation_end']);
    $interval = $start->diff($end);


    // Supprimer uniquement si appartient à l'utilisateur
    // A complexifier quand les limitations auront été mises en place dans reservation.php
    if ($interval->h === 1 && 
    $interval->i === 0 && 
    $interval->s === 0 && 
    $interval->days === 0){
        $req = $conn->prepare("
            DELETE FROM reservations
            WHERE id = ? AND user_id = ?
        ");
        $req->execute([$reservation_id, $user_id]);
    }
    else{
        if ($start->format('H') == $_GET['hstart']){
            $start->modify('+1 hour');
            $req = $conn->prepare("
            UPDATE reservations SET reservation_start=?
            WHERE id = ? AND user_id = ?");
            $req->execute([$start->format("Y-m-d H:i:s"),$reservation_id, $user_id]);
        }
        else{
            $end->modify('-1 hour');
            $req = $conn->prepare("
            UPDATE reservations SET reservation_end=?
            WHERE id = ? AND user_id = ?");
            $req->execute([$end->format("Y-m-d H:i:s"),$reservation_id, $user_id]);
        }
    }

    $_SESSION["flash_success"] = "Réservation annulée";
    header("Location: $location");
    exit;
?>