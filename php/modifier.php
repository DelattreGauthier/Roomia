<?php
include 'fonctions.php';
require_once 'connexion/connexionbd.php';

$errors = [];
$success = false;

// Vérifier qu'un ID est bien passé en paramètre
if (!isset($_GET['id'])) {
    die("ID de salle manquant");
}

$room_id = $_GET['id'];

// Récupérer les données de la salle
$req = $conn->prepare("SELECT r.*, b.name as batiment_name 
                      FROM rooms r 
                      JOIN batiments b ON r.batiment_id = b.id 
                      WHERE r.id = :id");
$req->bindParam(':id', $room_id, PDO::PARAM_INT);
$req->execute();
$room_data = $req->fetch(PDO::FETCH_ASSOC);

if (!$room_data) {
    die("Salle non trouvée");
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation et nettoyage des données
    $vbat = nettoyer_donnees($_POST['bat'] ?? '');
    $vname = nettoyer_donnees($_POST['name'] ?? '');
    $vsits = intval($_POST['sits'] ?? 0);
    $vsockets = intval($_POST['sockets'] ?? 0);
    $vboards = intval($_POST['boards'] ?? 0);
    $vproj = intval($_POST['proj'] ?? 0);
    
    // Validation des champs obligatoires
    if (empty($vbat)) {
        $errors['bat'] = "Le nom du bâtiment est obligatoire";
    }
    if (empty($vname)) {
        $errors['name'] = "Le nom de la salle est obligatoire";
    }
    
    // Gestion de la photo
    $photo_data = $room_data['image']; // Conserver l'image existante par défaut
    
    if (isset($_FILES['photo_salle']) && $_FILES['photo_salle']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['photo_salle']['error'] !== UPLOAD_ERR_OK) {
            $errors['photo_salle'] = "Erreur lors du téléchargement de la photo.";
        } else {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($_FILES['photo_salle']['name'], PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_extensions)) {
                $errors['photo_salle'] = "Format d'image non supporté (JPEG, PNG, GIF uniquement)";
            } else {
                $photo_data = file_get_contents($_FILES['photo_salle']['tmp_name']);
            }
        }
    }
    
    // Si case "supprimer photo" cochée
    if (isset($_POST['remove_photo'])) {
        $photo_data = null;
    }

    // Vérifier que le bâtiment existe
    $req = $conn->prepare("SELECT id FROM batiments WHERE name = :name");
    $req->bindParam(':name', $vbat);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    
    if (!$res) {
        $errors["no_bat"] = "Le bâtiment $vbat n'existe pas.";
    }

    // Traitement si aucune erreur
    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("UPDATE rooms SET 
                                  name = :name, 
                                  sits = :sits, 
                                  sockets = :sockets, 
                                  boards = :boards, 
                                  proj = :proj, 
                                  batiment_id = :batID, 
                                  image = :photo_salle 
                                  WHERE id = :id");
            
            $stmt->bindParam(':name', $vname);
            $stmt->bindParam(':sits', $vsits, PDO::PARAM_INT);
            $stmt->bindParam(':sockets', $vsockets, PDO::PARAM_INT);
            $stmt->bindParam(':boards', $vboards, PDO::PARAM_INT);
            $stmt->bindParam(':proj', $vproj, PDO::PARAM_INT);
            $stmt->bindParam(':batID', $res["id"], PDO::PARAM_INT);
            $stmt->bindParam(':photo_salle', $photo_data, $photo_data ? PDO::PARAM_LOB : PDO::PARAM_NULL);
            $stmt->bindParam(':id', $room_id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $success = true;
                header("Location: ../html/panel_admin.php?bd=rooms");
                exit();
            }
        } catch (PDOException $e) {
            $errors['database'] = "Erreur de base de données: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.php">
    <title>Roomia - Modifier une salle</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>
    <?php include '../php/header.php'; include '../php/cookies.php'; ?>
    
    <main id="page_connexion">
        <form class="form-container" method="POST" enctype="multipart/form-data">
            <fieldset>
                <h1 style="margin: auto">Modifier la salle</h1>
                
                <?php if (isset($errors['database'])): ?>
                    <div class="error">
                        <?= htmlspecialchars($errors['database']) ?>
                    </div>
                <?php endif; ?>

                <!-- Batiment -->
                <div class="form-group">
                    <label for="bat">Nom du bâtiment :</label>
                    <input type="text" id="bat" name="bat" value="<?= htmlspecialchars($room_data['batiment_name']) ?>" required>
                    <?php if (isset($errors['bat'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['bat']) ?></span>
                    <?php endif; ?>
                    <?php if (isset($errors['no_bat'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['no_bat']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Nom de la salle :</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($room_data['name']) ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['name']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Sits -->
                <div class="form-group">
                    <label for="sits">Nombre de places :</label>
                    <input type="number" id="sits" name="sits" min="1" value="<?= htmlspecialchars($room_data['sits']) ?>" required>
                </div>

                <!-- Sockets -->
                <div class="form-group">
                    <label for="sockets">Nombre de prises :</label>
                    <input type="number" id="sockets" name="sockets" min="0" value="<?= htmlspecialchars($room_data['sockets']) ?>" required>
                </div>

                <!-- Boards -->
                <div class="form-group">
                    <label for="boards">Nombre de tableaux :</label>
                    <input type="number" id="boards" name="boards" min="0" value="<?= htmlspecialchars($room_data['boards']) ?>" required>
                </div>

                <!-- Projectors -->
                <div class="form-group">
                    <label for="proj">Nombre de projecteurs :</label>
                    <input type="number" id="proj" name="proj" min="0" value="<?= htmlspecialchars($room_data['proj']) ?>" required>
                </div>

                <!-- Room Photo -->
                <div class="form-group">
                    <label for="photo_salle">Photo de la salle :</label>
                    <input type="file" id="photo_salle" name="photo_salle" accept="image/jpeg, image/png, image/gif">
                    <?php if (isset($errors['photo_salle'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['photo_salle']) ?></span>
                    <?php endif; ?>
                    
                    <?php if ($room_data['image']): ?>
                        <div class="current-photo">
                            <p>Photo actuelle :</p>
                            <img src="data:image/jpeg;base64,<?= base64_encode($room_data['image']) ?>" alt="Photo de la salle" style="max-width: 200px;">
                            <label>
                                <input type="checkbox" name="remove_photo"> Supprimer la photo actuelle
                            </label>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="ajouter_salle_submit">
                    <button type="submit" class="btn-deconnexion">Mettre à jour</button>
                    <a href="../html/panel_admin.php?bd=rooms" class="btn-cancel">Annuler</a>
                </div>
            </fieldset>
        </form>
    </main>

    <?php include '../php/footer.php'; ?>
</body>
</html>