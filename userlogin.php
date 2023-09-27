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
        background-color: #6a4c93;
        height: 425px;
        width: 300px;
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
        background-color: #8ac926;
        color: white;
    }
    #formSubmit{
        padding: 8px;
        border-radius: 10px;
        background-color: #ffca3a;
    }
    #formSubmits:hover{
        cursor: pointer;
    }
    #formSubmit:hover{
        cursor: pointer;
    }
    h1{
        color: white;
    }

</style>
</head>
<body>
<div class="container">
   <div class="card">
        <h1>User Login</h1>
        <form  method="post">
        <img src="https://static-00.iconduck.com/assets.00/user-login-icon-487x512-xx4t1c61.png" alt="">
        <div class="email">
          <i class="fa-solid fa-envelope fa-beat-fade"></i>
          <input type="email" name="email" id="formEmail" placeholder="Enter User Email">
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
    // $userid = $_GET['Id'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $findQuery = "SELECT * FROM `customers` where email = '$email' AND password = '$pass'";
    $checkQuery=mysqli_query($conn,$findQuery);
    if($checkQuery->num_rows>0){
        $one=mysqli_fetch_array($checkQuery);
        echo "you are logged in successfully";
        $_SESSION['Id']= $one['Id'];    
        echo $_SESSION['Id'];
        $_SESSION['email'] = $email;
    $_SESSION['name']=mysqli_fetch_array(mysqli_query($conn,"SELECT customers.name from `customers` where email='$email' and password='$pass'"))['name'];
    $_SESSION['profile']="<img  src = '"."userimages/".mysqli_fetch_array(mysqli_query($conn,"SELECT customers.profile 
    from `customers` where email='$email' and password='$pass'"))['profile']."' height='70px' width='70px'>";
    header('location:userprofile.php');
    }
    else{
        sleep(2);   
        echo 'please signin to login';
        header('location:usersignin.php');
    }
    }
?>