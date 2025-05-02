<?php
header("Content-Type: text/css");
if (!isset($_COOKIE["theme"])) {
    setcookie("theme", "blanc", time() + 86400 * 365, "/");
    header("Location: " . $_SERVER["PHP_SELF"]);
}

?>

* {
    list-style: none;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    <?php
        $theme = $_COOKIE["theme"];
        if ($theme === "blanc"){
            echo "color: var(--rich-black);";
        } else {
            echo "color: var(--white-background);";
        }
    ?>
}

:root {
    <?php
    if ($theme === "blanc") {
        echo "--blue-links:#1e88e5;
        --white-background:#e8e7f5;
        --silver-blue:#748CAB;
        --gray-blue:#3E5C76;
        --rich-black:#0D1321;
        --prussian-blue:#1D2D44;
        --default-orange: rgba(238, 105, 105, 0.89);

        /* Couleurs des salles */
        --blanc: 255, 255, 255;
        --salle-border: #ccc;
        --salle-hover-bg: #ffebcd;
        
        /* Autres couleurs */
        --grille-bg: #fffaf0;
        --horaire-border: #f08080;

        --shadow-black: 0, 0, 0;
        --gris: #858585;
        --card-bg: #f5f5fc;
        --card-stat: 194, 60, 60;";
    } else if ($theme === "noir") {
        echo "--blue-links:#e1771a;
        --white-background: #15141a;/*#17180a;*/
        --silver-blue:#748CAB;  /* #8b7354 */
        --gray-blue:#c1a389;
        --rich-black:#f2ecde;
        --prussian-blue: #e2d2bb;
        --default-orange: rgba(238, 105, 105, 0.89);  /* rgba(17, 150, 150, 0.89) */

        /* Couleurs des salles */
        --blanc: 255, 255, 255;
        --salle-border: #333;
        --salle-hover-bg: #001432;
        
        /* Autres couleurs */
        --grille-bg: #00050f;
        --horaire-border: #0f7f7f;

        --shadow-black: 255, 255, 255;
        --gris: #7a7a7a;
        --card-bg: #0a0a03;
        --card-stat: 61, 195, 195;
        
        input{color:#0D1321} !important;
        ";
    }
?>
}

/* Style des balises prédéfinis */
h1, h2, h3, h4, h5, h6{
    font-family: 'Satoshi-Regular', sans-serif;
    color: var(--prussian-blue);
    margin: 0%;
    padding: 0%;
}

h1{
    font-size:xx-large;
}

h2{
    font-size:x-large;
}

h3{
    font-size:larger;
}

h4{
    font-size:large;
}

h5{
    font-size:medium;
}

h6{
    font-size:small;
}

/* Fonts */
@font-face {
    font-family: 'Satoshi-Variable';
    src: url('../fonts/Satoshi-Variable.woff') format('woff');
         font-weight: 300 900;
         font-display: swap;
         font-style: normal;
}
  
@font-face {
    font-family: 'Satoshi-VariableItalic';
    src: url('../fonts/Satoshi-VariableItalic.woff') format('woff');
         font-weight: 300 900;
         font-display: swap;
         font-style: italic;
}
  
@font-face {
    font-family: 'Satoshi-Light';
    src: url('../fonts/Satoshi-Light.woff') format('woff');
        font-weight: 300;
        font-display: swap;
        font-style: normal;
}
  
@font-face {
    font-family: 'Satoshi-LightItalic';
    src: url('../fonts/Satoshi-LightItalic.woff') format('woff');
        font-weight: 300;
        font-display: swap;
        font-style: italic;
}
  
@font-face {
    font-family: 'Satoshi-Regular';
    src: url('../fonts/Satoshi-Regular.woff') format('woff');
        font-weight: 400;
        font-display: swap;
        font-style: normal;
}
  
@font-face {
    font-family: 'Satoshi-Italic';
    src: url('../fonts/Satoshi-Italic.woff') format('woff');
        font-weight: 400;
        font-display: swap;
        font-style: italic;
}
  
@font-face {
    font-family: 'Satoshi-Medium';
    src: url('../fonts/Satoshi-Medium.woff') format('woff');
        font-weight: 500;
        font-display: swap;
        font-style: normal;
}
  
@font-face {
    font-family: 'Satoshi-MediumItalic';
    src:url('../fonts/Satoshi-MediumItalic.woff') format('woff');
        font-weight: 500;
        font-display: swap;
        font-style: italic;
}
  
@font-face {
    font-family: 'Satoshi-Bold';
    src: url('../fonts/Satoshi-Bold.woff') format('woff');
        font-weight: 700;
        font-display: swap;
        font-style: normal;
}
  
@font-face {
    font-family: 'Satoshi-BoldItalic';
    src: url('../fonts/Satoshi-BoldItalic.woff') format('woff');
        font-weight: 700;
        font-display: swap;
        font-style: italic;
}
  
@font-face {
    font-family: 'Satoshi-Black';
    src: url('../fonts/Satoshi-Black.woff') format('woff');
        font-weight: 900;
        font-display: swap;
        font-style: normal;
}
  
@font-face {
    font-family: 'Satoshi-BlackItalic';
    src: url('../fonts/Satoshi-BlackItalic.woff') format('woff');
        font-weight: 900;
        font-display: swap;
        font-style: italic;
}

/* Scrollbar personnalisée */

::-webkit-scrollbar {
    width: 7px;
    height: 12px;
    background-color: var(gris);
}

::-webkit-scrollbar-thumb {
    background-color: var(--gris);
    border: 2px solid var(--white-background) ;
    border-radius: 6px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: var(--gris);
}

::-webkit-scrollbar-track {
    background-color: var(--white-background);
}



/* Mise en page des différentes parties du site */

/*------------- Body -------------*/
body{
    background-color:var(--white-background);
    margin: 0;
}

main{
    -webkit-box-shadow: 0px 0px 10px rgba(var(--shadow-black), 0.1), -10px -10px 10px var(--rich-black);
            box-shadow: 0px 0px 10px rgba(var(--shadow-black), 0.1), -10px -10px 10px var(--rich-black);
    min-width:100%;
    min-height: calc(100vh - (132px)); /* Le main prendra toute la hauteur de la page moins la hauteur du footer*/ 
}

/*------------- Header -------------*/
header {
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    padding:10px 40px;
    -webkit-box-pack:justify;
        -ms-flex-pack:justify;
            justify-content:space-between;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-shadow: 0px 0px 10px rgba(var(--shadow-black), 0.1), -10px -10px 10px var(--rich-black);
            box-shadow: 0px 0px 10px rgba(var(--shadow-black), 0.1), -10px -10px 10px var(--rich-black);
    position:fixed;
    background-color: var(--white-background);
    width: 100%;
    z-index: 3;
    max-height: 100px;
}

/*------------- Nav -------------*/

nav{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
}

nav li{
    display:inline-block;
    vertical-align: middle;
}

nav ul{
    padding:0;
}

nav ul li{
    margin: 5px;
}

header a{
    font-size: 1.5rem;
    padding:8px;
    margin:6px;
    text-decoration:none;
    color: var(--prussian-blue);
    font-family: 'Satoshi-Bold', sans-serif;
    border-radius: 15px;
    -webkit-transition-duration: 0.123s;
         -o-transition-duration: 0.123s;
            transition-duration: 0.123s;
    cursor:default;
    min-width: 140px;
    text-align: center;
}

header .logo_profile_container{
    text-align: right;
}

.logo_accueil_container{
    text-align: left;
}

header a:hover{
    color: var(--white-background);
}

.logo_accueil{
    padding:8px;
    margin:6px;
    display:inline-block;
    border-radius: 15px;
    -webkit-transition-duration: 0.123s;
         -o-transition-duration: 0.123s;
            transition-duration: 0.123s;
    height: 40px;
    vertical-align: middle;
}

#current { /* Indication de la page actuelle */
    padding:8px 0;
}

#current a{
    color:var(--white-background);
    border-radius: 15px;
    background-color: var(--default-orange);
}

.connexion{
    min-width: 140px;
}

/* Transition au survol des boutons du header */

.logo_accueil:hover, header nav a:hover, .connexion:hover{
    background-color: var(--default-orange);
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    border-radius: 15px;
    cursor: pointer;
}

/* Menu déroulant */

.logo_menu img{
    display:none;
    cursor:pointer;
    width:1.9rem;
    margin: auto 23.5px;
    z-index:3;
    position:relative;
}

.dropdown_menu{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    position: fixed;
    right:0;
    top:0;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    background-color: var(--white-background);
    z-index: 1;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    -webkit-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
    -webkit-transform: translateX(100%);
        -ms-transform: translateX(100%);
            transform: translateX(100%);  /*Anime le menu déroulant de droite à gauche */
}

.menu_toggle{
    display:none;
}

.menu_toggle:checked ~ .dropdown_menu { /* On considère le menu_toggle comme une checkbox, qui quand elle est cochée affiche le menu déroulant */
    -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
    visibility: visible;
}

.dropdown_menu li{
    padding: 0.7rem;
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-align:center;
        -ms-flex-align:center;
            align-items:center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
}

.dropdown_menu .connexion{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    padding: 0.7rem;
}


/*------------- Main (page d'accueil) -------------*/

#page_bienvenue, #salles{
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: 2fr 1fr 2fr;
    grid-template-columns: 2fr 1fr 2fr;
    padding: 0% 7%;
    padding-top: 180px;
    padding-bottom: 80px;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    row-gap: 40px;
}

#page_bienvenue{
    -ms-grid-rows: 1fr 2fr 1fr 2fr 1fr 2fr;
    grid-template-rows: 1fr 2fr 1fr 2fr 1fr 2fr;
}

h1.texte_gauche{    
    -ms-grid-column: 1;    
    -ms-grid-column-span: 2;    
    grid-column: 1/3;
    -ms-grid-row: 1;
    -ms-grid-row-span: 1;
    grid-row: 1/2;
    padding-right:10%;
}

h5.texte_gauche{
    -ms-grid-column: 1;
    -ms-grid-column-span: 2;
    grid-column: 1/3;
    -ms-grid-row: 2;
    -ms-grid-row-span: 1;
    grid-row: 2/3;
    padding-right:10%;
    margin-top: -20px; /* Réduit le gap de la grille nécessaire pour séparer les 3 blocs de texte/image (il sépare aussi les h1 des h5 puisqu'ils sont dans des cellules différentes) */
    -ms-grid-row-align: start;
        align-self: start;
}

img.img_droite{
    -ms-grid-column: 3;
    -ms-grid-column-span: 1;
    grid-column: 3/4;
    -ms-grid-row: 1;
    -ms-grid-row-span: 2;
    grid-row: 1/3;
    width: 100%;
    -ms-grid-column-align: center;
        justify-self: center;
}

h1.texte_droite{
    -ms-grid-column: 2;
    -ms-grid-column-span: 2;
    grid-column: 2/4;
    -ms-grid-row: 3;
    -ms-grid-row-span: 1;
    grid-row: 3/4;
    padding-left:10%;
}

h5.texte_droite{
    -ms-grid-column: 2;
    -ms-grid-column-span: 2;
    grid-column: 2/4;
    -ms-grid-row: 4;
    -ms-grid-row-span: 1;
    grid-row: 4/5;
    padding-left:10%;
    -ms-grid-row-align: start;
        align-self: start;
    margin-top: -20px;
}

img.img_gauche{
    -ms-grid-column: 1;
    -ms-grid-column-span: 1;
    grid-column: 1/2;
    -ms-grid-row: 3;
    -ms-grid-row-span: 2;
    grid-row: 3/5;
    width: 100%;
    -ms-grid-column-align: center;
        justify-self: center;
}

h1.texte_gauche2{       
    -ms-grid-column: 1;       
    -ms-grid-column-span: 2;       
    grid-column: 1/3;
    -ms-grid-row: 5;
    -ms-grid-row-span: 1;
    grid-row: 5/6;
    padding-right:10%;
    margin-top: -20px;
}

h5.texte_gauche2{
    -ms-grid-column: 1;
    -ms-grid-column-span: 2;
    grid-column: 1/3;
    -ms-grid-row: 6;
    -ms-grid-row-span: 1;
    grid-row: 6/7;
    padding-right:10%;
    -ms-grid-row-align: start;
        align-self: start;
    margin-top: -20px;
}

img.img_droite2{
    -ms-grid-column: 3;
    -ms-grid-column-span: 1;
    grid-column: 3/4;
    -ms-grid-row: 5;
    -ms-grid-row-span: 2;
    grid-row: 5/7;
    width: 100%;
    -ms-grid-column-align: center;
        justify-self: center;
}

#page_bienvenue img, #salles img{
    border-radius: 15px;
    -webkit-box-shadow: 0px 0px 2px rgba(var(--shadow-black), 0.1);
            box-shadow: 0px 0px 2px rgba(var(--shadow-black), 0.1);
    min-width:300px;
}

/*------------- Main (Page de choix de salles) -------------*/
#page_batiments {
    padding: 100px 0px 0px 0px;
    margin: 0px;
    min-height:100vh;
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: 1fr 1fr 1fr 1fr;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    -ms-grid-rows: 1fr;
    grid-template-rows: 1fr;
}
#page_batiments > *:nth-child(1) {
    -ms-grid-row: 1;
    -ms-grid-column: 1;
}
#page_batiments > *:nth-child(2) {
    -ms-grid-row: 1;
    -ms-grid-column: 2;
}
#page_batiments > *:nth-child(3) {
    -ms-grid-row: 1;
    -ms-grid-column: 3;
}
#page_batiments > *:nth-child(4) {
    -ms-grid-row: 1;
    -ms-grid-column: 4;
}

#page_batiments a{
    display: block;
    height: calc(100vh - 100px);
    position: relative;
    width: 100%;
}

#page_batiments img{
    display: inline-block;
    position: absolute;
    width: 100%;
    height: calc(100vh - 100px);
    margin: 0px;
    padding: 0px;
    -o-object-fit: cover;
       object-fit: cover;
    -o-object-position: center;
       object-position: center;
    max-width: 100%;
    max-height: 100%;
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    -webkit-filter: grayscale(70%);
            filter: grayscale(70%);
    -webkit-filter: brightness(80%);
            filter: brightness(80%);
}

#page_batiments a h1 {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
    z-index: 1;
    color: rgb(var(--blanc));
    text-align: center;
    background-color: rgba(0, 0, 0, .5);
    padding: 10px;
    border-radius: 15px;
    font-size: xx-large;
}

#page_batiments img:hover{
    -o-object-position: 70%;
       object-position: 70%;
    max-width: 100%;
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    -webkit-filter: grayscale(0%);
            filter: grayscale(0%);
    -webkit-filter: brightness(100%);
            filter: brightness(100%);
}


/*------------- Main (Page de connexion) -------------*/

#page_connexion {
    background-color: var(--white-background);
    max-width: 400px;
    overflow:visible;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    height: calc(100vh + 15%);
    font-family: 'Satoshi-Bold', sans-serif;
    margin-left: auto;
    margin-right: auto;
    padding-top: 180px;
    padding-bottom : 70px;
}

#page_connexion .radio-label, ajouter_salle .radio-label {
    margin : 5px;
    cursor:pointer;
}

fieldset {
    border: none;
}

form {
    padding: 20px;
    text-align: center;
    border: solid var(--rich-black) 2.5px;
    border-radius: 15px;
}

p.form-link{
    margin-bottom: 5px;
    margin-top: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
    font-size: 1em;
    color: var(--rich-black);
}

input[type="text"], input[type="email"], input[type="password"], input[type="number"] {
    width: 100%;
    text-align: center;
    padding: 10px 40px;
    margin: 5px 0;
    border-radius: 15px;
    font-size: 1em;
    border:none;
    outline: none;
    border:solid var(--white-background) 2px;
}


input[type="number"] {
    -moz-appearance: textfield;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

#page_connexion input:focus{
    border: solid var(--rich-black) 2px;
}

.radio-group {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    font-family: 'Satoshi-Regular', sans-serif;
    gap: 15px;
    margin: 10px;
}

input[type="radio"] {
    margin: 0 5px;
    cursor: pointer;
}

input[type="radio"]:checked + .radio-label {
    font-family: 'Satoshi-Bold', sans-serif;
}

.btn-submit, .btn-commentaire {
    background-color: var(--silver-blue);
    font-family: 'Satoshi-Bold', sans-serif;
    padding: 10px 50px;
    border-radius: 15px;
    font-size: 1em;
    cursor: pointer;
    margin-top: 20px;
    margin-bottom: 5px;
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    border: none;
    color: var(--white-background);
}

.btn-submit:hover, .btn-commentaire:hover {
    background-color: var(--gray-blue);
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    color: rgb(var(--blanc));
}

/*------------- Main (Page pour chaque batiment) -------------*/

#batiment{
    padding-top: 125px;
    padding-bottom:70px;
}
.titre{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center ;
        -ms-flex-pack: center ;
            justify-content: center ;
}

.titre h1{
    padding:10px;
    color:var(--prussian-blue);
    border-radius:15px;
}

.dropdownSC, .dropdownAMP {
    display: block;
}

.dropdownSC input[type="checkbox"], .dropdownAMP input[type="checkbox"] {
    display: none;
}

/* Style pour le label qui agit comme un bouton */
.dropdownSC label, .dropdownAMP label {
    color: var(--rich-black);
    padding: 10px 20px;
    cursor: pointer;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center; /* Aligne le texte et la flèche verticalement */
    font-family: 'Satoshi-Bold', sans-serif;
}

/* Flèche vers le bas */
.dropdownSC label::before, .dropdownAMP label::before {
    content: "▼";
    display: inline-block;
    margin-right: 10px;
    -webkit-transition: -webkit-transform 0.3s ease;
    transition: -webkit-transform 0.3s ease;
    -o-transition: transform 0.3s ease;
    transition: transform 0.3s ease;
    transition: transform 0.3s ease, -webkit-transform 0.3s ease; /* Animation fluide de rotation */
}

/* Rotation de la flèche quand la checkbox est cochée */
.dropdownSC input[type="checkbox"]:checked + label::before, 
.dropdownAMP input[type="checkbox"]:checked + label::before {
    -webkit-transform: rotate(-180deg);
        -ms-transform: rotate(-180deg);
            transform: rotate(-180deg); /* Fait pointer la flèche vers le haut */
}

/* Contenu caché par défaut */
.dropdownSC-content, .dropdownAMP-content {
    margin-top: 10px;
    max-height: 0; /* Commence masqué */
    opacity: 0; /* Invisible par défaut */
    overflow-y: hidden;
    -webkit-transition: max-height 0.5s ease, opacity 0.5s ease;
    -o-transition: max-height 0.5s ease, opacity 0.5s ease;
    transition: max-height 0.5s ease, opacity 0.5s ease; /* Transitions pour une animation fluide */
}

/* Afficher le contenu quand la checkbox est cochée */
.dropdownSC input[type="checkbox"]:checked ~ .dropdownSC-content,
.dropdownAMP input[type="checkbox"]:checked ~ .dropdownAMP-content {
    max-height: 450px; /* Hauteur dépliée */
    opacity: 1; /* Devient visible */
    overflow-y: scroll; /* Active le défilement uniquement lorsqu'il est visible */
}

/*------------- Main (Page cookies) -------------*/

#page_cookies {
    background-color: var(--white-background);
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    padding-top: 140px;
    padding-bottom : 70px;
    padding-right: 5%;
    padding-left: 5%;
    font-family: 'Satoshi-Bold', sans-serif;
}

/* ------------------- CODE DES SALLES ------------------ */

/* Container principal des salles */
.salles-container {
    font-family: 'Satoshi-Bold', sans-serif;
    display: -ms-grid;
    display: grid;
    gap: 20px;
    -ms-grid-columns: 1fr 20px 1fr 20px 1fr;
    grid-template-columns: repeat(3, 1fr);
    margin: 20px auto;
    max-width: 1200px;
    padding: 0 10px;
    width: 100%;
}

/* Style des salles */
.salle {
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    background-position: center;
    background-size: cover;
    border-radius: 8px;
    -webkit-box-shadow: 0 4px 8px rgba(var(--shadow-black), 0.2);
            box-shadow: 0 4px 8px rgba(var(--shadow-black), 0.2);
    cursor: pointer;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    height: 200px;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    margin-bottom: 0;
    position: relative;
    -webkit-transition: border-color 0.3s ease, margin-bottom 0.3s ease, -webkit-transform 0.3s ease;
    transition: border-color 0.3s ease, margin-bottom 0.3s ease, -webkit-transform 0.3s ease;
    -o-transition: transform 0.3s ease, border-color 0.3s ease, margin-bottom 0.3s ease;
    transition: transform 0.3s ease, border-color 0.3s ease, margin-bottom 0.3s ease;
    transition: transform 0.3s ease, border-color 0.3s ease, margin-bottom 0.3s ease, -webkit-transform 0.3s ease;
    width: 100%;

}

.salle::before{
    pointer-events:none;
}

.salle div a{
    height:200px;
    width:100%;
}
.salle .img-container{
    overflow:hidden;
    height:200px;
    width:100%;
    border-radius: 8px;
    border: 2px solid black;
}

.salle div img {
    height: 100%;
    width:100%;
    -o-object-position: center 50%;
       object-position: center 50%;
    -o-object-fit: cover;
       object-fit: cover;
    display: block;
    
}

.salle:has(.img-container:hover), .salle:has(.infos:hover), .salle:has(.nom-salle:hover), .salle:has(.horaires-container:hover){
    margin-bottom: 200px;
    -webkit-transform:scale(1.05);
        -ms-transform:scale(1.05);
            transform:scale(1.05);
}


/* Effet de fondu au survol */
.salle::before {
    background: rgba(var(--blanc), 0.7);
    border-radius: 8px;
    bottom: 0;
    content: "";
    left: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    -webkit-transition: opacity 0.3s ease;
    -o-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
    z-index: 0;
}

.salle:hover::before {
    opacity: 1;
}

/* Nom des salles */
.nom-salle {
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    background-color: var(--default-orange);
    border-radius: 4px;
    bottom: 10px;
    color: rgb(var(--blanc));
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-size: 18px;
    font-weight: bold;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    left: 10px;
    padding: 0 1%;
    position: absolute;
    text-align: center;
    -webkit-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
    text-decoration: none;
}

/* Conteneur des horaires */
.horaires-container {
    background-color: var(--white-background);
    display: none;
    left: 0;
    max-height: 200px;
    opacity: 0;
    overflow-y: auto;
    position: absolute;
    top: 100%;
    -webkit-transition: max-height 0.3s ease, opacity 0.3s ease;
    -o-transition: max-height 0.3s ease, opacity 0.3s ease;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    width: 100%;
    border-radius: 8p;
    z-index: 10;
}

.salle:hover .horaires-container {
    max-height: 200px;
    opacity: 1;
    display: block;
}

/* Reprends le style d'affichage des horaires d'une salle sur la page 
d'un bâtiment mais appliqué à la page de la salle elle-même */
.salles-horaires-container {
    background-color: var(--white-background);
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    max-height: 200px;
    -webkit-transition: max-height 0.3s ease, opacity 0.3s ease;
    -o-transition: max-height 0.3s ease, opacity 0.3s ease;
    transition: max-height 0.3s ease, opacity 0.3s ease;
    width: auto;
    border-radius: 8px;
    position: relative;
    margin: 0 auto;
}

h1.infos {
    color: rgb(var(--shadow-black));
    font-weight: bold;
    position: relative;
    top: -50%;
}

div.infos {
    color: rgb(var(--shadow-black));
    font-weight: bold;
    position: absolute;
    visibility: hidden;
    z-index: 1;
    -webkit-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
}

.infos a {
    text-decoration: none;
    color: var(--rich-black);
}

.salle:hover .infos  {
    visibility: visible;
}

/* Liste des horaires */
.horaires-container ul {
    bottom: 10px;
    left: 0;
    list-style: none;
    margin: 0;
    padding: 0;
    right: 10px;
    top: 0;
}

.horaires-container ul .horaire {
    background-color: var(--white-background);
    cursor: default;
    text-decoration: none;
    margin-top: 0;
    margin-bottom: 0;
}


/* Style du bouton Réserver */
.reserver, .btn-annuler, .btn-reserved{
    width: 5rem;
    border: none;
    border-radius: 4px;
    color: rgb(var(--blanc));
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    margin-left: 10px;
    padding: 5px 10px;
    -webkit-transition: background-color 0.3s ease;
    -o-transition: background-color 0.3s ease;
    transition: background-color 0.3s ease;
}

.reserver{
    background-color: #28a745;
}

.form-horaires {
    display: inline;
    border: none;
}

.reserver:hover {
    background-color: #218838;
}

.sallelibre, .sallereserve{
    width: 4.5rem;
    border: none;
    border-radius: 4px;
    color: rgb(var(--blanc));
    font-size: 14px;
    font-weight: bold;
    margin-left: 10px;
    padding: 5px 10px;
    text-align: center;
}

.sallelibre{
    background-color: #28a745;
}

.sallereserve{
    background-color: red;
}

/* Media queries pour la responsivité */
@media (max-width: 900px) {
    .salles-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .salles-container {
        -ms-grid-columns: 1fr;
        grid-template-columns: 1fr;
    }
}

/*------------- Main (Page générique des salles) -------------*/

#salles{
    -ms-grid-rows: 1fr 25px 2r 25px auto 25px auto auto auto;
    grid-template-rows: 1fr 2fr auto auto auto auto;
    -ms-grid-columns: 3fr 2fr 2fr;
    grid-template-columns: 3fr 2fr 2fr;
    row-gap: 25px;
}

#salles > *:nth-child(1){
    -ms-grid-row: 1;
    -ms-grid-column: 1;
}

#salles > *:nth-child(2){
    -ms-grid-row: 1;
    -ms-grid-column: 2;
}

#salles > *:nth-child(3){
    -ms-grid-row: 1;
    -ms-grid-column: 3;
}

#salles > *:nth-child(4){
    -ms-grid-row: 3;
    -ms-grid-column: 1;
}

#salles > *:nth-child(5){
    -ms-grid-row: 3;
    -ms-grid-column: 2;
}

#salles > *:nth-child(6){
    -ms-grid-row: 3;
    -ms-grid-column: 3;
}

#salles > *:nth-child(7){
    -ms-grid-row: 5;
    -ms-grid-column: 1;
}

#salles > *:nth-child(8){
    -ms-grid-row: 5;
    -ms-grid-column: 2;
}

#salles > *:nth-child(9){
    -ms-grid-row: 5;
    -ms-grid-column: 3;
}

#salles > *:nth-child(10){
    -ms-grid-row: 7;
    -ms-grid-column: 1;
}

#salles > *:nth-child(11){
    -ms-grid-row: 7;
    -ms-grid-column: 2;
}

#salles > *:nth-child(12){
    -ms-grid-row: 7;
    -ms-grid-column: 3;
}

#salles .img_gauche{
    -ms-grid-column: 1;
    -ms-grid-column-span: 1;
    grid-column: 1/2;
    -ms-grid-row: 1;
    -ms-grid-row-span: 2;
    grid-row: 1/3;
    -ms-grid-column-align: center;
        justify-self: center;
}

#salles h1.texte_droite{
    -ms-grid-column: 2;
    -ms-grid-column-span: 2;
    grid-column: 2/4;
    -ms-grid-row: 1;
    -ms-grid-row-span: 1;
    grid-row: 1/2;
}

#salles .texte_droite{
    -ms-grid-column: 2;
    -ms-grid-column-span: 2;
    grid-column: 2/4;
    -ms-grid-row: 2;
    -ms-grid-row-span: 1;
    grid-row: 2/3;
    text-align:initial;
}

#salles .texte_droite li{
    list-style-type: initial;
    line-height: 2.5rem;
}


#salles .dispo{
    -ms-grid-column:1;
    -ms-grid-column-span:3;
    grid-column:1/4;
    -ms-grid-row: 3;
    -ms-grid-row-span: 1;
    grid-row: 3/4;
    -ms-grid-column-align: center;
        justify-self: center;
    padding-top:20px;
    padding-bottom:20px;
}

#salles .salle-dispo-container{
    -ms-grid-column: 1;
    -ms-grid-column-span: 3;
    grid-column: 1/4;
    -ms-grid-row: 4;
    -ms-grid-row-span: 1;
    grid-row: 5/6;
    display: -webkit-box;
    display: -ms-flexbox;
    -ms-grid-columns: auto auto;
    grid-template-columns: auto auto;
    -ms-grid-rows: auto;
    grid-template-rows: auto;
}

#salles .salle-dispo-container > *:nth-child(1){
    -ms-grid-row: 1;
    -ms-grid-column: 1;
}

#salles .salle-dispo-container > *:nth-child(2){
    -ms-grid-row: 1;
    -ms-grid-column: 2;
}

#salles .horaire h5{
    -ms-grid-column: 1;
    -ms-grid-column-span: 1;
    grid-column: 1/2;
}

#salles .reserver{
    top:0;
    left:0;
    position:relative;
}

#salles div.texte_droite{
    padding-left:10%;
    -ms-flex-item-align: start;
        -ms-grid-row-align: start;
        align-self: start;
    margin-top: -20px;
}

#salles .form-horaires{
    display: inline;
    margin-bottom:0px;
}

#salles .salle-dispo-container ul{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    padding-left:0px;
}

#salles .salle-dispo-container ul li{
    width: 32%;
}


        /*------------- Commentaires-----------*/

        #salles .commentaires-submit-container {
            grid-column: 1 / 4; /* La section occupe toute la largeur de la grille */
            grid-row: 8 / 9; /* Positionne la section en bas de la grille */
            margin-top: 0px;
            margin-inline: auto;
            max-width: 500px;
            width:100%;
        }
        
        #salles .commentaires-submit-container h2 {
            text-align: center;
        }
        
        #salles .form-commentaires textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            font-family: 'Satoshi-Regular', serif;
            font-size: 1em;
            border-radius: 5px;
            resize: none;
            color:black;
        }
        
        #salles form.form-commentaires{
            border:none;
            padding:0px;
        }

        #salles .commentaires{
            grid-column: 1 / 4; /* La section occupe toute la largeur de la grille */
            grid-row: 6 / 7; /* Positionne la section en bas de la grille */
            text-align:center;
            padding-top:10px;
            padding-bottom:20px;
        }

        #salles .commentaire pre{
            white-space: pre-wrap; /* Permet d'aller à la ligne si nécessaire */
            word-wrap: break-word; /* Permet de couper les mots longs */
            overflow-wrap: break-word; /* Alternative moderne à word-wrap */
            word-break: break-word; /* Casse les mots longs */
            font-family: 'Satoshi-Regular', sans-serif;
            font-size: large;
            margin-top:0px;
        }

        #salles .commentaire-connexion{
            text-align: center;
            margin: auto;
            font-family: 'Satoshi-Bold', sans-serif;
            color: red;
        }

        .commentaire-connexion a {
            color : blue;
        }

        #salles .commentaire-success, #panel_admin .result p{
            text-align: center;
            margin: auto;
            font-family: 'Satoshi-Bold', sans-serif;
        }

        #salles .commentaire h5{
            font-family: 'Satoshi-Bold', sans-serif;
            color:var(--rich-black);
            font-size: large;  
        }

        #salles .commentaire p{
            font-family: 'Satoshi-Medium', sans-serif;
            color:var(--rich-black);
            font-size: medium;
        }
    
    #salles .commentaires h1{
        grid-row: 5/6;
        grid-column: 1/4;
    }
    #salles .commentaires-container{
        grid-row: 7/8;
        grid-column: 1/4;
    } 

    #salles .historique_reservations{
        grid-row: 9/10;
        grid-column: 1/4;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    #salles .reservation_container{
        grid-row: 10/11;
        grid-column: 1/4;
    }

    #salles .commentaire-connexion{
        grid-column: 1/4;
        grid-row:7/8;
    }

    #salles .reservation_container table{
        width:100%;
    }

    #salles .reservation_container .img_profil{
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #salles .reservation_container a{
        text-decoration:none;
        color:#1c77c7;
        font-weight: bold;
    }

/*------------- Page de profil -------------*/

#profil {
    display: grid;
    padding-top: 180px;
    padding-bottom: 80px;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 80px auto 80px auto;
    padding-inline: 7%;
    row-gap: 20px;
}

#profil > h1:first-of-type{
    display:block;
    grid-column: 1/2;
    grid-row: 1/2;
    text-align: center;
}

#profil > h1:nth-of-type(2){
    display:block;
    grid-column: 2/3;
    grid-row: 1/2;
    text-align: center;
}

#profil > h1:nth-of-type(3){
    display:block;
    grid-column: 1/3;
    grid-row: 3/4;
    text-align: center;
    margin-top: 15px;
}

#profil .profile_container h2{
    display:block;
    grid-row: 2/3;
    grid-column: 1/2;
    text-align: center;
}

.img_profil{
    grid-row:1/2;
    grid-column:1/2;
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 50%;
    background-repeat: no-repeat;
    background-size: cover;
    margin:auto;
}

#profil div.profile_container{
    grid-row: 2/3;
    grid-column: 1/2;
    display: inline-grid;
    align-items: center;
    justify-content: center;
    max-height: auto;
    grid-template-rows: 250px 42px 42px 42px 42px;
    row-gap: 20px;
    position : relative;
    min-height: 500px !important;
}

#profil .btn-deconnexion{
    margin-bottom:0px;
    margin-top:0px !important;
    width: 220px;
    text-align:center;
}

#profil .camera_icon{
    grid-row:1/2;
    grid-column:1/2;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 70px;
    height: 70px;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 2;
}

.profile_container label:hover .camera_icon {
    opacity: 1 !important;
}

.profile_container label{
    border-radius: 50%;
    width: 200px;
    margin: auto !important;
}

#profil .reservation_container table{
    width:auto;
    margin:0 auto;
    border-collapse: separate;
    table-layout: auto;
    overflow: hidden;
    border: 2px solid var(--rich-black);
    border-radius: 15px;
    grid-row: 10/11;
}

#profil .reservation_container td a{
    color: var(--silver-blue);
    text-decoration: none;
    font-weight: 550;
}

#profil .reservation_container td a:hover, #salles .reservation_container td a p:hover{
    color: var(--gray-blue);
    text-decoration: none;
    transition-duration: 0.1s;
}

#profil .profile_container form{
    border:none;
    padding:0px;
}

#profil .profile_container form label{
    margin:0px;
}

#salles .reservation_container td a p{
    margin:0; 
}

.reservation_container th, .reservation_container td {
    padding: 10px;
    text-align: center;
    font-family: 'Satoshi-Regular', sans-serif;
}

.btn-deconnexion{
    background-color: var(--silver-blue);
    font-family: 'Satoshi-Bold', sans-serif;
    color: var(--rich-black);
    padding: 10px 15px;
    border-radius: 15px;
    margin:auto;
    font-size: 1em;
    cursor: pointer;
    margin-bottom: 5px;
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    border: none;
    color: var(--white-background);
    text-decoration: none;
}
.btn-deconnexion:hover {
    background-color: var(--gray-blue);
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    color: rgb(var(--blanc));
}

#profil .comments_container{
    grid-row: 4/5;
    grid-column: 1/3;
}

#profil .comments_container p, #profil .comments_container h3{
    word-wrap: break-word; 
    word-break: break-word;
    overflow-wrap: break-word;
    white-space: pre-wrap;
}

#profil .comment p{
    font-family: 'Satoshi-Regular', sans-serif;
}

#profil .comment p:nth-of-type(3), #profil .comment p:first-of-type{
    font-style: italic;
}

#profil .profile_container .img_profil:hover{
    filter: brightness(0.6);
    transition-duration: 0.2s;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input { display: none; }
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px; width: 26px;
  left: 4px; bottom: 4px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:checked + .slider:before {
  transform: translateX(26px);
}


/*------------- Footer -------------*/

footer {
    bottom: 0%;
    width: 100%;
    padding-inline:40px;
    line-height: 1rem;
    padding-top:10px;
}

footer h4{
    font-size:large;
}

footer h4{
    margin:0 20px 0 20px;
}


footer .grid-container {
    display: -ms-grid;
    display: grid;
    -ms-grid-rows:1fr;
    grid-template-rows:1fr;
    -ms-grid-columns: 1fr 0 1fr 0 1fr 0 1fr;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 0;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    width: 100%;
    padding: 20px;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
}


footer .grid-container > *:nth-child(1) {
    -ms-grid-row: 1;
    -ms-grid-column: 1;
}


footer .grid-container > *:nth-child(2) {
    -ms-grid-row: 1;
    -ms-grid-column: 3;
}


footer .grid-container > *:nth-child(3) {
    -ms-grid-row: 1;
    -ms-grid-column: 5;
}


footer .grid-container > *:nth-child(4) {
    -ms-grid-row: 1;
    -ms-grid-column: 7;
}

footer div.gauche{
    -ms-grid-column: 1;
    -ms-grid-column-span: 1;
    grid-column: 1/2;
}

footer div.gauche div{
    border: 1px solid #CCCCCC;
    border-radius: 4px;
    outline: none;
    font-size: 16px;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    max-height:40.33px;
    margin:5px 20px 5px 20px;
    background-color: rgb(var(--blanc));
    
}

footer div.droite{
    -ms-grid-column: 4;
    -ms-grid-column-span: 1;
    grid-column: 4/5;
}

footer a{
    color: var(--silver-blue);
    text-decoration: underline;
    font-size: small;
    font-family: 'Satoshi-Regular', sans-serif;

}

footer .droite, footer .gauche{
    text-align: center;
    min-width:219px;
    
}

footer .centre{
    -ms-grid-column: 2;
    -ms-grid-column-span: 2;
    grid-column: 2/4;
    text-align: center;
    white-space: nowrap;
}

footer #Newsletter {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: end;
        -ms-flex-pack: end;
            justify-content: flex-end;
    margin-left:20px;
    margin-right:20px;
}

#Newsletter form{
    display: flex;
    align-items: center;
    margin:0;
    border:none;
    padding:0px;
    width: 100%;
}

footer #Newsletter input[type="email"] {
    padding: 10px;
    max-width: 100%;
    border: 1px solid #CCCCCC;
    border-radius: 4px 0 0 4px;
    outline: none;
    font-size: 16px;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    width: 100%;
    max-height:40.33px;
    min-height: 40.33px;
}
footer .gauche div{
    height:50px;
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-align:center;
        -ms-flex-align:center;
            align-items:center;
    -webkit-box-pack:center;
        -ms-flex-pack:center;
            justify-content:center;
}

#Newsletter button.btn-footer {
    border: none;
    background-color: var(--silver-blue);
    color: rgb(var(--white));
    font-size: 16px;
    cursor: pointer;
    border-radius: 0 4px 4px 0;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    -webkit-transition: background-color 0.3s ease, -webkit-box-shadow 0.3s ease;
    transition: background-color 0.3s ease, -webkit-box-shadow 0.3s ease;
    -o-transition: background-color 0.3s ease, box-shadow 0.3s ease;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    transition: background-color 0.3s ease, box-shadow 0.3s ease, -webkit-box-shadow 0.3s ease;
    margin:5px 0 5px 0px;
    width:40px;
    height: 40px;
    margin-left:-33.95px;
}

footer .btn-footer:hover {
    background-color: var(--gray-blue);
    -webkit-box-shadow: 3px 3px 7px rgba(var(--shadow-black), 0.3);
            box-shadow: 3px 3px 7px rgba(var(--shadow-black), 0.3);
}

/* -------------- Notification de la Newsletter -------------- */

.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    color: rgb(var(--blanc));
    font-family: sans-serif;
    font-size: 14px;
    z-index: 9999;
    -webkit-box-shadow: 0 0 15px rgba(var(--shadow-black), 0.3);
            box-shadow: 0 0 15px rgba(var(--shadow-black), 0.3);
    -webkit-animation: fadeOut 1s forwards;
            animation: fadeOut 1s forwards; /* Animation pour disparaître après 3 secondes */
    -webkit-animation-delay: 3s; /* Délai avant le début de l'animation */
            animation-delay: 3s; /* Délai avant le début de l'animation */
}

.toast.success { background-color: #4CAF50; }
.toast.warning { background-color: #FFA500; }
.toast.error   { background-color: #f44336; }

@-webkit-keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

/*------------- Media Queries -------------*/

@media only screen and (max-aspect-ratio: 6/9),
       only screen and (max-width: 1220px) { /* Responsive Navbar */

    /* Réservations */

    #salles .salle-dispo-container ul li{
        width: 49%;
    }

}

@media only screen and (max-aspect-ratio: 6/9),
       only screen and (max-width: 850px) { /* Responsive Navbar */
    
    /* Main (page d'accueil) */
    
    #page_bienvenue{
        grid-template-columns: 1fr;
        grid-template-rows:repeat(10, auto);
        padding-top:140px;
        padding-bottom: 20px;
    }
    
    #page_bienvenue > *:nth-child(1){
        -ms-grid-row: 1;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(2){
        -ms-grid-row: 2;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(3){
        -ms-grid-row: 3;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(4){
        -ms-grid-row: 4;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(5){
        -ms-grid-row: 5;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(6){
        -ms-grid-row: 6;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(7){
        -ms-grid-row: 7;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(8){
        -ms-grid-row: 8;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(9){
        -ms-grid-row: 9;
        -ms-grid-column: 1;
    }
    
    #page_bienvenue > *:nth-child(10){
        -ms-grid-row: 10;
        -ms-grid-column: 1;
    }
    #page_bienvenue h1.texte_gauche,#page_bienvenue h5.texte_gauche,#page_bienvenue img.img_droite,#page_bienvenue h1.texte_droite,#page_bienvenue h5.texte_droite,#page_bienvenue img.img_gauche,#page_bienvenue h1.texte_gauche2,#page_bienvenue h5.texte_gauche2,#page_bienvenue img.img_droite2{
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
        padding: 0px;
    }
    #page_bienvenue h1.texte_gauche{
        -ms-grid-row: 1;
        -ms-grid-row-span: 1;
        grid-row: 1/2;
    }
    #page_bienvenue h5.texte_gauche{
        -ms-grid-row: 2;
        -ms-grid-row-span: 1;
        grid-row: 2/3;
    }
    #page_bienvenue img.img_droite{
        -ms-grid-row: 3;
        -ms-grid-row-span: 1;
        grid-row: 3/4;
    }
    #page_bienvenue h1.texte_droite{
        -ms-grid-row: 4;
        -ms-grid-row-span: 1;
        grid-row: 4/5;
    }
    #page_bienvenue h5.texte_droite{
        -ms-grid-row: 5;
        -ms-grid-row-span: 1;
        grid-row: 5/6;
    }
    #page_bienvenue img.img_gauche{
        -ms-grid-row: 6;
        -ms-grid-row-span: 1;
        grid-row: 6/7;
    }
    #page_bienvenue h1.texte_gauche2{       
        -ms-grid-row: 7;       
        -ms-grid-row-span: 1;       
        grid-row: 7/8;
    }
    #page_bienvenue h5.texte_gauche2{
        -ms-grid-row: 8;
        -ms-grid-row-span: 1;
        grid-row: 8/9;
    }
    #page_bienvenue img.img_droite2{
        -ms-grid-row: 9;
        -ms-grid-row-span: 1;
        grid-row: 9/10;
    }
/*------------- Page de profil -------------*/

#profil{
    grid-template-columns: auto;
    grid-template-rows: 50px auto 60px auto 60px auto;
    row-gap: 40px;
    padding-top:160px;
}

#profil > h1:first-of-type{
    grid-column: 1/2;
    grid-row: 1/2;
}

#profil .profile_container{
    grid-column: 1/2;
    grid-row: 2/3;
}

#profil > h1:nth-of-type(2){
    grid-column: 1/2;
    grid-row: 3/4;
}

#profil .reservation_container{
    grid-column: 1/2;
    grid-row: 4/5;
}

#profil > h1:nth-of-type(3){
    grid-column: 1/2;
    grid-row: 5/6;
}

#profil .comments_container{
    grid-column: 1/2;
    grid-row: 6/7;
}



/*------------- Main (Page de choix de salles) -------------*/
#page_batiments {
    padding: 100px 0px 0px 0px;
    margin: 0px;
    height: 100vh;
    width: 200px;
    margin-bottom: 10px;
    -ms-grid-columns: 1fr 0px 1fr;
    grid-template-columns: 1fr 1fr;
    -ms-grid-rows: 1fr 0px 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 0px 0px;
}
#page_batiments > *:nth-child(1) {
        -ms-grid-row: 1;
        -ms-grid-column: 1;
}
#page_batiments > *:nth-child(2) {
        -ms-grid-row: 1;
        -ms-grid-column: 3;
}
#page_batiments > *:nth-child(3) {
        -ms-grid-row: 3;
        -ms-grid-column: 1;
}
#page_batiments > *:nth-child(4) {
        -ms-grid-row: 3;
        -ms-grid-column: 3;
}

#page_batiments a{
    -o-object-fit: cover;
       object-fit: cover;
    display: block;
    position: relative;
    height: calc(50vh - 50px);
}

#page_batiments a img {
    -o-object-fit: cover;
       object-fit: cover;
    -webkit-filter: grayscale(70%);
            filter: grayscale(70%);
    -webkit-filter: brightness(80%);
            filter: brightness(80%);
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    display: block;
    position: relative;
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
}

#page_batiments img:hover{
    -o-object-position: 70%;
       object-position: 70%;
    max-width: 100%;
    -webkit-transition-duration: 0.3s;
         -o-transition-duration: 0.3s;
            transition-duration: 0.3s;
    -webkit-filter: grayscale(0%);
            filter: grayscale(0%);
    -webkit-filter: brightness(100%);
            filter: brightness(100%);
    content: "Salles : quarante douze\nAmphi : non";
    text-align: center;
}

/* Main (Page générique des salles) */  

    #salles{
        -ms-grid-columns: 1fr;
        grid-template-columns: 1fr;
        -ms-grid-rows: auto 25px auto auto auto 25px auto 25px auto 25px auto;
        grid-template-rows: repeat(9,auto);
        padding-top:180px;
        padding-bottom: 80px;
        row-gap:25px;
    }  

    #salles > *:nth-child(1){
        -ms-grid-row: 1;
        -ms-grid-column: 1;
    }  

    #salles > *:nth-child(2){
        -ms-grid-row: 3;
        -ms-grid-column: 1;
    }  

    #salles > *:nth-child(3){
        -ms-grid-row: 5;
        -ms-grid-column: 1;
    }  

    #salles > *:nth-child(4){
        -ms-grid-row: 7;
        -ms-grid-column: 1;
    }  

    #salles > *:nth-child(5){
        -ms-grid-row: 9;
        -ms-grid-column: 1;
    }

    #salles img.img_droite,#salles h1.texte_droite,#salles  .texte_droite,#salles img.img_gauche,#salles h1.texte_gauche2,#salles div.texte_droite{
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
        padding: 0px;
    }

    #salles .salles-dispo-container{
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
        -ms-grid-row: 4;
        -ms-grid-row-span: 1;
        grid-row: 4/5;
    }

    #salles h1.texte_droite{
        -ms-grid-row: 1;
        -ms-grid-row-span: 1;
        grid-row: 1/2;
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
        margin:0;
        text-align: center;
    }

    #salles .img_gauche{
        -ms-grid-row: 2;
        -ms-grid-row-span: 1;
        grid-row: 2/3;        
    }
    
    #salles .texte_droite{
        -ms-grid-row: 3;
        -ms-grid-row-span: 1;
        grid-row: 3/4;
        padding:0;
        margin-top:0;
        padding-top:20px;
    }

    #salles .dispo{
        -ms-grid-row: 4;
        -ms-grid-row-span: 1;
        grid-row: 4/5;
    }

    #salles .days-nav{
        grid-row: 5/6 ;
    }

    #salles .salle-dispo-container{
        -ms-grid-row:5;
        -ms-grid-row-span:1;
        grid-row: 6/7;
    }

    #salles .commentaires{
        grid-row: 7/8;
    }
    #salles .commentaires-container{
        grid-row: 8/9;
    }
    #salles .commentaires-submit-container{
        grid-row: 9/10;
    }
    #salles .historique_reservations{
        grid-row: 10/11;
    }
    #salles .reservation_container{
        grid-row: 11/12;
    }

    #salles .salle-dispo-container ul li{
        width: 100%;
    }

    .dispo, .commentaires, .historique_reservations{
        padding-top: 20px;
        padding-bottom: 20px;
    }



    /* Responsive Navbar */

    .connexion{
        min-width: 0px;
        padding: 8px !important;
    }

    .logo_menu{
        display:block;
    }

    nav ul li{
        display: none;
    }

    header ul{
        padding:0;
    }
    .logo_menu img{
        display:block;
    }
    img.profil, header a:nth-of-type(2){
        display: none;
    }
    /* header a:first-of-type{
        display: block;
        text-align: center;
    } */
    .logo_accueil_container{
        text-align: left;
    }

}

@media screen and (min-width: 851px) {
    .dropdown_menu {
        display: none; /* Masquer le menu */
    }
}

@media screen and (max-width: 700px) {
    footer .grid-container {
        -ms-grid-columns: 1fr;
        grid-template-columns: 1fr;
        -ms-grid-rows: 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr 1fr;
    }
    footer .grid-container > *:nth-child(1) {
        -ms-grid-row: 1;
        -ms-grid-column: 1;
    }
    footer .grid-container > *:nth-child(2) {
        -ms-grid-row: 2;
        -ms-grid-column: 1;
    }
    footer .grid-container > *:nth-child(3) {
        -ms-grid-row: 3;
        -ms-grid-column: 1;
    }

    footer div.gauche{
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
    }

    footer div.centre{
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
        -ms-grid-row: 3;
        -ms-grid-row-span: 1;
        grid-row: 3/4;
    }

    footer div.droite{
        -ms-grid-column: 1;
        -ms-grid-column-span: 1;
        grid-column: 1/2;
        -ms-grid-row: 2;
        -ms-grid-row-span: 1;
        grid-row: 2/3;
        padding-top:20px;
    }

    footer div.gauche div{
        margin: 5px 0px;
    }

    footer .btn-footer {
        margin-left: 0;
    }

    footer #Newsletter {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
            -ms-flex-pack: center;
                justify-content: center;
        margin-left: 0;
        margin-right: 0;
    }

    footer #Newsletter input[type="email"] {
        width: 100%;
    }

}

/* Pop up cookies */ 

.cookie-popup {
    position: fixed;
    bottom: 5%;
    right: 10%;
    left: 10%;
    background-color:var(--white-background);
    border-radius: 15px;
    z-index: 999;
    display: block;
    font-family: 'Satoshi-Bold', sans-serif;
    border: none;
}
  
  .cookie-content {
    text-align: center;
    border: none;
}
  
  .cookie-content p {
    margin: 0;
    border: none;
}
  
  .cookie-content button {
    font-size: 1.5rem;
    padding:8px;
    margin:6px;
    text-decoration:none;
    color: var(--prussian-blue);
    background-color: var(--white-background);
    font-family: 'Satoshi-Bold', sans-serif;
    border-radius: 15px;
    -webkit-transition-duration: 0.123s;
         -o-transition-duration: 0.123s;
            transition-duration: 0.123s;
    cursor: pointer;
    min-width: 140px;
    border: none;
}
  
  .cookie-content button:hover {
    color: var(--white-background);
    background-color: var(--default-orange);
}

  .star-rating {
    direction: rtl;
    display: inline-flex;
    font-size: medium;

  }

  .star-rating input {
    display: none;
  }

  .star-rating label {
    cursor: pointer;
    color: transparent;
    -webkit-text-stroke: 1px var(--horaire-border);
    text-stroke: 1px var(--horaire-border);
    transition: color 0.2s;
    margin: 0 0.2rem;
  }

  .star-rating label::before {
    content: '★';
  }

  /* Survol (hover) */
  .star-rating label:hover,
  .star-rating label:hover ~ label {
    color:var(--horaire-border);
  }

  /* Sélection (checked) */
  .star-rating input:checked ~ label {
    color: var(--horaire-border);
  }

  .star-form {
    border: none;
    padding: 0;
    margin: 0;
    display: inline-block;
    position: relative;
    left: 2%;
  }

  .profil{
    width: 50px;
    height: 50px;
    border-radius: 50%; /* rend l'image ronde */
    object-fit: cover; /* garde l'image bien cadrée */
    transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
    cursor:pointer;
    vertical-align: bottom;
    outline: 2px solid var(--rich-black);
    outline-offset: -2px;
    display: inline-block;
    
    /* Lissage de la bordure (réduit l'offset visuel blanc entre la bodure et l'image) */
    background-color: var(--rich-black);                
    box-shadow: inset 0 0 0 1px var(--rich-black);

  }
  
  .profil:hover {
    cursor: pointer;
    opacity: 0.8;
    transform: scale(1.1);
  }

/* Affichage de l'avatar dans les commentaires (environ ligne 1363) */
.avatar-nom {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: nowrap;
    margin-bottom: 18px;
}

.avatar-nom h3{
    vertical-align: middle;
}

.avatar-nom span{
    font-size: 0.9rem;
    font-style: italic;
    color: var(--blue-links);
    font-family: 'Satoshi-Regular', sans-serif;
    vertical-align: bottom;

}

#salles .avatar, #salles .reservation_container .img_profil {
    width: 2.2em !important;
    height: 2.2em !important;
    min-width: 0 !important;
    aspect-ratio: 1/1;
    object-fit: cover;
    display: block;
    border-radius: 50%;
    transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
    cursor:pointer;
    outline: 2px solid var(--rich-black);
    outline-offset: -2px;
}

#salles .avatar:hover, #salle .reservation_container .img_profil:hover{
    cursor: pointer;
    opacity: 0.8;
    transform: scale(1.1);
}




/* ----- Autre ----- */
.error {
    color: red;
}
.add_success {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #4CAF50;
    color: rgb(var(--blanc));
    padding: 15px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(var(--shadow-black), 0.1);
    font-weight: bold;
    z-index: 9999;
    animation: fadeOut 1s ease-in-out 2s forwards;
}
@keyframes fadeOut {
    to {
        opacity: 0;
        visibility: hidden;
    }
}

/* ------------ Panel Admin ------------ */

#panel_admin{
    padding-inline:7%;
    padding-top:180px;
    padding-bottom:80px;
    font-family: 'Satoshi-Regular', sans-serif;
}

#panel_admin .dbadmin{
    border: solid 3px var(--white-background);
    width:100%;
    margin:0 auto;
    border-collapse: collapse;
    table-layout: auto;
    overflow: scroll;
    border-radius: 50%;
}

#panel_admin .dbadmin thead{
    z-index: 2;
    position: sticky;
    top: -1.5px;
    background-color: var(--horaire-border);
    color: rgb(var(--blanc));
    border-top:none;
}

.dbadmin th, .dbadmin td{
    border : 1px solid var(--rich-black);
}

.dbadmin th{
    border-top: none;
}

#panel_admin td{
    padding:10px;
}

#panel_admin th, #panel_admin td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid var(--rich-black);
}

#panel_admin th {
    background-color: var(--horaire-border);
    color: rgb(var(--blanc));
}

#panel_admin img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    box-shadow: 0 0 5px rgba(var(--shadow-black), 0.1);
}

#panel_admin form{
    padding:0px;
    margin:0px;
    height:auto;
    border:none;
}

.form-container fieldset h1{
    margin-top: 10px;
    margin-bottom: 30px;
}

#panel_admin .dbadmin a {
    text-decoration: none;
    color:var(--silver-blue) ;
    font-weight: bold;
}

#panel_admin .dbadmin a:hover {
    color:var(--gray-blue) ;
}

#panel_admin .container h1, #panel_admin .sql-command h2{
    text-align: center;
}

#panel_admin .sql-command input{
    padding: 10px 50px;
    border-radius: 15px;
    margin-top: 20px;
    margin-bottom: 5px;
    max-width: 500px;
}

#sqlCommand{
    height: 42px;
    border: none;
    vertical-align: top;
}

#panel_admin .sql-command form > button.btn-submit{
    height: 42px;
}

#panel_admin > button.btn-submit{
    text-decoration: none;
    text-align: center;
    margin-inline:auto;
    display: block;
    margin-bottom:20px;
}

#panel_admin .dbadmin-container {
    max-height: 500px; /* Hauteur maximale du conteneur */
    overflow-y: auto; /* Active le défilement vertical uniquement */
    overflow-x: scroll; /* Active le défilement horizontal si nécessaire */
    border: solid 3px var(--white-background); /* Bordure extérieure */
    margin: 0 auto; /* Centre le conteneur horizontalement */
    background-color: var(--white-background); /* Fond du conteneur */
}

#panel_admin .dbadmin-container::-webkit-scrollbar:vertical {
    display: none; /* Masque la scrollbar verticale */
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin: 40px auto;
    max-width: 1000px;
    font-family: 'Satoshi-Regular', sans-serif;
    padding: 0 20px;
}

.stats-card, .current-stats-card {
    background-color: var(--card-bg);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(var(--shadow-black), 0.1);
    text-align: center;
    transition: transform 0.2s ease;
    color: var(--horaire-border);
}

.current-stats-card {
    border: solid 1.5px rgb(var(--card-stat));
    box-shadow: rgb(var(--card-stat)) 1px;
}

.stats-card:hover {
    transform: scale(1.02);
}

.stats-links{
    text-decoration: none;
}

.stats-label {
    font-size: 18px;
    color: var(--rich-black);
    margin-bottom: 10px;
    text-transform: capitalize;
}

.stats-value {
    font-size: 32px;
    font-weight: bold;
}

.current-stats-value {
    font-size: 32px;
    font-weight: bold;
    color: rgb(var(--card-stat));
}

@media (max-width: 900px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
}


/* ------------ Input File ------------ */

  input[type="file"] {
    width: 100%;
    text-align: center;
    padding: 10px 40px;
    margin: 5px 0;
    border-radius: 15px;
    font-size: 1em;
    border: solid var(--white-background) 2px;
    background-color: rgb(var(--blanc));
    color: var(--rich-black);
    cursor: pointer;
    margin-bottom: 10px;
  }
  
  input[type="file"]:focus {
    outline: 0px var(--rich-black);
  }
  
  input[type="file"]::file-selector-button {
    margin-right: 10px;
    border: none;
    border-radius: 10px;
    background: var(--silver-blue);
    padding: 8px 16px;
    color: rgb(var(--blanc));
    font-size: 1em;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  
  input[type="file"]::file-selector-button:hover {
    background: var(--gray-blue);
  }

/* ------------ Styles pour les réservations ------------ */

.horaire {
    list-style: none;
    margin: .5rem 0;
    padding: .5rem;
    border-radius: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 1px 4px rgba(var(--shadow-black), 0.1);
  }
  .btn-reserved:hover {
    background: #cf201d;
  }

  .btn-annuler:hover{
    background: #ff6f20;
  }

  .btn-reserver { background: #43a047; color: rgb(var(--blanc)); }
  .btn-reserved { background: #e53935; color: rgb(var(--blanc)); }
  .btn-annuler { background: #ff9800; color: rgb(var(--blanc)); }
  
  #salles .days-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    font-family: 'Satoshi-Regular', sans-serif;
    grid-column: 1 / 4;
    padding: 1rem 0;
    width: 100%;
}

#salles .days-nav .day-button {
    padding: 0.6rem 1.2rem;
    text-decoration: none;
    background-color: var(--silver-blue);
    color: var(--white-background);
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 4px rgba(var(--shadow-black), 0.05);
}

#salles .days-nav .day-button:hover {
    background-color: var(--gray-blue);
}

#salles .days-nav .day-button.today {
    background-color: var(--horaire-border);
    color: rgb(var(--blanc));
}

#salles .days-nav .day-button.today:hover {
    background-color: rgb(216, 91, 91);
}

  .popup {
    position: fixed;
    top: 2rem;
    left: 50%;
    transform: translateX(-50%);
    padding: .8rem 1.2rem;
    border-radius: .3rem;
    color: rgb(var(--blanc));
    font-family: 'Satoshi-Regular', sans-serif;
    font-weight: bold;
    letter-spacing: 0.05em;
    text-align: center;
    z-index: 1000;
    -webkit-animation: fadeOut 1s forwards;
            animation: fadeOut 1s forwards; /* Animation pour disparaître après 3 secondes */
    -webkit-animation-delay: 3s; /* Délai avant le début de l'animation */
            animation-delay: 3s; /* Délai avant le début de l'animation */
  }
  .popup.error   { background: #e53935; }
  .popup.success { background: #43a047; }
  .popup.fade-out {
    opacity: 0;
    transform: translateX(-50%) translateY(-20px); /* Je sais pas ce que c'est */
  }
  

#profile_picture{
    color:var(--shadow-black);
}