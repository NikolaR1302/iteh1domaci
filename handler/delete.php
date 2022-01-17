<?php
require "../dbBroker.php";
require "../movie.php";

if(isset($_POST['id'])) {
    Movie::deleteMovieById($_POST['id'], $connection);
}