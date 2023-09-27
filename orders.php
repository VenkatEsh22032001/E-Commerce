<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="orders.php" method="post">
        <input type="number" name="orderid" placeholder="orderid">
        <input type="number" name="customerid" placeholder="customerId">
        <input type="date" name="orderdate" placeholder="order-date">
        <input type="number" name="shipperid" placeholder="shipper-id">
        <button type="submit" name="sub">Click</button>
    </form>
    <?php 
    $conn = mysqli_connect('localhost','root','root','ecommerce_admin');
    if($conn){
        echo 'connected successfully';
    }else{
        echo 'connectivity issue';
    }
    if(isset($_POST['sub'])){
        $order_id = $_POST['orderid'];
        $customer_id = $_POST['customerid'];
        $order_date = $_POST['orderdate'];
        $shipper_id = $_POST['shipperid'];
        $insert_query = "INSERT INTO orders_table(orderId,customerId,orderDate,shipperId)
                         VALUES('$order_id','$customer_id','$order_date','$shipper_id')";
        mysqli_query($conn,$insert_query);
        header('location:vieworderstable.php');
        echo 'value inserted successfully';
    }else{
        echo 'debug the error';
    }

    ?>
    
</body>
</html>