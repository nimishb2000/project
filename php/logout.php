<?php
setcookie('isloggedin', 'false', 0, '/');
session_unset();
session_destroy();
header('Location: ../html/home.html');
?>