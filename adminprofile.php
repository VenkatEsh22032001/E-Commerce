<?php
session_start();

if(!isset($_SESSION['name'])){
    header('location:adminlogin.php');
}

if(isset($_POST['submit'])){
    session_destroy();
    header('location:adminlogin.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       .header{
        display: flex;
        padding: 20px;
        width: 75%;
        height: 80px;
        justify-content: space-between;
        align-items: center;
        background-color: black;
        border-radius: 25px;
        margin-left: 150px;
        color: white;
       }
       img{
        height: 65px;
        width: 65px;
       }
      
       .main{
        display: grid;
        grid-template-columns: repeat(2,200px);
        grid-auto-rows: minmax(100px,auto);
        gap: 50px;
        text-align: center;
        justify-content: center;
        /* vertical-align: middle; */
        margin-top: 100px;
       }
       .main .one{
        background-color: #f9c80e;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border-radius: 20px;
        font-weight: bolder;
        font-size:x-large;
        cursor: pointer;
        box-shadow: 0px 0px 10px 10px grey;
       }
       .main .two{
        background-color: #f86624;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border-radius: 20px;
        font-weight: bolder;
        font-size:x-large;
        cursor: pointer;
        box-shadow: 0px 0px 10px 10px grey;
       }
       .main .three{
        background-color: #43bccd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border-radius: 20px;
        font-weight: bolder;
        font-size:x-large;
        cursor: pointer;
        box-shadow: 0px 0px 10px 10px grey;
       }
       .main .four{
        background-color: #ea3546;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border-radius: 20px;
        font-weight: bolder;
        font-size:x-large;
        cursor: pointer;
        box-shadow: 0px 0px 10px 10px grey;
       }
       a:hover{
        text-decoration: none;
        color: white;
       }

    </style>
</head>
<body>
<div class="header">
    <div class="profileImg">
        <h1><?php echo $_SESSION['name']?></h1>
    </div>
    <div class="logo">
        <?php echo $_SESSION['profile']?>
        <form action="" method="post">
            <input type="submit" value="LogOut" name="submit">
        </form> 
    </div> 
</div>
<div class="main">
        <div class="one"><a href="">Orders</a></div>
        <div class="two"><a href="productcrud.php">Products</a></div>
        <div class="three"><a href="viewusers.php">Users</a></div>
        <div class="four"><a href="adminsignin.php">Add Admin</a></div>
</div>
</body>
</html>
