<?php		
    $servername ="localhost"; // Nom du serveur MySQL
    $username ="root"; // Nom d'utilisateur MySQL
    $password ="root"; // Mot de passe MySQL
    $database ="projet25roomiabd"; // Nom de la base de données MySQL

    // Crée une nouvelle instance PDO pour se connecter à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    // Définit le mode d'erreur pour afficher les exceptions en cas d'erreur lors de l'exécution des requêtes SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>