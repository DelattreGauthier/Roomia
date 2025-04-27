<?php
    // Inclure la connexion à la base de données
    require_once '../php/connexion/connexionbd.php';
    include '../php/cookies.php';
    include '../php/cookies.php';

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['email'])) {
            $email = htmlspecialchars(trim($_POST['email']));

            // Vérifier si l'email est valide
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                try {
                    // Vérifier si l'email existe déjà
                    $check = $conn->prepare("SELECT COUNT(*) FROM newsletter WHERE email = :email");
                    $check->bindParam(':email', $email);
                    $check->execute();
                    $exists = $check->fetchColumn();

                    if ($exists == 0) {
                        // Insérer l'email dans la table
                        $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (:email)");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();

                        echo "Merci pour votre inscription à la newsletter !";
                    } else {
                        echo "Cet email est déjà inscrit.";
                    }

                } catch (PDOException $e) {
                    echo "Erreur lors de l'inscription : " . $e->getMessage();
                }
            } else {
                echo "Adresse email invalide.";
            }
        } else {
            echo "Veuillez renseigner une adresse email.";
        }
    } else {
        header("Location:../index.php");
    }
?>
