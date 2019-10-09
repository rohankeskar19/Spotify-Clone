<?php 

    class Album {
        private $con;
        private $id;
        private $album;

        public function __construct($con,$id){
            $this->con = $con;
            $this->id = $id;
            
            $albumQuery = mysqli_query($this->con,"SELECT * FROM albums WHERE id = '$this->id'");
            $this->album = mysqli_fetch_array($albumQuery);
        }

        public function getTitle(){
            return $this->album['title'];
        }

        public function getArtworkPath() {
            return $this->album['artworkPath'];
        }

        public function getGenre() {
            return $this->album['genre'];
        }

        public function getArtist() {
            return new Artist($this->con,$this->album['artist']);
        }

        public function getNumberOfSongs(){
            $query = mysqli_query($this->con,"SELECT * FROM songs WHERE album = '$this->id'");

            return mysqli_num_rows($query);
        }

        public function getSongIds(){
            $query = mysqli_query($this->con, "SELECT id FROM songs WHERE album = '$this->id' ORDER BY albumOrder ASC");

            $array = array();

            while($row = mysqli_fetch_array($query)){
                array_push($array, $row['id']);
            }
            return $array;
        }
    }















?>