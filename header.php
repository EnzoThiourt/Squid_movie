<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Squid Movies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="principale">
            <div class="logo">
                <a href="#">Trouves ton <span>streamly</span></a>
            </div>
            <ul>
                <li class="active">
                    <a href="http://localhost/siteweb">Accueil</a>
                </li>
                <li>
                    <a href="#">Service</a>
                </li>
                <li>
                    <a href="#">Blog</a>
                </li>
                <li>
                    <a href="#">A propos de nous</a>
                </li>
            </ul>
        </div>
        <div class="search">
            <form name="searchmovies" action="searchfilm.php" method="post" id="searchmovies">
                <br><br><br><br>
                <p style="color:white">Rechercher parmis tous nos films et séries :</p>
                <input type="text" name="title" id="title" placeholder="Saisir un titre">
                <input type="submit" value="OK">
            </form>
            <form name="searchgenres" action="searchfilm.php" method="post">
                    <p style="color:white">ou par genre :</h2> <!-- Création de la liste des genres -->
                    <select name="genres" id="genres">
                        <option value="">
                            Choisir un genre
                        </option>
                        <option value="GENRE_SF">
                            Science Fiction
                        </option>
                        <option value="GENRE_FANTASY">
                            Fantaisie
                        </option>
                        <option value="GENRE_DRAMA">
                            Dramatique
                        </option>
                        <option value="GENRE_COPS">
                            Policier
                        </option>
                        <option value="GENRE_LIFE">
                            Romantique
                        </option>
                        <option value="GENRE_HORROR">
                            Horreur
                        </option>
                        <option value="GENRE_CHILDREN">
                            Jeunesse
                        </option>
                    </select> <input type="submit" value="OK">
            </form>
        </div>
    </header>
</body>

</html>