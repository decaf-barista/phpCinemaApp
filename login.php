<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css"><!--css-->
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'navbar.php' ?>`
        <?php
        if (!isset($username)) {
            $username = '';
        }
        ?>
        <h1>Administrator log-in</h1>
        <form action="checkLogin.php" method="POST"><!--submits data to be processed in checkLogin-->
            <table border="0">
                <tbody>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text"
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
                        <td>Password</td>
                        <td>
                            <input type="password" name="password" value="" />
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
                            <input type="submit" value="Login" name="login"/>
                            <input type="button"
                                   value="Register"
                                   name="register"
                                   onclick="document.location.href = 'register.php'"
                                   />
                            <input type="button" value="Forgot Passward" name="forgot" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>        
    </body>
</html>
