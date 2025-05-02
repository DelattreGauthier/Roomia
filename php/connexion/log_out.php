<?php
	session_start(); //Démarrer la session
	include "../php/cookies.php";
	if(isset($_COOKIE["language_preference"])){
		setcookie("language_preference", "", time() - 3600);
	}
	if($_SESSION["user"]){ // si un utilisateur est authentifié (session en cours)
		
		unset($_SESSION["user"],$_SESSION["nom"],$_SESSION["admin"],$_SESSION["visited"],$_COOKIE["user"]); //détruire les variables de sessions
		setcookie("user", "", time() - 3600, "/"); //détruire le cookie de session
		session_destroy(); //détruire la session
		if(file_exists("../../images/tmp.png")){
			unlink("../../images/tmp.png"); //supprimer le fichier temporaire
		}
		
		header("Location: ../../html/connexion.php");
		exit();
	}
?>