<?php
session_start();
$email = $_SESSION['email'];
$conn = mysqli_connect('localhost', 'root', 'admin', 'galipahinana');
if(!$conn){
    die('There was a connection error: '.mysqli_connect_error($conn));
}
$sql = $conn->query("select user_id from user where email='$email'");
if($sql){
    $fetched = $sql->fetch_assoc();
    $user_id = $fetched['user_id'];
}
else{
    echo"<script>alert('There was an error');
        window.location.href='cart_open.php'</script>";
}
$sql = $conn->query("select cart_id from cart where user_id='$user_id'");
if($sql){
    $fetched = $sql->fetch_assoc();
    $cart_id = $fetched['cart_id'];
}
else{
    echo"<script>alert('There was an error');
        window.location.href='cart_open.php'</script>";
}
$sql = "delete from cart_item where cart_id = $cart_id;";
if(mysqli_query($conn, $sql)){
    echo"<script>alert('Order placed successfully');
        window.location.href='../html/home.html'</script>";
}
else{
    echo"<script>alert('There was an error');
        window.location.href='cart_open.php'</script>";
}
mysqli_close($conn);
?>