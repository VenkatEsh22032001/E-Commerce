<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
</body>
</html>
<?php
    $conn = mysqli_connect("localhost","root",'root','ecommerce_admin');
    $id=$_GET['Id'];
    $deleteQuery = "DELETE FROM `customers` WHERE Id=$id";
    mysqli_query($conn,$deleteQuery);
    header('location:viewusers.php')
?>