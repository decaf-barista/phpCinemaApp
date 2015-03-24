<!DOCTYPE html>
<html>
    <head>
        <?php require 'styles.php' ?>
        <!--js-->
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'navbar.php' ?>
        <div class="window-bg">
            <div class="container">
                <div class="row window col-lg-10 col-lg-offset-1">
                    <form id="registerForm" class="form col-lg-6" action="checkRegister.php" method="POST"><!--submits data to be processed in checkRegister-->
                        <table border="0">
                            <tbody>
                                <tr><h1 class="col-lg-6">REGISTER</h1></tr>
                                <tr>
                                    <td class="col-lg-3"><h3 >Username</h3></td>
                                    <td class="col-lg-3">
                                        <input class="input" type="text" name="username" value="" /><br>
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
                                    <td class="col-lg-3"><h3>Confirm Password</h3></td>
                                    <td class="col-lg-3">
                                        <input class="input" type="password" name="password2" value="" /><br>
                                        <span id="password2Error" class="error"><!--inside span error message will display-->
                                            <?php
                                            if (isset($errorMessage) && isset($errorMessage['password2'])) {
                                                echo $errorMessage['password2'];
                                            }
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="regsubmit" type="submit" value="SIGN UP" name="register" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="form-aside col-lg-6">
                        <h4>Have an account with us already?</h4>
                        <a href="login.php">SIGN IN</a>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'footer.php' ?>
        <?php require 'scripts.php' ?>
    </body>
</html>
