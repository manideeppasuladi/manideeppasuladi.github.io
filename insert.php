<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mani";

$newItemNo = $_REQUEST['item-No'];
$newItemName = $_REQUEST['item-Name'];
$newItemQty = $_REQUEST['item-Quantity'];
$newItemPrice = $_REQUEST['item-Price'];
// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO items VALUES ($newItemNo , '$newItemName' , $newItemQty , $newItemPrice )";

if (mysqli_query($con, $sql)) {
    $_SESSION['msg'] = 'New record created successfully' ;
    header('location:addItems.php ');
    //echo "New record created successfully";

} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $_SESSION['msg']  = "Error: ". $sql . "<br>" . mysqli_error($con) ;
    header('location:addItems.php ');
}

mysqli_close($con);
?> 