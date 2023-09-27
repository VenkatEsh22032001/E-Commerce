<?php
$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
$r = $_POST['name'];

$qr = "SELECT * FROM `productstable` 
         WHERE productname LIKE '$r%'";

$e = mysqli_query($conn,$qr);
if(!($r==null)){
echo '<table class="table">
<thead>
    <tr>
    <th>Id</th>
    <th>Product Name</th>
    <th>Product Description</th>
    <th>Product Stock Status</th>
    <th>Product Price</th>
    <th>Product Quantity</th>
    <th>Product Image</th>
    <th>Product Crud</th>
    </tr>
</thead>
<tbody>';
while($data = mysqli_fetch_array($e)){
    echo 
    "<tr>
    <td>$data[Id]</td>
    <td> $data[productname]</td>
    <td> $data[productdescription]</td>
    <td> $data[productimage]</td>
    <td> $data[productstock]</td>
    <td> $data[productprice]</td>
    <td> $data[productquantity]</td>
    <td><img src='productimages/$data[productimage]' style='height:100px;width:100pxs'></td>
    <td class='align-middle'><a href='productcrudupdate.php?Id=$data[Id]&productname=$data[productname]&productdescription=$data[productdescription]&productquantity=$data[productquantity]&productprice=$data[productprice]'><button type='button' class='btn btn-warning'>Edit</button></a>
    <a href='deleteproduct.php?Id=$data[Id]'><button type='button'class='btn btn-danger'>Delete</button></a></td>
    </tr>
    ";
}
}
echo"</tbody>
</table>"
?>