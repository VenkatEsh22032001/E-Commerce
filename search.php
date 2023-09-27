<?php 
$conn = mysqli_connect('localhost','root','root','ecommerce_admin');
$r = $_POST['name'];
$qr = "SELECT * FROM `customers` 
         WHERE Name LIKE '$r%'";

$e = mysqli_query($conn,$qr);
if(!($r==null)){
echo '<table class="table">
<thead>
    <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phonenumber</th>
    <th>Password</th>
    <th>Profile</th>
    <th>User Crud</th>
    </tr>
</thead>
<tbody>';
while($data = mysqli_fetch_array($e)){
    echo 
    "<tr>
    <td>$data[Id]</td>
    <td> $data[name]</td>
    <td> $data[email]</td>
    <td> $data[phonenumber]</td>
    <td> $data[password]</td>
    <td><img src='userimages/$data[profile]' style='height:100px;width:100pxs'></td>
    <td class='align-middle'><a href='usercrudupdate.php?Id=$data[Id]&name=$data[name]&email=$data[email]&phonenumber=$data[phonenumber]&password=$data[password]'><button type='button' class='btn btn-warning'>Edit</button></a>
    <a href='deleteuser.php?Id=$data[Id]'><button type='button'class='btn btn-danger'>Delete</button></a></td>
    </tr>
    ";
}
}
echo"</tbody>
</table>"
?>
