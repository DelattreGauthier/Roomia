<?php

require_once "connexion/connexionbd.php";


$thing = isset($_GET["thing"]) ? $_GET["thing"] : 0;
if ($thing == 0) die("La suppression a échouée");


$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) die("La salle que vous cherchez à supprimer n'existe pas.");

if ($thing='room'){
        
    $requetesupp = $conn->prepare("DELETE FROM rooms WHERE id=:id");
    $requetesupp->bindParam(":id",$id);
    $requetesupp->execute();

}

header("Location: ../html/panel_admin.php");

?>