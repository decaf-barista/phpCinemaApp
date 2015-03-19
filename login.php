<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"><!--lets my browser read and display characters-->
        <meta name="viewport" content="width=device-width initial-scale=1.0"><!--will scale for the different with of pages-->
        <!--linking stylesheets-->
        <link href="css/bootstrap.min.css" rel="stylesheet"><!--using .min so it will be faster, framework style sheet-->
        <link href="css/custom.css" rel="stylesheet"><!--my own css file-->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="images/oscars.png"/>
        <script src="js/respond.min.js"></script><!--what we downloaded from github needs to be in the head! otherwise not reposive-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <title>TAKE TWO</title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>`
        <?php
        if (!isset($username)) {
            $username = '';
        }
        ?>
        <div class="window-bg">
            <div class="container">
                <div class="row window">
                    <form class="form col-lg-6" action="checkLogin.php" method="POST"><!--submits data to be processed in checkLogin-->
                        <table border="0">
                            <tbody>
                                <tr><h1>LOGIN</h1></tr>
                            <tr>
                                <td class="col-lg-3"><h3 >Username</h3></td>
                                <td class="col-lg-3">
                                    <input class="input"
                                           type="text"
                                           name="username"
                                           value="<?php echo $username; ?>" />
                                    <span id="usernameError" class="error"><!--inside span error message will display-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['username'])) {
                                            echo $errorMessage['username'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-3"><h3>Password</h3></td>
                                <td class="col-lg-3">
                                    <input class="input" type="password" name="password" value="" />
                                    <span id="passwordError" class="error"><!--inside span error message will display-->
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['password'])) {
                                            echo $errorMessage['password'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input class="submit" type="submit" value="Login" name="login"/>
                                    
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="login-aside col-lg-6">
                        <h4 >Already have an account?</h4>
                        <input style="margin-left:210px;" type="button"
                                           value="Register"
                                           name="register"
                                           onclick="document.location.href = 'register.php'"
                                           />
                        <h4>Forget something?</h4>
                        <input style="margin-left:180px" type="button" value="Forgot Passward" name="forgot" />
                    </div>
                </div>
            </div>
        </div>
        <?php require 'footer.php' ?>        
    </body>
</html>
