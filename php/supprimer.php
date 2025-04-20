<?php

require_once "connexion/connexionbd.php";


$thing = isset($_GET["thing"]) ? $_GET["thing"] : 0;
if ($thing == 0) die("La suppression a échouée");


$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

if ($thing && $id){
        
    $requetesupp = $conn->prepare("DELETE FROM ".$thing." WHERE id=:id");
    $requetesupp->bindParam(":id",$id);
    $requetesupp->execute();

}

if (isset($_GET['profil'])){
    header("Location: ../html/profil.php");
}
else{
    header("Location: ../html/panel_admin.php?bd=".$thing);
}

?>