<?php
session_start();
if(!isset($_SESSION['name'])){
    header('location:userlogin.php');
}
if(isset($_POST['submit'])){
    session_destroy();
    sleep(3);
    header('location:userlogin.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src=
"https://code.jquery.com/jquery-3.6.0.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
       .header{
        display: flex;
        padding: 20px;
        width: 100%;
        height: 100px;
        justify-content: space-between;
        align-items: center;
        background-color: black;
        /* border-radius: 25px; */
        /* margin-left: 150px; */
        color: white;
       }
       .main1{
        display: flex;
        justify-content: center;
       }
       #img{
        height: 65px;
        width: 65px;
       }
       a:hover{
        text-decoration: none;
        color: white;
       }
       .grid-container{
        display: grid;
        grid-template-columns: repeat(4,1fr);
        gap: 45px;
        margin-top: 55px;
       }
       .main{
        margin-top: 10px;
        display: flex;
        justify-content: center;
       }
       .form{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 65px;
        color: white;
      
        /* position: absolute; */
      }
      #inputId{
        width: 400px;
        height: 25px;
        border-radius: 12.5px;
        padding: 25px;
      }
      i{
        font-size: 40px;
        position: relative;
        left: 25px;
        color: white;
        z-index: 3;
        left: 5px;
      }
      #quantity{
            font-size: x-large;
        }
        #inputquantity{
            width: 60px;
        }
      .btn{
         margin-bottom: 12px;
      }
      /* #Ajax{
        margin-top: 200px;
      } */
      .search{
        display: block;

      }
      .parent{
        display: block;
      }
    </style>
</head>

<!-- <i class="fa-solid fa-cart-arrow-down fa-beat"></i> -->
<body>
  <div class="parent">
    <div class="main1">
<div class="header">
    <div class="profileImg">
        <img src="https://hysterchat.com/file/group-avatars/26/1689751509-bpfull.png" alt="" height="90px" width="70px">
        <h6>Hysteresis</h6>
    </div>
    <div class="search">
    <div class="form">
    <form  id="Ajax_form">
    <label for="Name">Search Products</label>
    <input type="text"  id="inputId" placeholder="Search Product">
     </form>
     </div>
     
    </div>
  
 
  
    <div class="logo">
        <?php echo $_SESSION['profile']?>
        <h6><?php echo $_SESSION['name']?></h>
        <form  method="post">
            <input type="submit" value="LogOut" name="submit">
        </form> 
    </div> 
  
    <div class="anchor">
      <a href="cart.php"><i class="fa-solid fa-cart-shopping fa-bounce"></i></a>
      
    </div>
</div>

</div>
<div id="Ajax">
    
    </div>
</div>
<div class="main">
<!-- <form  method="post">
<input type="submit" class="btn btn-primary" name="buttoncart" value="Add to cart">
</form> -->



<div class="grid-container">

<?php
$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
$query = mysqli_query($conn,"SELECT * FROM `productstable`");
while($display=mysqli_fetch_assoc($query)){
    echo "<div class='card' style='width: 18rem;'>
    <img src='productimages/$display[productimage]' class='card-img-top' height='200px'>
    <div class='card-body'>
      <h3 class='card-title'>$display[productname]</h3>
      <h5 class='card-title'>$display[productdescription]</h5>
      <p class='card-text'>₹$display[productprice]</p>
      <form  method='post'>
      <label for='quantity' id='quantity'>Quantity: </label>
      <input type='number' name='quantity' id='inputquantity'>
      <input type='submit' class='btn btn-primary'  name='$display[Id]' value='Add to cart'>
      </form>
    </div>
  </div>";

  if(isset($_POST[$display['Id']])){
    $userid = $_SESSION['Id'];
    // print_r($userid);
    $quantity = $_POST['quantity'];
    $cartid=$userid+25;
    $productid=$display['Id'];
    $cartquery="SELECT * FROM `cart` WHERE cart_id=$cartid AND product_id=$productid";
    $insert = mysqli_query($conn,$cartquery);
    if(mysqli_num_rows($insert)==0){
      $insertquery = mysqli_query($conn,"INSERT INTO cart(user_id,cart_id,product_id,quantity) 
                                         VALUES('$userid','$cartid','$productid','$quantity')");
    }else{
      $updatequery = mysqli_query($conn,"UPDATE cart SET quantity='$quantity' 
                                  WHERE product_id='$productid' AND cart_id='$cartid' 
                                  AND product_id='$productid'");
    }
  }
}
echo '</div>
</div>
</body>
</html>';
?>


<script>
  $("#Ajax_form").keyup(function(e){
    e.preventDefault();
    $.ajax({
      url:'productusersearch.php',
      type: 'POST',
      data:{name:$('#inputId').val()},
      success:function(response){
        $('#Ajax').html(response)
      }
    })
  })
</script>
