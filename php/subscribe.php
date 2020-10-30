<?php
$email = $_POST['email'];
$hostname = 'localhost';
$username = 'root';
$password = 'admin';
$dbname = 'galipahinana';
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
    die("There was a connection error: ".mysqli_connect_error());
}
$sql = "insert into subscribers (email) values('$email');";
if(mysqli_query($conn, $sql)){
    echo"<script language='javascript'>alert('Registered Successfully');
        window.location.href='../html/home.html'</script>";
}
else{
    echo"<script language='javascript'>alert('Email already registered');
        window.location.href='../html/home.html'</script>";
}
mysqli_close($conn);
?>