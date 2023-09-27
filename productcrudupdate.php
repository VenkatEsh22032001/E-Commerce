<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.head{
  display: flex;
  justify-content: center;
}
.main{
    display: flex;
    justify-content: center;
    height: 100vh;
}
.container{
        display: flex;
        justify-content: center;
        align-items: center;
        /* text-align: center; */
        border-radius: 50px;
        height: 650x;
        width: 500px;
        background-color: #abff4f;
}
.switch{
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
/* Hide default HTML checkbox */
.switch input{
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider{
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before{
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider{
  background-color: #2196F3;
}

input:focus + .slider{
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before{
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round{
  border-radius: 34px;
}

.slider.round:before{
  border-radius: 50%;
}
#submit{
    margin-left: 60px;
    margin-top: 10px;
}
    </style>
</head>
<body>

 <div class="head"> <h1>Update Product</h1></div>
<div class="main">
    <div class="container">
    <form  method="post" enctype="multipart/form-data">
        <div class="productid"><h3>Product Id</h3><input type="text" name="productid" class="productid"
            placeholder="ProductID" value="<?php echo $_GET['Id'];?>">
        </div>
        <div class="productname"><h3>Product Name</h3><input type="text" name="productname" class="productname"
            placeholder="Product Name" value="<?php echo $_GET['productname'];?>">
        </div>
        <div class="productdescription"><h3>Product Description</h3>
            <textarea name="productdescription" class="productdescription" cols="30" rows="5" value="<?php echo $_GET['productdescription'];?>"><?php echo $_GET['productdescription'];?></textarea>
        </div>
        <div class="upload"><h3>Product Image</h3><input type="file" name="productimage" id="" value="">
         </div>
        <div class="stockstatus"><h3>Stock Status</h3><label class="switch">
            <input type="checkbox" name="check" value=""><span class="slider round"></span></label>
        </div>
        <div class="productquantity"><h3>Product Quantity</h3>
            <input type="text" class="productquantity" name="productquantity" placeholder="Product Quantity" value="<?php echo $_GET['productquantity'];?>">
        </div>
        <div class="productprice"><h3>Product Price</h3>
             <input type="text" class="productprice" name="productprice" id="" placeholder="Product Price" value="<?php echo $_GET['productprice'];?>">
        </div>
        <div class="button">
            <input type="submit" name="submit" value="submit" id="submit">
        </div>
    </form>
    </div>
</div>
</body>
</html>
<?php 

$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
$outMessageorError = '';

$targetDir = "productimages/";

if(isset($_POST["submit"])){
    echo 'hello';
    $productname = $_POST['productname'];
    $productdesc = $_POST['productdescription'];
    $id = $_GET['Id'];
    if(isset($_POST['check'])){
        $productstock = "TRUE";
    }else{
        $productstock = "FALSE";
    }
    $productprice = $_POST['productprice'];
    $productquantity = $_POST['productquantity'];

    if(!empty($_FILES["productimage"]["name"])){
        // echo 'great';
        $fileName = rand(1000,10000)."-".$_FILES["productimage"]["name"];
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, array('jpg','png','jpeg','gif'))){
        // echo 'Shiva';
        if(move_uploaded_file($_FILES["productimage"]["tmp_name"], $targetFilePath)){
          
            $q="UPDATE `productstable` SET `productname`='$productname',`productdescription`='$productdesc',`productimage`='$fileName',`productstock`='$productstock',`productprice`='$productprice',`productquantity`='$productquantity' WHERE `Id`=$id";
           $insert= mysqli_query($conn,$q);
            
        if($insert){
        echo "Iam update";
        $outMessageorError = "The file ".$fileName. " has been uploaded successfully.";
        header('location:productcrud.php');
        }else{
        $outMessageorError = "Image cant be uploaded";
        }
    }else{
    $outMessageorError = "Some error";
    }
    }else{
    $outMessageorError = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    }else{
    $outMessageorError = 'Please select a file to upload.';
    }
}

echo$outMessageorError;
?>
