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

            <form class="form-container">
                <fieldset>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Adresse email :</label>
                        <input type="email" id="email" placeholder="Votre email">
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" placeholder="Votre mot de passe">
                    </div>

                    <!-- Boutons -->
                    <button type="submit" class="btn-submit">SE CONNECTER</button>

                    <!-- Lien vers la page d'inscription -->
                    <p class="form-link">Pas encore inscrit ? <br><a href="inscription.php">S'inscrire</a></p>
                </fieldset>
            </form>
        </main>

        <?php include '../php/footer2.php'; ?>

    </body>
</html>