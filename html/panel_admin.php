<?php
require_once "../php/connexion/connexionbd.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Roomia - Panel Admin</title>
    <link rel="icon" href="../images/Logo_Roomia.png" type="image/x-icon">
</head>
<body>

<main>
<?php

$requetesalle = $conn->prepare("SELECT * FROM rooms");
$requetesalle->execute();
$dbsalle=$requetesalle->fetchAll(PDO::FETCH_ASSOC);

echo '<table class="dbadmin"><thead><tr>
<th>Id</th>
<th>Name</th>
<th>Rating</th>
<th>Reviews</th>
<th>Sits</th>
<th>Sockets</th>
<th>Boards</th>
<th>Proj</th>
<th>Batiment_Id</th>
<th>Image</th>
<th></th>
<th></th>
</tr></thead><tbody>';

foreach ($dbsalle as $val){
    echo "<tr>";
    foreach($val as $value){
        if ($value == $val['image']){
            $img= "../php/getSalleImg.php?id=".$val['id'];
            echo "<td><img src='". $img ."' style='width: 100px; height: auto;'></td>";
        }
        else{
        echo "<td>".$value."</td>";
        }
    }
    echo "<td><a href='../php/modifier.php?thing=room&id=". $val['id'] ."'>Modifier</a></td>";
    echo "<td><a href='../php/supprimer.php?thing=room&id=". $val['id'] ."'>Supprimer</a></td>";
    echo "</tr>";
}

?>

</main>

</body>
</html>