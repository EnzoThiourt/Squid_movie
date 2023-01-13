<?php
        require('header.php')
    ?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Squid Movies</title>
</head>
<body>
        <div class="p2">
        <p><i>Ceci est la page d'ajout de film :</i></p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php
        require('libmovies.php');
        ?>
        <div class="addmovies">
            <form action="addfilm.php" method="post">
            <p class='form'>
        <label>Titre du film : </label>
            <input type="text" name="title" id="title" placeholder="Saisir un titre" ><br>
        <label>Genre du film : </label>
        <select name="genres" id="">
                <option value="">Choisir un genre</option>
                <option value="GENRE_SF">Science-Fiction</option>
                <option value="GENRE_FANTASY">Fantaisie</option>
                <option value="GENRE_DRAMA">Dramatique</option>
                <option value="GENRE_COPS">Policier</option>
                <option value="GENRE_LIFE">Romantique</option>
                <option value="GENRE_HORROR">Horreur</option>
                <option value="GENRE_CHILDREN">Enfants</option>
            </select>
            <div class="quantity">
        <form method="post">
            <label>Durée du film</label>
            <input type="number" name="datatime" id="datatime" placeholder="" min="0" step="10">
            <label>Minutes</label>
            
        </form><br/>
        <label>Pitch : </label>
        <textarea name="pitch" id="pitch" placeholder="Veuiller Saisir le pitch : "></textarea><br>
        <label>Plateforme : </label> 
        <select name="wtw" id="wtw">
            <option value="">Choisir une plateforme</option>
            <option value="WTW_NETFLIX">Netflix</option>
            <option value="WTW_DPLUS">Disney +</option>
            <option value="WTW_PRIME">Amazon Prime</option>
            <option value="WTW_OCS">OCS</option>
</select>
<input type="submit" value="OK">
    </div>
        </div>
        </div>
</body>
</html>