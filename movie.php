<?php
    class Movie{
        public $id;
        public $name;
        public $genre;
        public $year;       
        public $userid;

        public function __construct($id = null, $name = null, $genre = null, $year = null, $userId= -1)
        {
            $this->id = $id;
            $this->name = $name;
            $this->genre = $genre;
            $this->year = $year;
            $this->userId= $userId;

        }

        public static function getAllMovies(mysqli $connection)
        {
            $userId= $_SESSION['user_id'];
            $q = "SELECT * FROM movie where userId= $userId";
            return $connection->query($q);
        }
    
        public static function getMovieById($id, mysqli $connection)
        {
            $q = "SELECT * FROM movie WHERE id=$id";
            $myArray = array();
            if ($result = $connection->query($q)) {

                while ($row = $result->fetch_array(1)) {
                    $myArray[] = $row;
                }
            }
            return $myArray;
        }

        public static function deleteMovieById($id, mysqli $connection)
        {
            $q = "DELETE FROM movie WHERE id=$id";
            return $connection->query($q);
        }

        public static function addMovie($name, $genre, $year, $userId, mysqli $connection)
        {
            $q = "INSERT INTO movie(name,genre,year,userId) values('$name','$genre', '$year','$userId')";
            return $connection->query($q);
        }

        public static function editMovie($id, $name, $genre, $year, mysqli $connection)
        {
            $q = "UPDATE movie set name='$name', genre='$genre', year='$year' where id=$id";
            return $connection->query($q);
        }
    
    }



?>