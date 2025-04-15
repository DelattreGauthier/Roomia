<!-- Fonctions de vérification des champs -->

<?php
include 'fonctions.php'; 

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
    
    // Si l'adresse email est valide, on vérifie si elle existe déjà dans la base de données.
    // Si elle existe déjà, une erreur apparait et invite l'utilisateur à se connecter
    
    // .....
    // .....
    // .....
    // .....
    
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
    if (isset($_FILES['profile_picture'])) {
        $photo = $_FILES['profile_picture'];
        if ($photo['error'] !== UPLOAD_ERR_OK) {
            $errors['profile_picture'] = "Erreur lors du téléchargement de la photo.";
        } elseif (!valider_photo($photo)) {
            $errors['profile_picture'] = "Le fichier n'est pas une image valide ou dépasse la taille autorisée.";
        }
    }

    if (empty($errors)) {
        // Les données peuvent être traitées et enregistrées dans la base de donnéees.
        // A faire quand la base de données sera opérationnelle.
        
        //......
        //......
        //......
        //......

        //Puis, on ouvre la session et on redirige vers la page d'accueil

        //......
        //......
        //......
        //......

        header('location:../index.php');
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
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
        <title>Roomia - Connexion</title>
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        
        <?php include '../php/header2.php' ?>
        
        <main id="page_connexion">

        <form class="form-container" method="POST" enctype="multipart/form-data">
            <fieldset>
                <!-- Genre -->
                <div class="form-group">
                    <label>Genre :</label>
                    <div class="radio-group">
                        <input type="radio" name="genre" id="madame" value="madame" <?= (isset($_POST['genre']) && $_POST['genre'] === 'madame') ? 'checked' : '' ?>>
                        <label class="radio-label" for="madame">Madame</label>
                        <input type="radio" name="genre" id="monsieur" value="monsieur" <?= (isset($_POST['genre']) && $_POST['genre'] === 'monsieur') ? 'checked' : '' ?>>
                        <label class="radio-label" for="monsieur">Monsieur</label>
                    </div>
                    <?php if (isset($errors['genre'])): ?>
                    <p style="color: red;"><?= $errors['genre'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Nom -->
                <div class="form-group">
                    <label for="lname">Nom :</label>
                    <input type="text" id="lname" name="lname" placeholder="Votre nom" value="<?= htmlspecialchars($_POST['lname'] ?? '') ?>"> <!-- Permet de laisser les champs remplis quand on a une erreur -->
                    <?php if (isset($errors['lname'])): ?>
                        <p style="color: red;"><?= $errors['lname'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Prénom -->
                <div class="form-group">
                    <label for="fname">Prénom :</label>
                    <input type="text" id="fname" name="fname" placeholder="Votre prénom" value="<?= htmlspecialchars($_POST['fname'] ?? '') ?>">
                    <?php if (isset($errors['fname'])): ?>
                        <p style="color: red;"><?= $errors['fname'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Adresse email :</label>
                    <input type="email" id="email" name="email" placeholder="Votre email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <p style="color: red;"><?= $errors['email'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe">
                    <?php if (isset($errors['password'])): ?>
                        <p style="color: red;"><?= $errors['password'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Photo de profil -->
                <div class="form-group">
                    <label for="profile_picture">Photo de profil :</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    <?php if (isset($errors['profile_picture'])): ?>
                        <p style="color: red;"><?= $errors['profile_picture'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Boutons -->
                <button type="submit" class="btn-submit">S'INSCRIRE</button>
                </fieldset>
            </form>
        </main>

        <?php include '../php/footer2.php'; ?>

    </body>
</html>



<!-- Il faudra vérifier que l'image est bel est bien une image + enregistrer l'image 
 dans la base de données une fois que les sessions / BD seront opérationnelles -->
 <!-- Aussi vérifier avec les fonctions que le format est conforme pour chaque champ -->