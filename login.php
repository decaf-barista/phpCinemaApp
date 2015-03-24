<!DOCTYPE html>
<html>
    <head>
       <?php require 'styles.php' ?>
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
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form class="form col-lg-6" action="checkLogin.php" method="POST"><!--submits data to be processed in checkLogin-->
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-6">LOGIN</h1></tr>
                            <tr>
                                <td class="col-lg-3"><h3>Username</h3></td>
                                <td class="col-lg-3">
                                    <input class="input"
                                           type="text"
                                           name="username"
                                           value="<?php echo $username; ?>" /><br>
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
                                    <input class="input" type="password" name="password" value="" /><br>
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
                                    <input class="submit" type="submit" value="LOGIN" name="login"/>
                                    
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="login-aside col-lg-6">
                        <h4>Don't have an account already?</h4>
                        <input type="button"
                                           value="REGISTER"
                                           name="register"
                                           onclick="document.location.href = 'register.php'"
                                           />
                        <!--<div class="forgot">
                            <h4>Have trouble logging in?</h4>
                            <input class="forgot" type="button" value="FORGOT PASSWORD" name="forgot" />
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <?php require 'footer.php' ?> 
        <?php require 'scripts.php' ?>
    </body>
</html>
