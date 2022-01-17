<?php

require "../dbBroker.php";
require "../movie.php";

if(isset($_POST['id'])) {
    $movie = Movie::getMovieById($_POST['id'], $connection);
    echo json_encode($movie);
}