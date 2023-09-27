<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
     integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous"
     referrerpolicy="no-referrer" />
<style>
    .container{
        display: flex;
        justify-content: center;
        height: 100vh;
        align-items: center;
    }
    .card{
        background-color: #80ed99;
        height: 425px;
        width: 325px;
        justify-content: center;
        text-align: center;
        border-radius: 50px;
        box-shadow: 5px 0px 5px 0px #be95c4;
    }
    .card img{
        /* margin-top: 50px; */
        height: 100px;
        width: 100px;
    }
    .email ,.password{
        width: 200px;
        height: 20px;
        margin-left: 50px;
        background-color: white;
        margin-top: 20px;
        border-radius: 6px;
        padding: 8px;
    }
    input{
        border: none;
    }
    .login,.create{
        margin-top: 10px;
        padding: 5px;
    }
    #formSubmits{
        padding: 8px;
        border-radius: 10px;
        background-color: #178665;
        color: white;
    }
    #formSubmit{
        padding: 8px;
        border-radius: 10px;
        background-color: #fcfbf4;
    }
    #formSubmits:hover{
        cursor: pointer;
    }
    #formSubmit:hover{
        cursor: pointer;
    }
    img{
        height: 100px;
        width: 100px;
    }
    h1{
        color: white;
    }

</style>
</head>
<body>
<div class="container">
   <div class="card">
        <h1>Admin Login</h1>
        <form action="adminlogin.php" method="post">
        <img src="https://e7.pngegg.com/pngimages/376/171/png-clipart-computer-icons-user-account-login-login-logo-vector-icons-thumbnail.png" alt="">
        <div class="email">
          <i class="fa-solid fa-envelope fa-beat-fade"></i>
          <input type="email" name="email" id="formEmail" placeholder="Enter Admin Email">
        </div>
        <div class="password">
        <i class="fa-solid fa-lock-open fa-shake"></i>
          <input type="password" name="pass" id="formPass" placeholder="Enter Password">
        </div>
        <div class="login"><input type="submit" name="submit" id="formSubmit" value="Login"></div>
        <div class="create"><input type="submit" name="submit" id="formSubmits" value="Create Account"></div>
       </form>
    </div>
 </div>
</body>
</html>

<?php
$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $findQuery = "SELECT * FROM `admins` where email = '$email' AND password = '$pass'";
    $checkQuery=mysqli_query($conn,$findQuery);
    if(mysqli_fetch_row($checkQuery)>0){
        echo "you are logged in successfully";
        $_SESSION['email'] = $email;
    $_SESSION['name']=mysqli_fetch_array(mysqli_query($conn,"SELECT admins.name from `admins` where email='$email' and password='$pass'"))['name'];
    $_SESSION['profile']="<img src = '"."adminprofileimages/".mysqli_fetch_array(mysqli_query($conn,"SELECT admins.profile 
    from `admins` where email='$email' and password='$pass'"))['profile']."'>";
    header('location:adminprofile.php');
    }
    else{
        sleep(2);
        echo 'please signin to login';
        header('location:adminsignin.php');
    }
    }

?>