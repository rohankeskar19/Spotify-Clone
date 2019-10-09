<?php
    class Account {
        private $con;
        private $errors;

        public function __construct($con) {
            $this->con = $con;
            $this->errors = array();
        }

        public function login($un,$pw){
            $options = [
                'cost' => 12,
            ];

            

            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un'");

            if(mysqli_num_rows($query) == 1){
                $result = mysqli_fetch_array($query);
                
                if(password_verify($pw,$result['password'])){
                    return true;
                }
                else {
                    array_push($this->errors, Constants::$loginFailed);
                    return false;
                }
            }
            else {
                array_push($this->errors, Constants::$loginFailed);
                return false;
            }
        }

        public function register($un, $fn, $ln, $em, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmail($em);
            $this->validatePasswords($pw,$pw2);

            if(empty($this->errors)){
                
                $this->insertUserDetails($un, $fn, $ln, $em, $pw, $pw2);
                
            }   
            else{
                
                return false;
            }
        }

        public function getError($error){
            if(!in_array($error, $this->errors)){
                $error = "";
                
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function validateUsername($username) {
            if(strlen($username) > 25 || strlen($username) < 5) {
                array_push($this->errors, Constants::$usernameError);
                return;
            }
            // @TODO: Check if username exists
            $checkUserNameExists = mysqli_query($this->con, "SELECT username FROM users WHERE username='$username'");

            if(mysqli_num_rows($checkUserNameExists) != 0){
                array_push($this->errors, Constants::$usernameTaken);
                return;
            }

           
        }
    
        private function validateFirstName($firstName) {
            if(strlen($firstName) > 25 || strlen($firstName) < 2) {
                array_push($this->errors, Constants::$firstNameLengthError);
                return;
            }
        }
    
        private function validateLastName($lastName) {
            if(strlen($lastName) > 25 || strlen($lastName) < 2) {
                array_push($this->errors, Constants::$lastNameLengthError);
                return;
            }
        }
    
        private function validateEmail($email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($this->errors, Constants::$emailInvalidError);
                return;
            }

            // TODO: Check that email hasn't already been used
            $checkEmailExists = mysqli_query($this->con, "SELECT email FROM users WHERE email='$email'");

            if(mysqli_num_rows($checkEmailExists) != 0){
                array_push($this->errors, Constants::$emailTaken);
                return;
            }
        }   
    
        private function validatePasswords($password,$password2) {
            if($password != $password2){
                array_push($this->errors, Constants::$passwordsDoNotMatch);
                return;
            }
            if(preg_match('/[^A-Za-z0-9]/',$password)){
                array_push($this->errors, Constants::$invalidPasswordError);
                return;
            }
            if(strlen($password) > 30 || strlen($password) < 5) {
                array_push($this->errors, Constants::$passwordLengthError);
                return;
            }
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw){
            $options = [
                'cost' => 12,

            ];

            $encryptedpw = password_hash($pw, PASSWORD_BCRYPT, $options);
            $profilePic = "assets/images/profile-pics/head_emerald.png";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('','$un','$fn','$ln','$em','$encryptedpw','$date','$profilePic')");

            return $result;
        }


    }





?>
