<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "projet25roomiabd";

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$batiments = ["IC1", "IC2", "ALG", "NS"];
$default_img = "../images/salle.jpg";
$default_amphi_img = "../images/AmphiType.jpg";

// Salles prédéfinies
$salles_def = [
    "IC2/A624" => ["places" => 10, "prises" => 9, "tableaux" => 3, "retro" => 0],
    "IC1/114" => ["places" => 28, "prises" => 12, "tableaux" => 1, "retro" => 1],
    "IC1/217" => ["places" => 67, "prises" => 24, "tableaux" => 1, "retro" => 1],
];

foreach ($salles_def as $full_name => $data) {
    [$batiment, $nom] = explode("/", $full_name);
    $type = "Salle";
    $img = "../images/{$batiment}_{$nom}_front.jpg";
    $img_path = file_exists($img) ? $img : $default_img;

    $stmt = $pdo->prepare("INSERT INTO salles (nom, batiment, type, places, prises, tableaux, retroprojecteurs, image)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $batiment, $type, $data["places"], $data["prises"], $data["tableaux"], $data["retro"], $img_path]);
}

// Générer des salles aléatoires
$used_names = array_map(fn($k) => explode("/", $k)[1], array_keys($salles_def));
$salles_total = 50;
$to_generate = $salles_total - count($used_names);

for ($i = 0; $i < $to_generate; $i++) {
    $batiment = $batiments[array_rand($batiments)];

    do {
        if ($batiment === "IC1") {
            $nom = rand(1, 5) . rand(0, 9) . rand(1, 9);
        } elseif ($batiment === "IC2") {
            $nom = chr(rand(65, 67)) . rand(3, 9) . rand(0, 5) . rand(1, 9);
        } elseif ($batiment === "ALG") {
            $nom = chr(rand(72, 83)) . rand(1, 3) . rand(0, 3) . rand(1, 9);
        } else { // NS
            $nom = rand(1, 3) . rand(0, 3) . rand(1, 9);
        }
    } while (in_array($nom, $used_names));
    $used_names[] = $nom;

    $places = rand(5, 50);
    $prises = rand(3, 20);
    $tableaux = rand(0, 3);
    $retro = rand(0, 2);
    $type = "Salle";
    $img = "../images/{$batiment}_{$nom}_front.jpg";
    $img_path = file_exists($img) ? $img : $default_img;
    $img_data = file_get_contents($img_path);

    $stmt = $pdo->prepare("INSERT INTO salles (name, sits, sockets, boards, proj, batiment_id, image)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $places, $prises, $tableaux, $retro, $img_data]);
}

// Ajouter les amphithéâtres
foreach ($batiments as $batiment) {
    for ($i = 1; $i <= 3; $i++) {
        $type = "Amphithéâtre";
        $nom = "$i";
        $places = 100;
        $prises = 10;
        $tableaux = 1;
        $retro = 1;
        $img = "../images/{$batiment}_{$i}_front.jpg";
        $img_path = file_exists($img) ? $img : $default_amphi_img;
        $img_data = file_get_contents($img_path);

        $stmt = $pdo->prepare("INSERT INTO salles (nom, batiment, type, places, prises, tableaux, retroprojecteurs, image)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $batiment, $type, $places, $prises, $tableaux, $retro, $img_data]);
    }
}

echo "Toutes les salles et amphithéâtres ont été ajoutés avec succès.";
?>