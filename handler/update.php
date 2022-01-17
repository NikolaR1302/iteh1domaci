<?php

require "../dbBroker.php";
require "../movie.php";

if (isset($_POST['movieName']) && isset($_POST['movieGenre'])
     && isset($_POST['movieYear'])) {
   Movie::editMovie($_POST['movieId'], $_POST['movieName'], $_POST['movieGenre'], $_POST['movieYear'], $connection);
}