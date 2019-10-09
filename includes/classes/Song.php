<?php 

    class Song {
        private $con;
        private $id;
        private $song;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;
            
            $songQuery = mysqli_query($con, "SELECT * FROM songs WHERE id = '$this->id'");

            $this->song = mysqli_fetch_array($songQuery);

        }


        public function getTitle() {
            return $this->song['title'];
        }

        
        public function getArtist() {
            $artistId = $this->song['artist'];
            return new Artist($this->con,$artistId);
        }
        
        public function getAlbum() {
            $albumId = $this->song['album'];
            return new Album($this->con, $albumId);
        }
        
        public function getPath() {
            return $this->song['path'];
        }
        
        public function getDuration() {
            return $this->song['duration'];
        }
        
        public function getMysqliData() {
            return $this->song;
        }

        public function getGenre() {
            return $this->song['genre'];
        }




    }

?>