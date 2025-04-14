<footer>

        <!-- Section "Cookies" -->
        <?php
    // Vérifie si le cookie des cookies a déjà été accepté
    $cookie_accepted = isset($_COOKIE['cookie_yes']);

    // Si le cookie n'a pas été accepté et que l'utilisateur a cliqué sur "Accepter"
    if (!$cookie_accepted && isset($_POST['accept_cookies'])) {
        // Définit le cookie et met à jour la variable pour éviter l'affichage du pop-up
        if (setcookie('cookie_yes', 'accepted', time() + (3600 * 24 * 365), "/")) {
            echo "<!-- Cookie créé avec succès -->";
            $cookie_accepted = true;
        } else {
            echo "<!-- Erreur lors de la création du cookie -->";
        }
    }
    
    // Si le cookie des cookies n'a pas été accepté, affiche le pop-up
    if (!$cookie_accepted) {
        echo '
        <div id="cookie-popup" class="cookie-popup">
            <div class="cookie-content">
                <form method="post">
                    <p>Ce site utilise des cookies pour améliorer l\'expérience utilisateur. En continuant à utiliser ce site, vous acceptez notre utilisation des cookies. Pour plus d\'informations vous pouvez cliquez <a href="../html/cookies.php">ici</a></p>
                    <br>
                    <button type="submit" name="accept_cookies" value="yes">Accepter</button>
                </form>
            </div>
        </div>
        ';
    }
    ?>

    <div class="grid-container">
        <div class="gauche">
            <h4>Nous contacter</h4><br>
            <div><a href="mailto:roomiacontact@gmail.com">roomiacontact@gmail.com</a></div>
        </div>
        <div class="centre"><h4>Roomia &#169;</h4></div>
        <div class="droite">
            <h4>Notre Newsletter</h4><br>
            <div id="Newsletter">
                <input type="email" id="email" placeholder="Votre email">
                <button type="submit" class="btn-footer"> > </button>
            </div>
        </div>
    </div>


</footer>