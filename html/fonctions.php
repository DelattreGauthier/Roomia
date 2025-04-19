<?php
date_default_timezone_set('Europe/Paris');

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
function _gen_horaires(string $path, int $start = 8, int $end = 18, int $step = 1): string {
    $horaires = array();
    for ($h = $start; $h < $end; $h += $step) {
        $horaire = '<li class="horaire"><h5>' .
            str_pad($h, 2, '0', STR_PAD_LEFT) . ':00 - ' .
            str_pad($h + 1, 2, '0', STR_PAD_LEFT) . ':00 : Libre</h5>' .
            '<form action="' . htmlspecialchars($path) . '" method="get" class="form-horaires">' .
            '<button type="submit" class="reserver">Réserver</button>' .
            '</form></li>';
        $horaires[] = $horaire;
    }
    return implode("\n                    ", $horaires);
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

function gen_horaires($path, $room_id, $start = 8, $end = 18, $step = 1, $user_id = null, $week_offset = 0) {
    
    $conn = new PDO("mysql:host=localhost;dbname=projet25roomiabd", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // Calcul de la date du jour avec le décalage de semaine
    $date = new DateTime();
    $date->modify('+' . ($week_offset * 7) . ' days');
    $jour = $date->format('Y-m-d');

    // Charger les réservations existantes pour cette salle et ce jour
    $req = $conn->prepare("SELECT * FROM reservations WHERE room_id = ? AND DATE(reservation_start) = ?");
    $req->execute([$room_id, $jour]);
    $reservations = $req->fetchAll(PDO::FETCH_ASSOC);

    // Indexation des réservations par créneau horaire
    $slots = [];
    foreach ($reservations as $res) {
        $start_h = (int) (new DateTime($res["reservation_start"]))->format("H");
        $end_h = (int) (new DateTime($res["reservation_end"]))->format("H");
        for ($h = $start_h; $h < $end_h; $h++) {
            $slots[$h] = $res;
        }
    }

    // Génération des horaires
    $horaires = [];
    for ($h = $start; $h < $end; $h += $step) {
        $slot_start = new DateTime("$jour $h:00:00");
        $slot_end = clone $slot_start;
        $slot_end->modify('+1 hour');

        $label = "Libre";
        $form_action = htmlspecialchars($path);
        $form_class = "form-horaires";
        $button_label = "Réserver";
        $button_class = "reserver";
        $is_disabled = false;

        if (isset($slots[$h])) {
            $res = $slots[$h];
            if ($user_id !== null && $res["user_id"] == $user_id) {
                $label = "Annuler la réservation";
                $form_action = "../php/annulation_reservation.php";
                $button_label = "Annuler";
                $button_class = "annuler";
            } else {
                $label = "Réservé";
                $is_disabled = true;
            }
        }

        $form = '<form action="' . $form_action . '" method="post" class="' . $form_class . '">';
        $form .= '<input type="hidden" name="room_id" value="' . $room_id . '">';
        $form .= '<input type="hidden" name="start" value="' . $slot_start->format('Y-m-d H:i:s') . '">';
        $form .= '<input type="hidden" name="end" value="' . $slot_end->format('Y-m-d H:i:s') . '">';
        $form .= '<button type="submit" class="' . $button_class . '"' . ($is_disabled ? ' disabled' : '') . '>' . $button_label . '</button>';
        $form .= '</form>';

        $horaire = '<li class="horaire ' . ($is_disabled ? 'indisponible' : '') . '"><h5>' .
            $slot_start->format('H:i') . ' - ' . $slot_end->format('H:i') . ' : ' . $label . '</h5>' .
            $form . '</li>';

        $horaire = '<li class="horaire"><h5>' .
            str_pad($h, 2, '0', STR_PAD_LEFT) . ':00 - ' .
            str_pad($h + 1, 2, '0', STR_PAD_LEFT) . ':00 : Libre</h5>' .
            '<form action="' . htmlspecialchars($path) . '" method="get" class="form-horaires">' .
            '<button type="submit" class="reserver">Réserver</button>' .
            '</form></li>';
        

        $horaires[] = $horaire;

        
    }

    return implode("\n", $horaires);
}