<header>
    <?php
        session_start();

        $theme = isset($_COOKIE["theme"]) ? $_COOKIE["theme"] : "blanc";
        $house = $theme === "noir" ? "../images/logo_home_white.png" : "../images/logo_home_black.png"
	?>

    <a class="logo_accueil_container" href="../index.php"><img class="logo_accueil" onmouseout="this.src='<?= $house ?>';" onmouseover="this.src='../images/logo_home_white.png';" src="<?= $house ?>" alt="ACCUEIL"></a>
    <nav>
        <ul>
            <li><a href="../html/batiments.php">Choisir un bâtiment</a></li>
        </ul>
        <input type="checkbox" id="menu_toggle" class="menu_toggle">
        <label for="menu_toggle" class="logo_menu">
            <img src="../images/menu.png" alt="Menu">
        </label>
        <div class="dropdown_menu">
            <ul>
                <li><a href="../html/batiments.php">Choisir un bâtiment</a></li>
                    <?php
                    // echo "On est là : " . $_SESSION["user"]["lname"] . "<br>";
                        if (isset($_SESSION["user"])) { // si un utilisateur est authentifié
                            echo "<li><a href='../html/profil.php'>Mon Profil</a></li>";
                        } else{
                            echo"<li><a class='connexion' href='../html/connexion.php'>Connexion</a></li>";
                        }
                    ?>
            </ul>
            
        </div>
    </nav>
    <?php
    
        if (isset($_SESSION["user"])) { // si un utilisateur est authentifié
            $img = $_SESSION["user"]["profile_picture"] ? "../php/picture.php" : "../images/user.png";
            echo "<a class='logo_profile_container' href='../html/profil.php'><img  class='profil' src='$img'></a>";
		} else{
			echo"<a class='connexion' href='../html/connexion.php'>Connexion</a>";
		}
    ?>
</header>