<?php 
    include("includes/config.php");
    include("classes/Artist.php");
    include("classes/Album.php");
    include("classes/Song.php");
    //session_destroy();    LOGOUT

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }
    else {
        header('Location: register.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spotify</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css" />
    <script src="assets/js/script.js"></script>
</head>
<body>

    <script>
        var audioElement = new Audio();
        audioElement.setTrack("asstes/music/Khalid-Talk.webm");
        audioElement.audio.play();
    </script>
    
    <div class="mainContainer">
        <div id="topContainer">
            
            <?php include("includes/navBarContainer.php") ?>

            <div id="mainViewContainer">

                <div id="mainContent">