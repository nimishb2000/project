<?php
$sname = 'localhost';
$uname = 'root';
$pswrd = 'admin';
$dname = 'galipahinana';
$conn = mysqli_connect($sname, $uname, $pswrd, $dname);
if(!$conn){
    die('There was a connection error: '.mysqli_connect_error($conn));
}
$email = $_POST['email'];
$pass = $_POST['password'];
if(isset($_REQUEST['login'])){
    $pass_fetched = $conn->query("select * from user where email='$email'");
    if($pass_fetched){
        $fetched = $pass_fetched->fetch_assoc();
        if($fetched){
            if($fetched['password'] == $pass){
                setcookie('isloggedin', 'true', 0, '/');
                session_start();
                $_SESSION['email'] = $email;
                echo"<script language='javascript'>alert('Login Successful');
                    window.location.href='../html/home.html';</script>";
            }
            else{
                echo"<script language='javascript'>alert('Incorrect email or password');
                    window.location.href='../html/home.html';</script>";
            }
        }
        else{
            echo"<script language='javascript'>alert('Incorrect email or password');
                window.location.href='../html/login.html';;</script>";
        }
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
        window.location.href='../html/login.html';</script>";
    }
}
if(isset($_REQUEST['signup'])){
    $sql = "INSERT INTO user (email, password) VALUES ('$email', '$pass');";
    if(mysqli_query($conn, $sql)){
        echo"<script language='javascript'>alert('Signup Successful');</script>";
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
            window.location.href='../html/signup.html';</script>";
    }
    $sql = $conn->query("select user_id from user where email='$email'");
    if($sql){
        $fetched = $sql->fetch_assoc();
        if($fetched){
            $user_id = $fetched['user_id'];
        }
        else{
            echo"<script language='javascript'>alert('There was an error');
                window.location.href='../html/signup.html';</script>";
        }
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
        window.location.href='../html/signup.html';</script>";
    }
    $sql = "INSERT INTO cart (user_id) VALUES('$user_id');";
    if(mysqli_query($conn, $sql)){
        echo "<script>window.location.href='../html/login.html';</script>";
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
        window.location.href='../html/signup.html';</script>";
    }
}
mysqli_close($conn);
?>