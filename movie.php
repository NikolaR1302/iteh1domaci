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
    }



?>