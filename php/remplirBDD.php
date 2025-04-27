<?php
    // $servername = "localhost";
    // $username = "root";
    // $password = "root";
    // $database = "projet25roomiabd";

    // $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // // Vérification de si l'utilisateur est admin
    // session_start();
    // if (!isset($_SESSION["user"])) {
    //     header("Location: ../index.php");
    //     exit();
    // }
    // $req = $conn->prepare("SELECT admin FROM users WHERE id = :id");
    // $req->bindParam(":id", $_SESSION["user"]["id"]);
    // $req->execute();
    // $isAdmin = $req->fetch(PDO::FETCH_ASSOC)["admin"] ?? null;
    // if (!$isAdmin) {
    //     header("Location: ../index.php");
    //     exit();
    // }

    // $batiments = ["IC1", "IC2", "ALG", "NS"];
    // $default_img = "../images/salle.jpg";
    // $default_amphi_img = "../images/AmphiType.jpg";

    // Normalement, IC2/A624, IC1/114 et IC1/217 sont déjà dans la base de données.

    // Salles prédéfinies
    // $salles_def = [
    //     "IC2/A624" => ["places" => 10, "prises" => 9, "tableaux" => 3, "retro" => 0],
    //     "IC1/114" => ["places" => 28, "prises" => 12, "tableaux" => 1, "retro" => 1],
    //     "IC1/217" => ["places" => 67, "prises" => 24, "tableaux" => 1, "retro" => 1],
    // ];

    // foreach ($salles_def as $full_name => $data) {
    //     [$batiment, $nom] = explode("/", $full_name);
    //     $batiment_id = ["IC1" => 1, "IC2" => 2, "ALG" => 3, "NS" => 4][$batiment];
    //     $type = "salle";
    //     $img = "../images/{$batiment}_{$nom}_front.jpg";
    //     $img_path = file_exists($img) ? $img : NULL;
    //     $img_data = $img_path ? file_get_contents($img_path) : NULL;

    //     $req = $conn->prepare("INSERT INTO rooms (name, sits, sockets, boards, proj, batiment_id, image)
    //                             VALUES (?, ?, ?, ?, ?, ?, ?)");
    //     $req->execute([$nom, $data["places"], $data["prises"], $data["tableaux"], $data["retro"], $batiment_id, $img_data]);
    // }

    // Génération des salles aléatoirement
    // $used_names = array_map(fn($k) => explode("/", $k)[1], array_keys($salles_def));
    // $salles_total = 50;
    // $to_generate = $salles_total - count($used_names);

    // for ($i = 0; $i < $to_generate; $i++) {
    //     $batiment = $batiments[array_rand($batiments)];
    //     $batiment_id = ["IC1" => 1, "IC2" => 2, "ALG" => 3, "NS" => 4][$batiment];

    //     do {
    //         if ($batiment === "IC1") {
    //             $nom = rand(1, 5) . rand(0, 9) . rand(1, 9);
    //         } elseif ($batiment === "IC2") {
    //             $nom = chr(rand(65, 67)) . rand(3, 9) . rand(0, 5) . rand(1, 9);
    //         } elseif ($batiment === "ALG") {
    //             $nom = chr(rand(72, 83)) . rand(1, 3) . rand(0, 3) . rand(1, 9);
    //         } else { // NS
    //             $nom = rand(1, 3) . rand(0, 3) . rand(1, 9);
    //         }
    //     } while (in_array($nom, $used_names));
    //     $used_names[] = $nom;

    //     $places = rand(5, 50);
    //     $prises = rand(3, 20);
    //     $tableaux = rand(0, 3);
    //     $retro = rand(0, 2);
    //     $type = "Salle";
    //     $img = "../images/{$batiment}_{$nom}_front.jpg";
    //     $img_path = file_exists($img) ? $img : NULL;
    //     $img_data = $img_path ? file_get_contents($img_path) : NULL;

    //     $req = $conn->prepare("INSERT INTO rooms (name, type, sits, sockets, boards, proj, batiment_id, image)
    //                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    //     $req->execute([$nom, "room", $places, $prises, $tableaux, $retro, $batiment_id, $img_data]);
    // }

    // Ajout des amphithéâtres
    // $id = 62; // ID de la dernière salle ajoutée
    // foreach ($batiments as $batiment) {
    //     $batiment_id = ["IC1" => 1, "IC2" => 2, "ALG" => 3, "NS" => 4][$batiment];
    //     for ($i = 1; $i <= 6; $i++) {
    //         $nom = "$i";
    //         $places = 100;
    //         $prises = 10;
    //         $tableaux = 1;
    //         $retro = 1;
    //         $img_data = NULL;
    //         // $img_path = file_exists($img) ? $img : $default_amphi_img;
    //         // $img_data = file_get_contents($img_path);

    //         $req = $conn->prepare("INSERT INTO rooms (id, name, type, sits, sockets, boards, proj, batiment_id, image)
    //                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //         $req->execute([$id, $nom, "amphi", $places, $prises, $tableaux, $retro, $batiment_id, $img_data]);

    //         $id++;
    //     }
    // }

    // echo "Tous les amphithéâtres ont été ajoutés avec succès.";

    echo "Rien à faire.";
?>