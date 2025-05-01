<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Location: ../index.php");
}

date_default_timezone_set("Europe/Paris");

function nettoyer_donnees($donnees) {
    $donnees = trim($donnees ?? ''); // Supprime les espaces en début et fin de chaîne.
    $donnees = stripslashes($donnees); // Supprime les antislashs (\) ajoutés par certaines configurations PHP (magic quotes).
    $donnees = htmlspecialchars($donnees); // Convertit les caractères spéciaux en entités HTML pour éviter les injections de code HTML ou JavaScript.
    return $donnees; // Retourne la chaîne nettoyée.
}
function valider_nomprenom($firstName) {
    return preg_match("/^[a-zA-ZÀ-ÿ\s'-]+$/", $firstName);
}
function valider_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL); // Utilise la fonction de validation d'email de PHP.
}
function valider_photo($photo) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    return in_array($photo['type'], $allowed_types) && $photo['size'] < 1000000;
}
function preview_horaires(int $salle_id, int $start = 8, int $end = 20, int $step = 1): string {
    if ($end < $start) [$start, $end] = [$end, $start];
    if ($step < 1 || $step > $end - $start) $step = 1;
    if ($end > 20) $end = 20;
    if ($start < 8) $start = 8;

    $conn = new PDO("mysql:host=localhost;dbname=projet25roomiabd", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $horaires = array();
    $H = date("G");
    $day = date("Y-m-d"); // Modification pour utiliser le format complet Y-m-d
    
    if ($H >= $end) {
        $H = $start;
        $day = date("Y-m-d", strtotime("+1 day"));
    }

    // Récupérer toutes les réservations pour la salle et le jour donné
    $req = $conn->prepare("SELECT * FROM reservations 
                          WHERE room_id = ? 
                          AND DATE(reservation_start) = ?");
    $req->execute([$salle_id, $day]);
    $reservations = $req->fetchAll(PDO::FETCH_ASSOC);

    for ($h = $start < $H ? $H : $start; $h < $end; $h += $step) {
        $heure_debut = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00:00';
        $heure_fin = str_pad($h + 1, 2, '0', STR_PAD_LEFT) . ':00:00';
        
        // Vérifier si ce créneau est réservé
        $est_reserve = false;
        foreach ($reservations as $reservation) {
            $debut_res = date("H:i:s", strtotime($reservation['reservation_start']));
            $fin_res = date("H:i:s", strtotime($reservation['reservation_end']));
            
            if (!($heure_fin <= $debut_res || $heure_debut >= $fin_res)) {
                $est_reserve = true;
                break;
            }
        }

        $statut = $est_reserve ? '<div class="sallereserve">Réservé</div>' 
                              : '<div class="sallelibre">Libre</div>';
        
        $horaire = '<li class="horaire"><h5>' .
            str_pad($h, 2, '0', STR_PAD_LEFT) . ':00 - ' .
            str_pad($h + 1, 2, '0', STR_PAD_LEFT) . ':00</h5>' .
            $statut .
            '</li>';
        $horaires[] = $horaire;
    }
    return implode("\n                    ", $horaires);
}
function set_cookies($user) {
    $cookies = [
        ["name" => "ID", "value" => $user["id"]], ["name" => "Genre", "value" => $user["genre"]], ["name" => "Nom", "value" => $user["lname"]], 
        ["name" => "Prenom", "value" => $user["fname"]], ["name" => "Email", "value" => $user["email"]], ["name" => "Admin", "value" => $user["admin"] ? "Oui" : "Non"], 
        ["name" => "IP", "value" => $_SERVER["REMOTE_ADDR"]], ["name" => "Agent", "value" => $_SERVER["HTTP_USER_AGENT"]], 
        ["name" => "OS", "value" => PHP_OS], ["name" => "Apache", "value" => $_SERVER["SERVER_SOFTWARE"]], ["name" => "PHP", "value" => phpversion()]
    ];
    
    setcookie("user", base64_encode(json_encode($cookies)), time() + 86400 * 365, "/");
}
function date_fmt_8($dt_str, $date=NULL, $heure=NULL) {
    $dt = new DateTime($dt_str, new DateTimeZone("Europe/Paris"));
    if ($date && $heure) {
        $date = NULL;
        $heure = NULL;
    }
    if ($date) {
        $formatter = new IntlDateFormatter(
            "fr_FR",
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT,
            "Europe/Paris",
            IntlDateFormatter::GREGORIAN,
            "EEEE d MMMM yyyy"
        );
    } else if ($heure) {
        $formatter = new IntlDateFormatter(
            "fr_FR",
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT,
            "Europe/Paris",
            IntlDateFormatter::GREGORIAN,
            "HH:mm"
        );
    } else {
        $formatter = new IntlDateFormatter(
            "fr_FR",
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT,
            "Europe/Paris",
            IntlDateFormatter::GREGORIAN,
            "EEEE d MMMM yyyy 'à' HH:mm"
        );
    }
    return ucfirst($formatter->format($dt));
}
function date_strftime($dt_str, $date=NULL, $heure=NULL) {
    $dt = new DateTime($dt_str);
    $j = ["Monday" => "Lundi", "Tuesday" => "Mardi", "Wednesday" => "Mercredi", "Thursday" => "Jeudi", "Friday" => "Vendredi", "Saturday" => "Samedi", "Sunday" => "Dimanche"][strftime("%A", $dt->getTimestamp())];
    $m = ["January" => "janvier", "February" => "février", "March" => "mars", "April" => "avril", "May" => "mai", "June" => "juin", "July" => "juillet", "August" => "août", "September" => "septembre", "October" => "octobre", "November" => "novembre", "December" => "décembre"][strftime("%B", $dt->getTimestamp())];
    if ($date && $heure) {
        $date = NULL;
        $heure = NULL;
    }
    if ($date) $str = strftime("$j %e $m", $date->getTimestamp());
        
    else if ($heure) $str = strftime("%H:%M", $date->getTimestamp());
        
    else $str = strftime("$j %e $m %Y à %H:%M", $date->getTimestamp());

    // if ($date->format("j") === "1") $str = preg_replace('/\b1\b(?= [A-Z|a-zéèêà])/', '1er', $str); // Pour emplacer 1 par 1er, etc

    return $str;
}
function date_formatter($dt_str, $date=NULL, $heure=NULL) {
    if (class_exists("IntlDateFormatter")) {
        return date_fmt_8($dt_str, $date, $heure);
    } else {
        return date_strftime($dt_str, $date, $heure);
    }
}

function gen_horaires($path, $room_id, $start = 8, $end = 18, $step = 1, $user_id = null, $days = 0) {
    $conn = new PDO("mysql:host=localhost;dbname=projet25roomiabd", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $date = new DateTime();
    $date->modify("+$days days");
    $jour = $date->format('Y-m-d');

    $req = $conn->prepare("SELECT * FROM reservations WHERE room_id = ? AND DATE(reservation_start) = ?");
    $req->execute([$room_id, $jour]);
    $reservations = $req->fetchAll(PDO::FETCH_ASSOC);

    $slots = [];
    foreach ($reservations as $res) {
        $start_h = (int) (new DateTime($res["reservation_start"]))->format("H");
        $end_h = (int) (new DateTime($res["reservation_end"]))->format("H");
        for ($h = $start_h; $h < $end_h; $h++) {
            $slots[$h] = $res;
        }
    }

    $horaires = [];
    for ($h = $start; $h < $end; $h += $step) {
        $slot_start = new DateTime("$jour $h:00:00");
        $slot_end = clone $slot_start;
        $slot_end->modify('+1 hour');

        // Par défaut : créneau libre
        $label = "Libre";
        $form_action = htmlspecialchars($path);
        $method = "post";
        $button_label = "Réserver";
        $button_class = "reserver";
        $is_disabled = false;

        if (isset($slots[$h])) {
            $res = $slots[$h];
            if ($user_id !== null && $res["user_id"] == $user_id) {
                $label = "Annuler la réservation";
                $form_action = "../php/annulation_reservation.php?hstart=".$slot_start->format('H');
                $button_label = "Annuler";
                $button_class = "btn-annuler";
            } else {
                $label = "Réservé";
                $button_label = "Réservé";
                $button_class = "btn-reserved";
                $is_disabled = true;
            }
        }

        $form = '<form action="' . $form_action . '" method="' . $method . '" class="form-horaires">';
        $form .= '<input type="hidden" name="room_id" value="' . $room_id . '">';
        $form .= '<input type="hidden" name="start" value="' . $slot_start->format('Y-m-d H:i:s') . '">';
        if ($button_label === "Annuler") {
            $form .= '<input type="hidden" name="reservation_id" value="' . $res["id"] . '">';
        }
        $form .= '<input type="hidden" name="end" value="' . $slot_end->format('Y-m-d H:i:s') . '">';
        $form .= '<button type="submit" class="' . $button_class . '"' . ($is_disabled ? ' disabled' : '') . '>' . $button_label . '</button>';
        $form .= '</form>';

        $horaire = '<li class="horaire' . ($is_disabled ? ' indisponible' : '') . '"><h5>' .
            str_pad($h, 2, '0', STR_PAD_LEFT) . ':00 - ' .
            str_pad($h + 1, 2, '0', STR_PAD_LEFT) . ':00 : ' . $label . '</h5>' .
            $form . '</li>';

        $horaires[] = $horaire;
    }

    return implode("\n                    ", $horaires);
}
