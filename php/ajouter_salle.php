<?php
include '../html/fonctions.php';
require_once 'connexion/connexionbd.php';

$errors = [];
$success = false;

// Only process form if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $vbat = nettoyer_donnees($_POST['bat'] ?? '');
    $vname = nettoyer_donnees($_POST['name'] ?? '');
    $vsits = intval($_POST['sits'] ?? 0);
    $vsockets = intval($_POST['sockets'] ?? 0);
    $vboards = intval($_POST['boards'] ?? 0);
    $vproj = intval($_POST['proj'] ?? 0);
    
    // Validate required fields
    if (empty($vbat)) {
        $errors['bat'] = "Le nom du bâtiment est obligatoire";
    }
    if (empty($vname)) {
        $errors['name'] = "Le nom de la salle est obligatoire";
    }
    
    // Handle file upload
    $photo_data = null;
    if (isset($_FILES['photo_salle']) && $_FILES['photo_salle']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['photo_salle']['error'] !== UPLOAD_ERR_OK) {
            $errors['photo_salle'] = "Erreur lors du téléchargement de la photo.";
        } else {
            // Validate image
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($_FILES['photo_salle']['name'], PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_extensions)) {
                $errors['photo_salle'] = "Format d'image non supporté (JPEG, PNG, GIF uniquement)";
            } else {
                $photo_data = file_get_contents($_FILES['photo_salle']['tmp_name']);
            }
        }
    }

    // Only proceed if no errors
    if (empty($errors)) {
        try {
            // Verify connection is alive
            $conn->query('SELECT 1');

            $req = $conn->prepare("SELECT id FROM batiments WHERE name='$vbat'");
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            $batID = $res["id"];
            
            // Prepare statement with all parameters properly bound
            $addsalle = $conn->prepare("INSERT INTO rooms (name, sits, sockets, boards, proj, batiment_id, image) 
                                      VALUES (:name, :sits, :sockets, :boards, :proj, :batID, :photo_salle)");
            
            $addsalle->bindParam(':name', $vname);
            $addsalle->bindParam(':sits', $vsits, PDO::PARAM_INT);
            $addsalle->bindParam(':sockets', $vsockets, PDO::PARAM_INT);
            $addsalle->bindParam(':boards', $vboards, PDO::PARAM_INT);
            $addsalle->bindParam(':proj', $vproj, PDO::PARAM_INT);
            $addsalle->bindParam(':batID', $batID, PDO::PARAM_INT);
            $addsalle->bindParam(':photo_salle', $photo_data, $photo_data ? PDO::PARAM_LOB : PDO::PARAM_NULL);
            
            if ($addsalle->execute()) {
                $success = true;
                // Redirect to prevent form resubmission
                header("Location: ".$_SERVER['PHP_SELF']."?success=1");
                exit();
            }
        } catch (PDOException $e) {
            // Handle connection errors specifically
            if (strpos($e->getMessage(), 'MySQL server has gone away') !== false) {
                try {
                    // Reinitialize connection
                    $conn = new PDO($dsn, $username, $password, $options);
                    // Retry the query
                    if ($addsalle->execute()) {
                        $success = true;
                        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
                        exit();
                    }
                } catch (PDOException $retryEx) {
                    $errors['database'] = "Erreur de base de données: " . $retryEx->getMessage();
                }
            } else {
                $errors['database'] = "Erreur de base de données: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Roomia - Ajouter une salle</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>
    <?php include '../php/header2.php' ?>
    
    <main id="page_connexion">
        <?php if (isset($_GET['success'])){ ?>
            <div class="success-message">
                La salle a été ajoutée avec succès!
            </div>
        <?php
            unset($_GET["success"]);
            }
        ?>

        <form class="form-container" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Ajouter une nouvelle salle</legend>
                
                <!-- Display database errors if any -->
                <?php if (isset($errors['database'])): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($errors['database']) ?>
                    </div>
                <?php endif; ?>

                <!-- Batiment -->
                <div class="form-group">
                    <label for="bat">Nom du bâtiment :</label>
                    <input type="text" id="bat" name="bat" value="<?= htmlspecialchars($vbat ?? '') ?>" required>
                    <?php if (isset($errors['bat'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['bat']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Nom de la salle :</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($vname ?? '') ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['name']) ?></span>
                    <?php endif; ?>
                </div>

                <!-- Sits -->
                <div class="form-group">
                    <label for="sits">Nombre de places :</label>
                    <input type="number" id="sits" name="sits" min="1" value="<?= htmlspecialchars($vsits ?? '') ?>" required>
                </div>

                <!-- Sockets -->
                <div class="form-group">
                    <label for="sockets">Nombre de prises :</label>
                    <input type="number" id="sockets" name="sockets" min="0" value="<?= htmlspecialchars($vsockets ?? '') ?>" required>
                </div>

                <!-- Boards -->
                <div class="form-group">
                    <label for="boards">Nombre de tableaux :</label>
                    <input type="number" id="boards" name="boards" min="0" value="<?= htmlspecialchars($vboards ?? '') ?>" required>
                </div>

                <!-- Projectors -->
                <div class="form-group">
                    <label for="proj">Nombre de projecteurs :</label>
                    <input type="number" id="proj" name="proj" min="0" value="<?= htmlspecialchars($vproj ?? '') ?>" required>
                </div>

                <!-- Room Photo -->
                <div class="form-group">
                    <label for="photo_salle">Photo de la salle :</label>
                    <input type="file" id="photo_salle" name="photo_salle" accept="image/jpeg, image/png, image/gif">
                    <?php if (isset($errors['photo_salle'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['photo_salle']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button type="submit">Ajouter la salle</button>
                </div>
            </fieldset>
        </form>
    </main>

    <?php include '../php/footer2.php'; ?>
</body>
</html>