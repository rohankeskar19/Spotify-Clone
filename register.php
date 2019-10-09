<?php 
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");

    if(isset($_SESSION['userLoggedIn'])){
        header("Location: index.php");
    }

    $account = new Account($con);
    
    
    


    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");


    function getInputValue($name) {
        if(isset($_POST[$name])){
            echo $_POST[$name]; 
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/register.css"/>
</head>
<body>
    
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form  method="POST" action="register.php" id="loginForm">
                    <h2>Login to your account</h2>
                    <p> 
                        <label for="loginUsername">Username</label>
                        <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. bartSimpson" value="<?php getInputValue("loginUsername") ?>" required>
                        <?php echo $account->getError(Constants::$loginFailed) ?>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="loginPassword" placeholder="Your password" required>
                    </p>
                    
                    <button type="submit" name="loginButton">LOGIN</button>

                    <div class="hasAccountText">
                        <p id="hideLogin">Don't have an account yet? Sign up here.</p>
                    </div>
                </form>

                <form  method="POST" action="register.php" id="registerForm">
                    <h2>Create your free acount</h2>
                    <p>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="e.g. bartSimpson" value="<?php getInputValue("username") ?>" required>
                        <?php echo $account->getError(Constants::$usernameTaken)?>
                        <?php echo $account->getError(Constants::$usernameError); ?>
                    </p>

                    <p>
                        <label for="firstName">First name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="e.g. Bart" value="<?php getInputValue("firstName") ?>" required>
                        <?php echo $account->getError(Constants::$firstNameLengthError); ?>
                    </p>

                    <p>
                        <label for="lastName">Last name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="e.g. Simpson" value="<?php getInputValue("lastName") ?>" required>
                        <?php echo $account->getError(Constants::$lastNameLengthError); ?>
                    </p>

                    <p> 
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue("email") ?>" required>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <?php echo $account->getError(Constants::$emailInvalidError); ?>
                    </p>


                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your password" value="<?php getInputValue("password") ?>" required>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$invalidPasswordError); ?>
                        <?php echo $account->getError(Constants::$passwordLengthError); ?>
                    </p>

                    <p>
                        <label for="password2">Confirm password</label>
                        <input type="password" id="password2" name="password2" placeholder="Confirm password" value="<?php getInputValue("password2") ?>" required>
                    </p>
                    
                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">
                        <p id="hideRegister">Already have an account? Log in here.</p>
                    </div>

                </form>

            </div>
            
            <div id="loginText">
                <h1 class="greenHeading">Get great music, right now</h1>
                <h2>Listen to loads of songs for free.</h2>
                <ul>
                    <li><i class="fas fa-check icon"></i> Discover music you'll fall in love with.</li>
                    <li><i class="fas fa-check icon"></i> Create your own playlists.</li>
                    <li><i class="fas fa-check icon"></i> Follow artists to keep up to date.</li>
                </ul>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/register.js" ></script>
    <?php 
        if(isset($_POST['registerButton'])){
            echo '<script>
                    $(document).ready(function(){
                        $("#loginForm").hide();
                        $("#registerForm").show();
                    });
                </script>';
        }
        else {
            echo '<script>
                    $(document).ready(function(){
                        $("#loginForm").show();
                        $("#registerForm").hide();
                    });
                </script>';
        }
    
    ?>
</body>
</html>