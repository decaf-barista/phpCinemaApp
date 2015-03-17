<?php
$session_id = session_id();
if ($session_id == "") {
    session_start();
}
if (isset($_SESSION['username'])) {
    echo '<div class="container">';
    echo '  <div class="login_bar">';    
    echo '      <h3 class="login col-lg-2 col-lg-offset-9 col-md-2 col-md-offset-8 col-sm-offset-8 col-sm-2 col-xs-2 col-xs-offset-6"><a href="home.php">HOME</a></h3>';
    echo '      <h3 class="register col-lg-1 col-md-2 col-sm-2 col-xs-4"><a href="logout.php">LOGOUT</a></h3>';
    echo '  </div>';
    echo '</div>';
    echo '<div class="line">';
    echo '</div>';
}
else {
    echo '<div class="container">';
    echo '  <div class="login_bar">';    
    echo '      <h3 class="login col-lg-2 col-lg-offset-9 col-md-2 col-md-offset-8 col-sm-offset-8 col-sm-2 col-xs-2 col-xs-offset-6"><a href="login.php">LOGIN</a></h3>';
    echo '      <h3 class="register col-lg-1 col-md-2 col-sm-2 col-xs-4"><a href="register.php">SIGN UP</a></h3>';
    echo '  </div>';
    echo '</div>';
    echo '<div class="line">';
    echo '</div>';
}
    