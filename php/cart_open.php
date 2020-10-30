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
    if($fetched){
        $user_id = $fetched['user_id'];
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
            window.location.href='../html/home.html'</script>";
    }
}
else{
    echo"<script language='javascript'>alert('There was an error');
    window.location.href='../html/home.html'</script>";
}
$sql = $conn->query("select cart_id, total from cart where user_id=$user_id");
if($sql){
    $fetched = $sql->fetch_assoc();
    if($fetched){
        $cart_id = $fetched['cart_id'];
        $total = $fetched['total'];
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
            window.location.href='../html/home.html'</script>";
    }
}
else{
    echo"<script language='javascript'>alert('There was an error');
    window.location.href='../html/home.html'</script>";
}
$sql = $conn->query("SELECT product_id, quantity FROM cart_item WHERE cart_id=$cart_id");
$prod_id = Array();
$product = Array();
$quantity = Array();
$imageName = Array();
$cost = Array();
if($sql){
    while($arr = $sql->fetch_assoc()){
        $prod_id[] = $arr['product_id'];
        $quantity[] = $arr['quantity'];
    }
}
else{
    echo"<script language='javascript'>alert('There was an error');
    window.location.href='../html/home.html'</script>";
}
foreach($prod_id as $value){
    $sql= $conn->query("SELECT title, price, imageName FROM product WHERE product_id=$value");
    if($sql){
        $fetched = $sql->fetch_assoc();
        $product[] = $fetched['title'];
        $cost[] = $fetched['price'];
        $imageName[] = $fetched['imageName'];
    }
    else{
        echo"<script language='javascript'>alert('There was an error');
        window.location.href='../html/home.html'</script>";
    }
}
mysqli_close($conn);
?>

<script>
    const product = <?php echo json_encode($product) ?>;
    const quantity = <?php echo json_encode($quantity) ?>;
    const cost = <?php echo json_encode($cost) ?>;
    const imageName = <?php echo json_encode($imageName) ?>;
    const total = <?php echo $total ?>;
    const prodArr = JSON.stringify(product);
    const quanArr = JSON.stringify(quantity);
    const costArr = JSON.stringify(cost);
    const imageNameArr = JSON.stringify(imageName);
    localStorage.setItem('product', prodArr);
    localStorage.setItem('quantity', quanArr);
    localStorage.setItem('cost', costArr);
    localStorage.setItem('imageName', imageNameArr);
    localStorage.setItem('total', total);
    window.location.href = '../html/cart.html';
</script>