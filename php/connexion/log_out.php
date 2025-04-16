<?php

session_start(); //Démarrer la session
	if(isset($_COOKIE['language_preference'])){
		setcookie('language_preference', "", time() - 3600);
	}
	if($_SESSION["user"]){ // si un utilisateur est authentifié (session en cours)
		
		unset($_SESSION["user"],$_SESSION["nom"],$_SESSION["admin"],); //détruire les variables de sessions
		session_destroy();//détruire la session
		header("Location:../../html/connexion.php");
	}
?>
