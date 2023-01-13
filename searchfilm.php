<?php 
require ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
</head>
<body>
    <?php
require_once __DIR__.'/libmovies.php';
?> 
<div class="p2">
<?php
if(isset($_POST['title'])) {
    $title = $_POST['title']; 
    $results = searchMoviesOrShowsByTitle($title);
    if(!empty($results)) {
        echo "Les Résultats trouvés pour ".$title.":<br>";
        foreach($results as $result) {
            echo $result['title']."     | ID : ".$result['id']." | Type : ".$result['type']."<br>";
    
        }
    }
    else{
        $title = $_POST['title'];
        $results = searchMoviesOrShowsByTitle($title);
        echo "<strong>Aucun résultat trouvé pour : </strong> ".$title."<br>";
        foreach($results as $result) {
            echo $result['title']." | ID : ".$result['id']." | Type : ".$result['type']."<br>";
        }
    }
 }

if(isset($_POST['genres'])) {
    $genres = $_POST['genres'];
    $results = searchMoviesOrShowsByGenre($genres);
    
    if(empty($_POST['genres'])){
        echo "Veuillez sélectionner un genre";
    }
    elseif(empty($results)) {
        echo "Pas de résultats trouvé pour le ".$genres;
    }
    else {
        echo "<strong>Les Résultats trouvés pour le </strong>".$genres."<strong> sont :<br></strong>";
        foreach($results as $result) {
            $time = convertToHoursMins($result['length']);
            echo $result['title'];
            echo " | ID : ".$result['id'];
            echo " | Type : ".$result['type'];
            echo " | ".$genres;
            echo " | Durée du film : ".$time."<br>";
            echo " | Plateforme : ".$wtw."<br>";
        }
    }
}
?>
</div>
</body>
</html>