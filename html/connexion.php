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

                    <!-- Genre -->
                    <div class="form-group">
                        <label>Genre :</label>
                        <div class="radio-group">
                            <input type="radio" name="genre" id="madame">
                            <label class="radio-label" for="madame">Madame</label>
                            <input type="radio" name="genre" id="monsieur">
                            <label class="radio-label" for="monsieur">Monsieur</label>
                        </div>
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="lname">Nom :</label>
                        <input type="text" id="lname" placeholder="Votre nom">
                    </div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label for="fname">Prénom :</label>
                        <input type="text" id="fname" placeholder="Votre prénom">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Adresse email :</label>
                        <input type="email" id="email" placeholder="Votre email">
                    </div>

                    <!-- Boutons -->
                    <button type="submit" class="btn-submit">S'INSCRIRE</button>
                </fieldset>
            </form>
        </main>

        <?php include '../php/footer.php'; ?>

    </body>
</html>