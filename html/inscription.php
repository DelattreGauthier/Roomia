<!-- Fonctions de vérification des champs -->

<?php
include '../php/fonctions.php';
include '../php/cookies.php';
require_once '../php/connexion/connexionbd.php'; // Connexion à la BDD

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $vNom = nettoyer_donnees($_POST['lname'] ?? '');
    $vPrenom = nettoyer_donnees($_POST['fname'] ?? '');
    $vEmail = nettoyer_donnees($_POST['email'] ?? '');
    $vPassword = nettoyer_donnees($_POST['password'] ?? '');

    // Valider le champ "Genre"
    if (empty($_POST['genre'])) {
        $errors['genre'] = "Le champ 'Genre' est obligatoire.";
    }

    // Valider le champ "nom"
    if (empty($vNom)) {
        $errors['lname'] = "Le champ 'Nom' est obligatoire.";
    } elseif (strlen($vNom) > 20) {
        $errors['lname'] = "Le nom ne doit pas dépasser 20 caractères.";
    } elseif (!valider_nomprenom($vNom)) {
        $errors['lname'] = "Le nom est invalide.";
    }

    // Valider le champ "Prénom"
    if (empty($vPrenom)) {
        $errors['fname'] = "Le champ 'Prénom' est obligatoire.";
    } elseif (strlen($vPrenom) > 20) {
        $errors['fname'] = "Le prénom ne doit pas dépasser 20 caractères.";
    } elseif (!valider_nomprenom($vPrenom)) {
        $errors['fname'] = "Le prénom est invalide.";
    }

    // Valider le champ "Email"
    if (empty($vEmail)) {
        $errors['email'] = "Le champ 'Email' est obligatoire.";
    } elseif (!valider_email($vEmail)) {
        $errors['email'] = "L'adresse email est invalide.";
    } else {
        // Vérifier si l'email existe déjà
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $vEmail);
        $stmt->execute();
        if ($stmt->fetch()) {
            $errors['email'] = "Cet email est déjà utilisé. Veuillez vous connecter.";
        }
    }

    // Valider le champ "Mot de passe"
    if(empty($_POST['password'])) {
        $errors['password'] = "Le champ 'Mot de passe' est obligatoire.";
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
    } elseif (!preg_match('/[0-9]/', $_POST['password'])) {
        $errors['password'] = "Le mot de passe doit contenir au moins un chiffre.";
    } elseif (!preg_match('/[a-zA-Z]/', $_POST['password'])) { 
        $errors['password'] = "Le mot de passe doit contenir au moins une lettre.";
    }

    // Valider le champ "Photo de profil"
    // $photo_name = null;
    // if (empty($_FILES['profile_picture']['name'])) {
    //     $errors['profile_picture'] = "Le champ 'Photo de profil' est obligatoire.";
    // if ($_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
    //     $errors['profile_picture'] = "Erreur lors du téléchargement de la photo.";
    // } elseif (!valider_photo($_FILES['profile_picture'])) {
    //     $errors['profile_picture'] = "Le fichier n'est pas une image valide ou dépasse la taille autorisée.";
    // }

    $photo_name = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $photo = $_FILES['profile_picture'];
        if ($photo['error'] !== UPLOAD_ERR_OK) {
            $errors['profile_picture'] = "Erreur lors du téléchargement de la photo.";
        } elseif (!valider_photo($photo)) {
            $errors['profile_picture'] = "Le fichier n'est pas une image valide ou dépasse la taille autorisée.";
        }
    }


    if (empty($errors)) {
        // Traitement de la photo
        $photo_name = null;
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            // Lire le contenu du fichier image
            $photo_data = file_get_contents($_FILES['profile_picture']['tmp_name']);
            
            // Vérifier si le fichier est bien une image
            if (exif_imagetype($_FILES['profile_picture']['tmp_name']) === false) {
                $errors['profile_picture'] = "Le fichier n'est pas une image valide.";            
            }
        }

        // Hacher le mot de passe
        $mot_de_passe_hash = password_hash($vPassword, PASSWORD_DEFAULT);

        // Insertion dans la BDD
        $stmt = $conn->prepare("INSERT INTO users (genre, lname, fname, email, password, profile_picture, admin)
                                VALUES (:genre, :lname, :fname, :email, :password1, :profile_picture, 0)");
        $stmt->bindParam(':genre', $_POST['genre']);
        $stmt->bindParam(':lname', $vNom);
        $stmt->bindParam(':fname', $vPrenom);
        $stmt->bindParam(':email', $vEmail);
        $stmt->bindParam(':password1', $mot_de_passe_hash);
        $stmt->bindParam(':profile_picture', $photo_data);
        $stmt->execute();

        header('Location: connexion.php');
        exit;
    }
}
?>




<!-- Page d'inscription -->


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.php">
        <title>Roomia - Inscription</title>
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        
        <?php include '../php/header.php' ?>
        <?php
        if (isset($_SESSION['user'])){
            header('Location: ../index.php');
        }
        ?>
        
        <main id="page_connexion">

        <form class="form-container" method="POST" enctype="multipart/form-data">
            <fieldset>
                <!-- Genre -->
                <h1>Inscription</h1>

                <div class="form-group">
                    <label>Genre :</label>
                    <div class="radio-group">
                        <input type="radio" name="genre" id="madame" value="madame" <?= (isset($_POST['genre']) && $_POST['genre'] === 'madame') ? 'checked' : '' ?>>
                        <label class="radio-label" for="madame">Madame</label>
                        <input type="radio" name="genre" id="monsieur" value="monsieur" <?= (isset($_POST['genre']) && $_POST['genre'] === 'monsieur') ? 'checked' : '' ?>>
                        <label class="radio-label" for="monsieur">Monsieur</label>
                    </div>
                    <?php if (isset($errors['genre'])): ?>
                    <p class="error"><?= $errors['genre'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Nom -->
                <div class="form-group">
                    <label for="lname">Nom :</label>
                    <input type="text" id="lname" name="lname" placeholder="Votre nom" value="<?= htmlspecialchars($_POST['lname'] ?? '') ?>"> <!-- Permet de laisser les champs remplis quand on a une erreur -->
                    <?php if (isset($errors['lname'])): ?>
                        <p class="error"><?= $errors['lname'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Prénom -->
                <div class="form-group">
                    <label for="fname">Prénom :</label>
                    <input type="text" id="fname" name="fname" placeholder="Votre prénom" value="<?= htmlspecialchars($_POST['fname'] ?? '') ?>">
                    <?php if (isset($errors['fname'])): ?>
                        <p class="error"><?= $errors['fname'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Adresse email :</label>
                    <input type="email" id="email" name="email" placeholder="Votre email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <p class="error"><?= $errors['email'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe">
                    <?php if (isset($errors['password'])): ?>
                        <p class="error"><?= $errors['password'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Photo de profil -->
                <div class="form-group">
                    <label for="profile_picture">Photo de profil :</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    <?php if (isset($errors['profile_picture'])): ?>
                        <p class="error"><?= $errors['profile_picture'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Boutons -->
                <button type="submit" class="btn-submit">S'INSCRIRE</button>
                </fieldset>
            </form>
        </main>

        <?php include '../php/footer.php'; ?>

    </body>
</html>



<!-- Il faudra vérifier que l'image est bel est bien une image + enregistrer l'image 
 dans la base de données une fois que les sessions / BD seront opérationnelles -->
 <!-- Aussi vérifier avec les fonctions que le format est conforme pour chaque champ -->