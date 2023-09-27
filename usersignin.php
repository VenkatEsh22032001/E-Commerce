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
        background-color: #ff9f1c;
        height: 550px;
        width: 350px;
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
    .email ,.password,.name,.phone,.file{
        width: 200px;
        height: 20px;
        margin-left: 75px;
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
        background-color: black;
        color: white;
    }
    h1{
      color: white;
    }
    </style>
</head>
<body>
<div class="container">
<div class="card">
        <h1>User SignIn</h1>
        <form action="usersignin.php" method="post"  enctype="multipart/form-data">
        <img src="https://www.aptiplus.in/assets/img/login-bg.png" alt="">
        <div class="name">
        <i class="fa-solid fa-file-signature fa-beat-fade"></i>
          <input type="text" name="name" id="formName" placeholder="Enter User Name">
        </div>
        <div class="email">
          <i class="fa-solid fa-envelope fa-beat-fade"></i>
          <input type="email" name="email" id="formEmail" placeholder="Enter User Email">
        </div>
        <div class="phone">
        <i class="fa-solid fa-mobile fa-beat-fade"></i>
          <input type="text" name="phonenumber" id="formPhone" placeholder="Enter Phone Number">
        </div>
        <div class="password">
        <i class="fa-solid fa-lock-open fa-shake"></i>
          <input type="password" name="pass" id="formPass" placeholder="Enter Password">
        </div>
        <div class="file">
          <input type="file" name="files" id="formFile">
        </div>
        <div class="create"><input type="submit" name="submit" id="formSubmits" value="Create Account"></div>
       </form>
    </div>
 </div>
</body>
</html>
<?php
$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
$outMessageorError = '';

$targetDir = "userimages/";

if(isset($_POST["submit"])){
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$phonenumber = $_POST['phonenumber'];

if(!empty($_FILES["files"]["name"])){
$fileName = rand(1000,10000)."-".$_FILES["files"]["name"];
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
if(in_array($fileType, array('jpg','png','jpeg','gif'))){
if(move_uploaded_file($_FILES["files"]["tmp_name"], $targetFilePath)){

    $checkAdmin = mysqli_query($conn,"SELECT * FROM `customers` where name='$name' 
    OR email='$email' OR phonenumber='$phonenumber' OR password='$pass'" );
    if(mysqli_fetch_row($checkAdmin)<1){
        $insert = mysqli_query($conn,"INSERT INTO customers(name,email,phonenumber,password,profile)
         VALUES ('".$name."', '".$email."','".$phonenumber."','".$pass."','".$fileName."')");
sleep(3);
header('location:userlogin.php');
if($insert){
$outMessageorError = "The file ".$fileName. " has been uploaded successfully.";
}else{
$outMessageorError = "Image cant be uploaded";
}
}else{
    echo 'ADMIN ALREADY PRESENT';
    sleep(2);
    header('location:userlogin.php');
}
}
}else{
$outMessageorError = 'Please select a file to upload.';
}
}
}
?>
