<?php
    session_start();
    require_once "connexion/connexionbd.php";
    require_once "fonctions.php";

    if (!isset($_SESSION["user"])) {
        header("Location: ../html/connexion.php");
        exit;
    }

    // if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    //     header("Location: ../html/connexion.php");
    //     exit;
    // }

    $user_id = $_SESSION["user"]["id"];
    $room_id = (int)($_POST["room_id"] ?? 0);
    $start = DateTimeImmutable::createFromFormat("Y-m-d H:i:s", $_POST["start"] ?? "");
    $end = DateTimeImmutable::createFromFormat("Y-m-d H:i:s", $_POST["end"] ?? "");
    $days = (int)($_GET["days"] ?? 0);
    $location = $_SERVER["HTTP_REFERER"];

    // Validation basique
    $errors = [];
    if (!$start || !$end) {
        $errors[] = "Horaires invalides. $start -> $end";
    } else {
        // Validation des horaires
        if ($start < new DateTimeImmutable()) {
            $errors[] = "Vous ne pouvez pas réserver dans le passé.";
        }
        if ((int)$start->format("H") < 6 || (int)$end->format("H") > 20) {
            $errors[] = "Horaires hors plages 6h-20h.";
        }
        if ($end <= $start) {
            $errors[] = "Vous ne pouvez pas remonter le temps dans une salle."; // On sait jamais
        }
    }

    if (count($errors) > 0) {
        $_SESSION["flash_error"] = implode(" ", $errors);
        header("Location: $location");
        exit;
    }

    // Vérification du temps
    $duration = $end->getTimestamp() - $start->getTimestamp();
    if ($duration > 7200) {
        $_SESSION["flash_error"] = "Vous ne pouvez pas réserver plus de 2 heures de suite.";
        header("Location: $location");
        exit;
    }

    // Vérification de si plusieurs salles ne sont pas réservées en même temps
    $req = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE user_id = ? AND NOT (reservation_end <= ? OR reservation_start >= ?)");
    $req->execute([$user_id, $start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s")]);
    if ($req->fetchColumn() > 0) {
        $_SESSION["flash_error"] = "Vous réservez déjà une autre salle à cette heure-ci.";
        header("Location: $location");
        exit;
    }

    // Vérification d'une réservation existante pour l'utilisateur
    $req = $conn->prepare("SELECT id, reservation_start, reservation_end FROM reservations WHERE user_id = ? AND room_id = ? AND NOT (reservation_end < ? OR reservation_start > ?)");
    $req->execute([$user_id, $room_id, $start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s")]);
    $own = $req->fetch(PDO::FETCH_ASSOC);

    if ($own) {
        // Extension de la durée de réservation
        $existingStart = new DateTimeImmutable($own["reservation_start"]);
        $existingEnd = new DateTimeImmutable($own["reservation_end"]);

        $newStart = min($existingStart, $start);
        $newEnd = max($existingEnd, $end);
        $totalDuration = $newEnd->getTimestamp() - $newStart->getTimestamp();

        if ($totalDuration <= 7200) {
            $req = $conn->prepare("UPDATE reservations SET reservation_start = ?, reservation_end = ? WHERE id = ?");
            $req->execute([$newStart->format("Y-m-d H:i:s"), $newEnd->format("Y-m-d H:i:s"), $own['id']]);
            $temps = gmdate("H\hi", $totalDuration);
            $_SESSION["flash_success"] = "Vous avez bien étendu votre réservation de $temps.";
            header("Location: $location");
            exit;
        } else {
            $_SESSION["flash_error"] = "Vous ne pouvez pas réserver plus de 2 heures.";
            header("Location: $location");
            exit;
        }
    }

    // Réservation
    $req = $conn->prepare("INSERT INTO reservations (user_id, room_id, reservation_start, reservation_end) VALUES (?, ?, ?, ?)");
    $req->execute([$user_id, $room_id, $start->format("Y-m-d H:i:s"), $end->format("Y-m-d H:i:s")]);
    $_SESSION["flash_success"] = "Réservation effectuée de " . $start->format("H:i") . " à " . $end->format("H:i");
    header("Location: $location");
    exit;
?>