<footer id="footer">

<?php
require_once '../php/connexion/connexionbd.php';

// --- GESTION COOKIES ---
$cookie_accepted = isset($_COOKIE['cookie_yes']);
if (!$cookie_accepted && isset($_POST['accept_cookies'])) {
    if (setcookie('cookie_yes', 'accepted', time() + (3600 * 24 * 365), "/")) {
        $cookie_accepted = true;
    }
}
if (!$cookie_accepted) {
    echo '
    <div id="cookie-popup" class="cookie-popup">
        <div class="cookie-content">
            <form method="post">
                <p>Ce site utilise des cookies pour améliorer l\'expérience utilisateur. En continuant à utiliser ce site, vous acceptez notre utilisation des cookies. Pour plus d\'informations vous pouvez cliquer <a href="../html/cookies.php">ici</a></p>
                <br>
                <button type="submit" name="accept_cookies" value="yes">Accepter</button>
            </form>
        </div>
    </div>
    ';
}

// --- TRAITEMENT NEWSLETTER ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email-newsletter'])) {
    $email = htmlspecialchars(trim($_POST['email-newsletter']));

    if (empty($email)) {
        $_SESSION['newsletter'] = 'empty';
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['newsletter'] = 'invalid';
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        try {
            $check = $conn->prepare("SELECT COUNT(*) FROM newsletter WHERE email = :email");
            $check->bindParam(':email', $email);
            $check->execute();
            $exists = $check->fetchColumn();

            if ($exists == 0) {
                $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (:email)");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $_SESSION['newsletter'] = 'success';
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                $_SESSION['newsletter'] = 'exists';
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['newsletter'] = 'error';
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// --- MESSAGE AFFICHÉ COMME POPUP ---
$toast = '';
if (isset($_SESSION['newsletter'])) {
    switch ($_SESSION['newsletter']) {
        case 'success':
            $toast = "<div class='toast success'>Merci pour votre inscription !</div>";
            break;
        case 'exists':
            $toast = "<div class='toast warning'>Cet email est déjà inscrit.</div>";
            break;
        case 'invalid':
            $toast = "<div class='toast error'>Adresse email invalide.</div>";
            break;
        case 'empty':
            $toast = "<div class='toast error'>Veuillez entrer votre adresse email.</div>";
            break;
        case 'error':
            $toast = "<div class='toast error'>Une erreur est survenue. Veuillez réessayer.</div>";
            break;
    }
    unset($_SESSION['newsletter']);
    echo $toast;
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
            <form method="POST" action="">
                <input type="email" name="email-newsletter" placeholder="Votre email" required>
                <button onclick="location.href='#footer'" class="btn-footer"> > </button>
            </form>
        </div>
    </div>
</div>

</footer>