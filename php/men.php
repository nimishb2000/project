<?php
$conn = mysqli_connect('localhost', 'root', 'admin', 'galipahinana');
if(!$conn){
    die('There was a connection error: '.mysqli_connect_error($conn));
}
$sql = $conn->query("SELECT * FROM product WHERE category='M'");
$title = Array();
$price = Array();
$imageName = Array();
if($sql){
    while($arr = $sql->fetch_assoc()){
        $title[] = $arr['title'];
        $price[] = $arr['price'];
        $imageName[] = $arr['imageName'];
    }
}
else{
    echo"<script>alert('There was an error');
        window.location.href='../html/home.html';</script>";
}
mysqli_close($conn);
?>

<script>
const titleArr = <?php echo json_encode($title) ?>;
const priceArr = <?php echo json_encode($price) ?>;
const imageArr = <?php echo json_encode($imageName) ?>;
const title = JSON.stringify(titleArr);
const price = JSON.stringify(priceArr);
const image = JSON.stringify(imageArr);
localStorage.setItem('title', title);
localStorage.setItem('price', price);
localStorage.setItem('image', image);
localStorage.setItem('category', 'M');
window.location.href = '../html/category.html';
</script>