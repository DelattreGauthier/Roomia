<?php
include '../fonctions.php';

$errors = [];

// Si le formulaire est soumis et l'utilisateur n'est pas connecté, on l'invite à se connecter
// Sinon, on traite le commentaire.


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(!isset($_SESSION['user'])){
    $errors['commentaire'] = "Vous devez être connecté pour laisser un commentaire.";
    } else {
        // Récupérer les données du formulaire
        $vCommentaire = nettoyer_donnees($_POST['commentaire'] ?? '');
    
        // Valider le champ "Commentaire"
        if (empty($vCommentaire)) {
            $errors['commentaire'] = "Le champ 'Commentaire' est obligatoire.";
        } elseif (strlen($vCommentaire) > 500) {
            $errors['commentaire'] = "Le commentaire ne doit pas dépasser 500 caractères.";
        }
    }

    // S'il n'y a pas d'erreur, on enregistre le commentaire dans la base de données.

    if(empty($errors)){
        
        // ....
        // ....
        // ....
        // ....

    }
}



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../css/styles.css">
        <link rel="icon" href="../../images/Logo_Roomia.png" type="image/x-icon">
        <title>Roomia - IC1 - 114</title>
    </head>
    <body>
        <header>
            <a href="../../index.php"><img class="logo_accueil" onmouseout="this.src='../../images/logo_home_black.png';" onmouseover="this.src='../../images/logo_home_white.png';" src="../../images/logo_home_black.png" alt="ACCUEIL"></a>
            <nav>
                <ul>
                    <li><a href="../../html/batiments.php">Choisir un bâtiment</a></li>
                </ul>
                <input type="checkbox" id="menu_toggle" class="menu_toggle">
                <label for="menu_toggle" class="logo_menu">
                    <img src="../../images/menu.png" alt="Menu">
                </label>
                <div class="dropdown_menu">
                    <ul>
                        <li><a href="../../html/batiments.php">Choisir un bâtiment</a></li>
                        <li><a class="connexion" href="../connexion.php">Connexion</a></li>
                    </ul>
                </div>
            </nav>
            <a class="connexion" href="../connexion.php">Connexion</a>
        </header> 
        <main id="salles">
            <h1 class="texte_droite">Salle 114</h1>

            <h5 class="texte_droite">
                <ul>
                    <li>28 places</li>
                    <li>1 tableau</li>
                    <li>12 prises</li>
                    <li>1 rétroprojecteur</li>
                    <li>Ma note :
                        <form class="star-form" action="envoi.php" method="post">
                        <div class="star-rating">
                            <input type="radio" id="star5" name="note" value="5">
                            <label for="star5"></label>
                            
                            <input type="radio" id="star4" name="note" value="4">
                            <label for="star4"></label>
                            
                            <input type="radio" id="star3" name="note" value="3">
                            <label for="star3"></label>
                            
                            <input type="radio" id="star2" name="note" value="2">
                            <label for="star2"></label>
                            
                            <input type="radio" id="star1" name="note" value="1">
                            <label for="star1"></label>
                        </div>
                        </form>
                    </li>
                    <li>Note moyenne : 4.5/5</li>
                </ul>
            </h5>


            <img class="img_gauche" src="../../images/IC1_114_front.jpg" alt="Salle 114">

            <h1 class="dispo">Horaires de disponibilité :</h1>
            <div class="salle-dispo-container">
                <ul>
                    <li class="horaire"><h5>08:00 - 09:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>09:00 - 10:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>10:00 - 11:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>11:00 - 12:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>12:00 - 13:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>13:00 - 14:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>14:00 - 15:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>15:00 - 16:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>16:00 - 17:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                    <li class="horaire"><h5>17:00 - 18:00 : Libre</h5><form action="#" method="get" class="form-horaires"><button type="submit" class="reserver">Réserver</button></form></li>
                </ul>
            </div>

            <!-- Section commentaires -->

            <h1 class="commentaires">Commentaires :</h1>

            <!-- On vérifie s'il y a des commentaires pour cette salle dans la base de données -->
            <!-- Si oui, on les affiche avec la photo de profil, le nom / prénom, et le commentaire -->
            
            

            <!-- Exemple : -->
            
            <div class="commentaires-container">
                <div class="commentaire">
                    <h5>Gauthier Delattre :</h5>
                    <p>Super salle, très lumineuse !</p>
                </div>
                <div class="commentaire">
                    <h5>Pascal Praud :</h5>
                    <p>Introduction : La salle 204, ou l’art de s’accommoder de l’ordinaire

Lorsque l’on pousse la porte grise, légèrement écaillée, de la salle 204, on pénètre dans un monde figé entre passé et présent, un espace suspendu dans le temps, où chaque craquement de chaise raconte une anecdote, chaque griffure sur le bureau témoigne d’une lutte entre concentration et ennui. Il ne s’agit pas simplement d’un lieu d’apprentissage : c’est une microcosme d’émotions, de batailles silencieuses, de soupirs longs et d’enthousiasmes rares, mais puissants.

L’agencement : entre logique et improvisation

La disposition des tables semble avoir été pensée dans un élan d’optimisme méthodique. Rangées en colonnes disciplinées, elles suggèrent l’ordre et la rigueur, mais un œil averti remarquera vite les décalages subtils, témoins de mois de tiraillements, d’ajustements discrets, de querelles d’espace implicites entre élèves.

Le tableau blanc — en vérité un tableau grisâtre — trône à l’avant, victime d’années d’effacements imparfaits. Des fantômes d’équations et de plans de dissertation persistent, comme des échos d’intelligences passées refusant de céder leur place.

Le mobilier : un hommage au plastique résilient

Ah, les chaises. Légendaires. Conçues dans un plastique dur que seul le temps parvient à fissurer, elles grincent au moindre mouvement, protestant contre le poids des corps et des pensées. Leurs pieds métalliques, inégalement équilibrés, provoquent des mini-séismes à chaque repositionnement d’élève, rythmant les cours d’un fond sonore métallique.

Les bureaux, eux, sont gravés de mots d’amour éphémères, de noms illisibles, de déclarations à moitié effacées : "Mathieu <3 Lucie" cohabite avec un "Fuck les maths" rageur. Témoins du passage d’innombrables âmes adolescentes, ils sont à la fois pupitres d’étude et palimpsestes de rébellion.

L’ambiance thermique : une épreuve saisonnière

L’hiver, la salle 204 devient un frigo où les stylos refusent parfois de glisser sur la copie glacée. Le radiateur, antique et rouge brique, gémit dans un dialecte métallique incompréhensible, n’émettant que de tièdes soupirs, comme s’il regrettait sa jeunesse.

L’été, c’est un autre enfer. L’air y est dense, saturé de fatigue et de chaleur humaine. La fenêtre, coincée dans un angle d’ouverture précis, laisse passer un filet d’air moite, et surtout… le vacarme de la cour. Chaque cours devient alors une performance de concentration, un duel contre le monde extérieur.

L’acoustique : ou l’art de capter tous les bruits sauf la voix du prof

Le moindre éternuement résonne comme un coup de canon, tandis que la voix de l’enseignant, elle, se perd parfois dans un brouillard sonore. Entre les froissements de feuilles, les soupirs, les cliquetis de stylos et les bruits de semelles sur le lino, suivre un cours demande une attention quasi-spirituelle.

Les murs : témoins muets mais bavards

Peints d’un blanc devenu jaune pâle, les murs racontent mille histoires. Là, une affiche de sécurité incendie datée de 2013 ; ici, un coin de papier collé par un chewing-gum fossilisé. Certains coins présentent des fissures subtiles, comme si les murs eux-mêmes commençaient à douter de leur mission.

Les odeurs : une palette olfactive involontairement expressive

Il est difficile de parler de la salle 204 sans évoquer son ambiance olfactive. Un doux mélange de feutre usé, de sac en toile oublié, de transpiration adolescente, et parfois — mystère non résolu — de parfum bon marché vaporisé en douce. Une atmosphère qui évolue au fil des saisons, oscillant entre "tête d’effort" et "fond de cartable".

Les interactions humaines : théâtre du quotidien

Mais au fond, ce qui fait vivre la salle 204, ce ne sont pas les tables, les murs ou les odeurs. Ce sont les présences. L’élève fatigué qui lutte contre le sommeil, celle qui prend des notes avec une rigueur de moine copiste, celui qui lève la main avec une assurance naïve, les rires étouffés, les regards échangés, les silences éloquents.

L’enseignant y est souvent seul capitaine d’un navire instable, maniant le tableau comme un sabre, essayant tant bien que mal de dompter l’énergie flottante d’un groupe dont l’attention est un papillon insaisissable.

Conclusion : une salle comme tant d’autres, et pourtant…

La salle 204 n’est ni moderne, ni inspirante, ni même confortable. Mais elle a ce je-ne-sais-quoi d’authentique. C’est un théâtre du quotidien où se jouent de petites tragédies scolaires, des éclairs de génie furtifs, des moments d’ennui profond, et parfois… une phrase, un débat, une idée qui change tout.

Et peut-être est-ce cela, la véritable magie d’une salle de classe : sa capacité à être un simple espace… et pourtant, le point de départ de tant d’histoires.</p>
                </div>
            </div>

            <!-- Envoi de commentaires -->
            
            <div class="commentaires-submit-container">
            <form method="post" class="form-commentaires">
                <textarea name="commentaire" id="commentaire" rows="5" placeholder="Écrivez votre commentaire ici..." required></textarea>
                <button type="submit" class="btn-commentaire">Envoyer</button>
            </form>

            <?php if (isset($errors['commentaire'])): ?>
            <div class="commentaire-connexion">
                <p><?= htmlspecialchars($errors['commentaire']) ?></p>
            </div>
            <?php endif; ?>
            </div>
            
        
        </main>
        <footer>
            
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
    </body>
</html>
