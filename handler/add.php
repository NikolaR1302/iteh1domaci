<?php
require "../dbBroker.php";
require "../movie.php";

if (isset($_POST['movieName']) && isset($_POST['movieGenre']) 
    && isset($_POST['movieYear']) ) {
    Movie::addMovie($_POST['movieName'], $_POST['movieGenre'], $_POST['movieYear'],$_POST['userId'], $connection);
}
