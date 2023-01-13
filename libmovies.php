<?php
require_once __DIR__.'/nosql.php';

NoSQL::configure('_data');

define('MOVIE', 'movie');
define('SHOW', 'show');
define('GENRE_SF', 'sf');
define('GENRE_FANTASY', 'fantasy');
define('GENRE_DRAMA', 'drama');
define('GENRE_COPS', 'cops');
define('GENRE_LIFE', 'life');
define('GENRE_HORROR', 'horror');
define('GENRE_CHILDREN', 'children');
define('WTW_NETFLIX', 'netflix');
define('WTW_DPLUS', 'dplus');
define('WTW_PRIME', 'prime');
define('WTW_OCS', 'ocs');

function createMovie(string $title) {
    $saved = NoSQL::getInstance('movies')->save(['title' => $title, 'type' => MOVIE,]);
    return $saved['id'];
}

function createShow(string $title) {
    $saved = NoSQL::getInstance('movies')->save(['title' => $title, 'type' => SHOW,]);
    return $saved['id'];
}

function getMovieOrShow($id) {
    return NoSQL::getInstance('movies')->find(strval($id));
}

function getAllMoviesAndShows(): array {
    return NoSQL::getInstance('movies')->all();
}

function deleteAllMoviesAndShows() {
    NoSQL::getInstance('grades')->truncate();
    NoSQL::getInstance('movies')->truncate();
}

function deleteMovieOrShow($id) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie)) {
        // remove grades
        $grades = array_keys(NoSQL::getInstance('grades')->search('movie', $id, NoSQL::OP_EQ));
        foreach($grades as $grade) { NoSQL::getInstance('grades')->delete($grade); }
        NoSQL::getInstance('movies')->delete(strval($id));
    } else {
        throw new Exception('Movie or Show ID '.$id.' not found');
    }
}

function saveTitle($id, string $title) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie)) {
        $movie['title'] = $title;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Movie or Show ID '.$id.' not found');
    }
}

function savePitch($id, string $pitch) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie)) {
        $movie['pitch'] = $pitch;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Movie or Show ID '.$id.' not found');
    }
}

function saveGenres($id, array $genres) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie)) {
        $movie['genres'] = $genres;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Movie or Show ID '.$id.' not found');
    }
}

function saveComments($id, string $comments) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie)) {
        $movie['comments'] = $comments;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Movie or Show ID '.$id.' not found');
    }
}


function convertToHoursMins($time, $format = '%02dh %02dm') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function saveMovieLength($id, int $time) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie) && ($movie['type'] === MOVIE)) {
        $movie['length'] = $time;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Movie ID '.$id.' not found');
    }
}

function saveShowEpisodes($id, int $nb) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie) && ($movie['type'] === SHOW)) {
        $movie['episodes'] = $nb;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Show ID '.$id.' not found');
    }
}

function saveWhereToWatch($id, array $wtw) {
    $movie = NoSQL::getInstance('movies')->find(strval($id));
    if(!empty($movie)) {
        $movie['wtw'] = $wtw;
        NoSQL::getInstance('movies')->save($movie);
    } else {
        throw new Exception('Movie or Show ID '.$id.' not found');
    }
}

function hasAlreadyRated($movieId, string $userIp): bool {
    $returns = false;
    $movie = NoSQL::getInstance('movies')->find(strval($movieId));
    if(!empty($movie)) {
        $foundByIp = NoSQL::getInstance('grades')->search('ip', $userIp, NoSQL::OP_EQ);
        $foundByMovie = NoSQL::getInstance('grades')->search('movie', $movieId, NoSQL::OP_EQ);
        $returns = !empty(array_intersect(array_keys($foundByIp), array_keys($foundByMovie)));
    } else {
        throw new Exception('Movie or Show ID '.$movieId.' not found');
    }
    return $returns;
}

function rateMovieOrShow($movieId, string $userIp, int $note, string $comment) {
    $movie = NoSQL::getInstance('movies')->find(strval($movieId));
    if(!empty($movie)) {
        NoSQL::getInstance('grades')->save([
            'movie' => $movie['id'],
            'ip' => $userIp,
            'note' => $note,
            'comment' => $comment,
            'date' => date('Y-m-d H:i'),
        ]);
    } else {
        throw new Exception('Movie or Show ID '.$movieId.' not found');
    }
}

function searchMoviesOrShowsByTitle(string $title): array {
    return NoSQL::getInstance('movies')->search('title', $title, NoSQL::OP_LK);
}

function searchMoviesOrShowsByGenre(string $genres): array {
    return NoSQL::getInstance('movies')->search('genres', $genres, NoSQL::OP_IN);
}

function getMovieOrShowComments($movieId): array {
    $returns = [];
    $movie = NoSQL::getInstance('movies')->find(strval($movieId));
    if(!empty($movie)) {
        $returns = NoSQL::getInstance('grades')->search('movie', $movieId, NoSQL::OP_EQ);
    } else {
        throw new Exception('Movie or Show ID '.$movieId.' not found');
    }
    return $returns;
}
