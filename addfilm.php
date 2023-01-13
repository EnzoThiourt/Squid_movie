<?php
require_once __DIR__.'/libmovies.php';
//Reception des donnees du formulaire
$title = $_POST['title'];
$genres = $_POST['genres'];
$time = $_POST['datatime']; // Conversion du temps en minute en heure minute
$pitch = $_POST['pitch'];
$wtw = $_POST['wtw'];

//Message d'erreur en cas d'oubli d'une valeur
if ($title==NULL or $genres==NULL or $time==NULL) {
    echo "Veuillez rentrer toutes les informations !<br>";
    Exit();
}

//Creer la variable title permettant de stocker la requete dans l'id
if(isset($_POST['title'])){
    print "<br>Creation du film dans la base de donnees ...<br>";
    $id = createMovie($title);
}

//Creer la variable genres permettant de stocker la requete dans l'id
saveGenres($id, ["genres"]);

//Stocker la variable genre
if(isset($_POST['genres'])){
    $list = [$_POST['genres']];
    saveGenres($id, $list);
}

//Creer la variable $time permettant de stocker la requete dans l'id
saveMovieLength($id, $time);

//Recuperer la requete de la variable $time pour la convertir en hh mm
if(isset($_POST['datatime'])){
    $time = $_POST ['datatime'];
    convertToHoursMins($time);


}
if(isset($_POST['pitch'])){
    savePitch($id, $pitch);
}
if(isset($_POST['wtw'])){
    $list = [$_POST['wtw']];
    saveWhereToWatch($id, $list);
}

//Message lors de l'ajout du film dans la base de donnees 
echo $title." est le film numero ".$id. " ". $genres." de duree ".convertToHoursMins($time)."Plateforme : ".$wtw."<br><br>";
$results = getAllMoviesAndShows($title);


if ($results==NULL){
    $results = getAllMoviesAndShows($title);
    echo 'Aucun film est dans la base de donnees';
    Exit();
}
//Affichage des resultats total present dans la base de donnees 
foreach($results as $result){
    echo $result['title']." | ID : ".$result['id']." | ".$result['type']." | ".convertToHoursMins($time)." "."<br>"."Pitch : ".$result['pitch']."<br>";
    echo "<br>";
}


?>