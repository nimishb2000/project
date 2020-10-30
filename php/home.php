<?php
setcookie('isloggedin', 'false', 0, '/');
if(isset($_COOKIE['isloggedin'])){
    header('Location: ../html/home.html');
}
else{
    echo 'There was an error: Please try reloading';
}
?>