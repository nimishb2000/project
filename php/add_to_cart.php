<?php
session_start();
if($_COOKIE['isloggedin'] == 'false'){
    echo"<script>alert('Log in to add to cart');
        window.location.href='../html/login.html'</script>";   
}
$conn = mysqli_connect('localhost', 'root', 'admin', 'galipahinana');
if(!$conn){
    die('There was an error: '.mysqli_connect_error($conn));
}
$email = $_SESSION['email'];
$sql = $conn->query("SELECT user_id FROM user WHERE email='$email'");
if($sql){
    $fetched = $sql->fetch_assoc();
    $user_id = $fetched['user_id'];
}
else{
    echo"<script>alert('There was an error');
        window.location.href='../html/home.html'</script>";
}
$sql = $conn->query("SELECT cart_id FROM cart WHERE user_id=$user_id");
if($sql){
    $fetched = $sql->fetch_assoc();
    $cart_id = $fetched['cart_id'];
}
else{
    echo"<script>alert('There was an error');
        window.location.href='../html/home.html'</script>";
}
$quantity = $_POST['quantity'];
if(isset($_REQUEST['crop'])){
    $sql = "insert into cart_item values(1, $quantity, $cart_id);";
    $cost = $quantity * 1399;
}
else if(isset($_REQUEST['shirt'])){
    $sql = "insert into cart_item values(6, $quantity, $cart_id);";
    $cost = $quantity * 600;
}
else if(isset($_REQUEST['pant'])){
    $sql = "insert into cart_item values(3, $quantity, $cart_id);";
    $cost = $quantity * 800;
}
else if(isset($_REQUEST['tee'])){
    $sql = "insert into cart_item values(2, $quantity, $cart_id);";
    $cost = $quantity * 400;
}
else if(isset($_REQUEST['kurta'])){
    $sql = "insert into cart_item values(4, $quantity, $cart_id);";
    $cost = $quantity * 600;
}
else if(isset($_REQUEST['jacket'])){
    $sql = "insert into cart_item values(5, $quantity, $cart_id);";
    $cost = $quantity * 2000;
}
else if(isset($_REQUEST['aztec'])){
    $sql = "insert into cart_item values(8, $quantity, $cart_id);";
    $cost = $quantity * 225;
}
else if(isset($_REQUEST['nebula'])){
    $sql = "insert into cart_item values(7, $quantity, $cart_id);";
    $cost = $quantity * 200;
}
else if(isset($_REQUEST['striped'])){
    $sql = "insert into cart_item values(9, $quantity, $cart_id);";
    $cost = $quantity * 220;
}
else{
    echo"<script>alert('Invalid access point');
        window.location.href='../html/home.html'</script>";
}
if(!mysqli_query($conn, $sql)){
    echo"<script>alert('There was an error');
        window.location.href='../html/home.html'</script>";
}
$sql = $conn->query("SELECT total FROM cart WHERE cart_id=$cart_id");
if($sql){
    $fetched = $sql->fetch_assoc();
    $total = $fetched['total'];
}
else{
    echo"<script>alert('There was an error');
        window.location.href='../html/home.html'</script>";
}
$new_total = $total + $cost;
$sql = "update cart set total=$new_total where cart_id=$cart_id;";
if(mysqli_query($conn, $sql)){
    echo"<script>alert('Added to cart successsfully');
    window.location.href='../html/home.html'</script>";
}
else{
    echo"<script>alert('There was an error');
        window.location.href='../html/home.html'</script>";
}
?>