<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <style>
        .container{
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 40px;
        }
        a{
            font-size: 50px;
            color: greenyellow;
            text-decoration: none;
        }
        .header{
            display: flex;
            justify-content: space-between;
            height: 80px;
            background-color: black;
            color: white;
        }
        #inputquantity{
            width: 60px;
        }
        #quantity{
            font-size: x-large;
        }
    </style>

</head>
<body>
    <div class="header">
    <h1>CART</h1>
     <a href="userprofile.php"><i class="fa-solid fa-basket-shopping fa-beat"></i></a>
     <a href="checkout.php">Checkout</a>
     </div>

    <div class="container">
        
<?php

      session_start();
      $conn = mysqli_connect('localhost','root','root','ecommerce_admin');
      $userid = $_SESSION['Id'];
      $joinquery = "SELECT*FROM `cart` 
      INNER JOIN  productstable ON productstable.Id = cart.product_id
      INNER JOIN customers ON customers.Id = cart.user_id WHERE user_id='$userid'";
      $innerjoin = mysqli_query($conn,$joinquery);
      while($displaycart = mysqli_fetch_assoc($innerjoin)){
      echo "<div class='card' style='width: 18rem;'>
      <img src='productimages/$displaycart[productimage]' class='card-img-top' height='200px'>
      <div class='card-body'>
        <h1 class='card-title'>$displaycart[productname]</h1>
        <h3 class='card-text'>₹$displaycart[productprice]</h3>
        <h4>Quantity:$displaycart[quantity]</h4>
        <form  method='post'>
        <label for='quantity' id='quantity'>Quantity: </label>
        <input type='number' name='quantity' id='inputquantity' min='1' value='$displaycart[quantity]'>
        <input type='number' name='productid' id='inputcart' style='display:none;' value='$displaycart[product_id]'>
        <div>
        <input type='submit' class='btn btn-primary' name='submit' value='Update'>
        <input  type='submit' class='btn btn-primary' name='remove' value='Remove'>
        </div>
        </form>
      </div>
    </div>";
      };
      if(isset($_POST['submit'])){
         $userid = $_SESSION['Id'];
         $quantity = $_POST['quantity'];
         $cartid=$userid+25;
         $productid=$_POST['productid'];
        $updatequery ="UPDATE `cart` SET quantity=$quantity 
        WHERE product_id=$productid AND cart_id=$cartid 
        AND user_id=$userid";
        mysqli_query($conn,$updatequery);
        header('location:cart.php');
        }elseif(isset($_POST['remove'])){
            $productid=$_POST['productid'];
            $removequery = "DELETE  FROM `cart` WHERE product_id=$productid;";
            echo $removequery;
            mysqli_query($conn,$removequery);
            header('location:cart.php');
        } 
    ?> 

     </div>
</body>
</html>