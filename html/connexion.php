<?php
include '../php/fonctions.php';
require_once '../php/connexion/connexionbd.php'; // Connexion à la BDD

$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $vEmail = nettoyer_donnees($_POST['email'] ?? '');
    $vPassword = nettoyer_donnees($_POST['password'] ?? '');

    // Valider le champ "Email"
    if (empty($vEmail)) {
        $errors['email'] = "Le champ 'Email' est obligatoire.";
    } elseif (!valider_email($vEmail)) {
        $errors['email'] = "L'adresse email est invalide.";
    }

    // Valider le champ "Mot de passe"
    if (empty($vPassword)) {
        $errors['password'] = "Le champ 'Mot de passe' est obligatoire.";
    } elseif (strlen($vPassword) < 8) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
    } elseif (!preg_match('/[0-9]/', $vPassword)) {
        $errors['password'] = "Le mot de passe doit contenir au moins un chiffre.";
    } elseif (!preg_match('/[a-zA-Z]/', $vPassword)) {
        $errors['password'] = "Le mot de passe doit contenir au moins une lettre.";
    }

    // S'il n'y a pas d'erreurs de validation, on vérifie dans la BDD
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $vEmail);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            $errors['email'] = "Adresse email inconnue.";
        } else {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($vPassword, $user['password'])) {
                // Mot de passe correct → on démarre la session
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'genre' => $user['genre'],
                    'email' => $user['email'],
                    'fname' => $user['fname'],
                    'lname' => $user['lname'],
                    'profile_picture' => $user['profile_picture'],
                    'admin' => $user['admin']
                ];

                $_SESSION["visited"] = [];
                set_cookies($_SESSION["user"]);
                if (!isset($_COOKIE["user"])) {
                    header("Location: connexion.php");
                    exit();
                }
                include "../php/cookies.php";

                header('Location: ../index.php');
                exit;
            } else {
                $errors['password'] = "Mot de passe incorrect.";
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
        <link rel="stylesheet" type="text/css" href="../css/styles.php">
        <title>Roomia - Connexion</title>
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

                    <h1>Connexion</h1>

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

                    <!-- Boutons -->
                    <button type="submit" class="btn-submit">SE CONNECTER</button>

                    <!-- Lien vers la page d'inscription -->
                    <p class="form-link">Pas encore inscrit ? <br><a href="inscription.php">S'inscrire</a></p>
                </fieldset>
            </form>
        </main>

        <?php include '../php/footer.php'; ?>

    </body>
</html>