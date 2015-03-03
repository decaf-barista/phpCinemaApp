<?php
$session_id = session_id();
if ($session_id == "") {
    session_start();
}
if (isset($_SESSION['username'])) {
    echo '<div class="toolbar">';
    echo '<p class="left" ><a href="login.php">Logout</a></p>';
    echo '<p class="right"><a href="home.php">Home</a></p>';
    echo '</div>';
}
else {
    echo '<div class="toolbar">';
    echo '<p class="left"><a href="login.php">Login</a></p>';
    echo '<p class="right"><a href="home.php">Home</a></p>';
    echo '</div>';
}