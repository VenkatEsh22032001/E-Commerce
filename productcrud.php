<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script src=
"https://code.jquery.com/jquery-3.6.0.min.js">
    </script>
     <style>
      .form{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 65px;
        background-color: #40916c;
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
        position: relative;
        left: 25px;
      }
    </style>
</head>
<body>
<div class="form">
<form action="" id="Ajax_form">
<label for="Name">Search Users</label>
<i class="fa-solid fa-magnifying-glass fa-beat-fade"></i>
    <input type="text" name="Name" id="inputId" placeholder="search users">
</form>
</div>
  <div id="Ajax">
    
  </div>

<script>
  $("#Ajax_form").keyup(function(e){
    e.preventDefault();
    $.ajax({
      url:'productssearch.php',
      type: 'POST',
      data:{name:$('#inputId').val()},
      success:function(response){
        $('#Ajax').html(response)
      }
    })
  })
</script>
  <a href="productcrudcreate.php"><button type="button" class="btn btn-primary">Add</button></a>
<table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Description</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Stock Status</th>
      <th scope="col">Product Price</th>
      <th scope="col">Product Quantity</th>
      <th scope="col">Product Crud</th>
    </tr>
  </thead>
  

</body>
</html>

<?php 
$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
$query = "SELECT * from `productstable`";

$ref = mysqli_query($conn,$query);
$count = 1;
echo '<tbody>';
while($w=mysqli_fetch_array($ref)){
    echo '<tr class="tablerow">
    <td class="align-middle">'.$w['Id'].'</td>
    <td class="align-middle">'.$w['productname'].'</td>
    <td class="align-middle">'.$w['productdescription'].'</td>
    <td class="align-middle"><img src="productimages/'.$w['productimage'].'" height="80px" width="80px"></td>
    <td class="align-middle">'.$w['productstock'].'</td>
    <td class="align-middle">'.$w['productprice'].'</td>
    <td class="align-middle">'.$w['productquantity'].'</td>
    <td class="align-middle"><a href="productcrudupdate.php?Id='.$w['Id'].'&productname='.$w['productname'].'&productdescription='.$w['productdescription'].'&productquantity='.$w['productquantity'].'&productprice='.$w['productprice'].'"><button type="button" class="btn btn-warning">Edit</button></a>
    <a href="deleteproduct.php?Id='.$w['Id'].'"><button type="button" class="btn btn-danger">Delete</button></a></td>
    </tr>';
    $count++;
}
 
echo '</tbody>
</table>'
?>