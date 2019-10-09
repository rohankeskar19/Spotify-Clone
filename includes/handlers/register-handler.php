<?php
    

    function sanitizeFormUsername($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        
        return $inputText;
    }

    function sanitizeFormName($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        $inputText = ucfirst(strtolower($inputText));

        return $inputText;
    }


    

    if(isset($_POST['registerButton'])){
        // Register button was pressed
        $username = sanitizeFormUsername($_POST['username']);
        $firstName = sanitizeFormName($_POST['firstName']);
        $lastName = sanitizeFormName($_POST['lastName']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        
        
        $wasSuccessful = $account->register($username,$firstName,$lastName,$email,$password,$password2);

        if($wasSuccessful){
            $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
        }
        else{
            
        }


    }

?>