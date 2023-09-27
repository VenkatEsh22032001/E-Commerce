<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <table class="table">
    <thead>
        <tr>
        <th>orderId</th>
        <th>customerId</th>
        <th>orderDate</th>
        <th>shipperId</th>
        </tr>
    </thead>
  <tbody>
    <tr>
    <?php
     $conn = mysqli_connect('localhost','root','root','ecommerce_admin');
     $query = "SELECT * FROM `orders_table`";
     $sel = mysqli_query($conn,$query);
     for($i=0;$i<$sel->num_rows;$i++){
        $data=mysqli_fetch_array($sel);
    ?>
    <td><?php echo $data['orderId'] ?></td>
    <td><?php echo $data['customerId'] ?></td>
    <td><?php echo $data['orderDate']?></td>
    <td><?php echo $data['shipperId']?></td>
    </tr>
    <?php
     }
    ?> 
  </tbody>
    </table>
</body>
</html> 