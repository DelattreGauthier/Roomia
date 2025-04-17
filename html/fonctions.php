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
function gen_horaires(string $path, int $start = 8, int $end = 18, int $step = 1): string {
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
function date_fmt_8($dt_str) {
    $date = new DateTime($dt_str, new DateTimeZone("Europe/Paris"));
    $formatter = new IntlDateFormatter(
        "fr_FR",
        IntlDateFormatter::FULL,
        IntlDateFormatter::SHORT,
        "Europe/Paris",
        IntlDateFormatter::GREGORIAN,
        "EEEE d MMMM yyyy 'à' HH:mm"
    );
    return ucfirst($formatter->format($date));
}
function date_strftime($dt_str) {
    $date = new DateTime($dt_str);
    $j = ["Monday" => "Lundi", "Tuesday" => "Mardi", "Wednesday" => "Mercredi", "Thursday" => "Jeudi", "Friday" => "Vendredi", "Saturday" => "Samedi", "Sunday" => "Dimanche"][strftime("%A", $date->getTimestamp())];
    $m = ["January" => "janvier", "February" => "février", "March" => "mars", "April" => "avril", "May" => "mai", "June" => "juin", "July" => "juillet", "August" => "août", "September" => "septembre", "October" => "octobre", "November" => "novembre", "December" => "décembre"][strftime("%B", $date->getTimestamp())];
    $str = strftime("$j %e $m %Y à %H:%M", $date->getTimestamp());

    // if ($date->format("j") === "1") $str = preg_replace('/\b1\b(?= [A-Z|a-zéèêà])/', '1er', $str); // Pour emplacer 1 par 1er, etc

    return $str;
}
function date_formatter($dt_str)
{
    if (class_exists("IntlDateFormatter")) {
        return date_fmt_8($dt_str);
    } else {
        return date_strftime($dt_str);
    }
}