<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/styles.php">
        <title>Roomia - Bâtiments</title>
        <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
    </head>
    <body>
        
        <?php include "../php/header.php";include "../php/cookies.php";?>

        

        <main id="page_batiments">
            <!-- Îlot Colson 1 -->
            <a href="batiment.php?id=1">
            <img id="ic1" src="../images/Ic1_horizontal_1_cropped.jpg" alt="Îlot Colson 1"> 
            <h1>IC1</h1>
            </a>
            <!-- Îlot Colson 2 -->
             <a href="batiment.php?id=2">
            <img id="ic2" src="../images/Isen_vertical_1.JPG" alt="Îlot Colson 2">
            <h1>IC2</h1>
            </a>
            <!-- Albert Le Grand -->
             <a href="batiment.php?id=3">
            <img id="alg" src="../images/Isa_vertical_1.JPG" alt="Albert Le Grand">
            <h1>ALG</h1>
            </a>
            <!-- Norbert Ségard -->
            <a href="batiment.php?id=4">
            <img id="ns" src="../images/Ns_vertical_1.JPG" alt="Norbert Ségard">
            <h1>NS</h1>
            </a>
        </main>

        <?php include "../php/footer.php"; ?>

    </body>

</html>