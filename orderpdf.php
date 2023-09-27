<?php
session_start();
$orid=$_SESSION['orderid'];
?>

<!-- Font Awesome -->


<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
  rel="stylesheet"
/>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
></script>

<style>
    .gradient-custom-2 {
/* fallback for old browsers */
background: #a1c4fd;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
}

#progressbar-1 {
color: #455A64;
}

#progressbar-1 li {
list-style-type: none;
font-size: 13px;
width: 33.33%;
float: left;
position: relative;
}

#progressbar-1 #step1:before {
content: "1";
color: #fff;
width: 29px;
margin-left: 22px;
padding-left: 11px;
}

#progressbar-1 #step2:before {
content: "2";
color: #fff;
width: 29px;
}

#progressbar-1 #step3:before {
content: "3";
color: #fff;
width: 29px;
margin-right: 22px;
text-align: center;
}

#progressbar-1 li:before {
line-height: 29px;
display: block;
font-size: 12px;
background: #455A64;
border-radius: 50%;
margin: auto;
}

#progressbar-1 li:after {
content: '';
width: 121%;
height: 2px;
background: #455A64;
position: absolute;
left: 0%;
right: 0%;
top: 15px;
z-index: -1;
}

#progressbar-1 li:nth-child(2):after {
left: 50%
}

#progressbar-1 li:nth-child(1):after {
left: 25%;
width: 121%
}

#progressbar-1 li:nth-child(3):after {
left: 25%;
width: 50%;
}

#progressbar-1 li.active:before,
#progressbar-1 li.active:after {
background: #1266f1;
}

.card-stepper {
z-index: 0
}
</style>

<section class="vh-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-10 col-lg-8 col-xl-6">
        <div class="card card-stepper" style="border-radius: 16px;">
          <div class="card-header p-4">
            <div class="d-flex justify-content-between align-items-center">
                <?php
              $conn = mysqli_connect('localhost','root','root','ecommerce_admin');
              $orderquery = "SELECT * FROM `orders` where id=$orid";
              $order = mysqli_query($conn,$orderquery);
              $displayorder = mysqli_fetch_assoc($order);
            echo"
              <div>        
                <p class='text-muted mb-2'> Order ID <span class='fw-bold text-body'>$displayorder[id]</span></p>
                <p class='text-muted mb-0'> Place On <span class='fw-bold text-body'>$displayorder[order_date]</span> </p>
              </div>";
              ?>
              <div>
                <h6 class="mb-0"> <a href="#">View Details</a> </h6>
              </div>
            </div>
          </div>
          <?php
      $conn = mysqli_connect('localhost','root','root','ecommerce_admin');
      $userid = $_SESSION['Id'];
      $joinquery = "SELECT * FROM `cart` 
      INNER JOIN  productstable ON productstable.Id = cart.product_id
      INNER JOIN customers ON customers.Id = cart.user_id WHERE user_id='$userid'";
      $innerjoin = mysqli_query($conn,$joinquery);
      $total = 0;
     while($displaycart = mysqli_fetch_assoc($innerjoin)){
       
          $individual = ($displaycart['quantity']*$displaycart['productprice']);

          $total+=$individual;
           
       echo "
          <div class='card-body p-4'>
            <div class='d-flex flex-row mb-4 pb-2'>
              <div class='flex-fill'>
                <h5 class='bold'>$displaycart[productname]</h5>
                <p class='text-muted'> Qt:₹$displaycart[productprice]xNo's$displaycart[quantity]</ </p>
                <h4 class='mb-3'>₹$individual<span class='small text-muted'> via (COD) </span></h4>
                <p class='text-muted'>Tracking Status on: <span class='text-body'>11:30pm, Today</span></p>
              </div>
            </div>  <div>
            <img class='align-self-center img-fluid'
              src='productimages/$displaycart[productimage]' width='100'>
          </div>";
        }

       

        echo $total;
        // $total = $total + ($displaycart['quantity']*$displaycart['productprice']);
       
        ?>
            <!-- <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
              <li class="step0 active" id="step1"><span
                  style="margin-left: 22px; margin-top: 12px;">PLACED</span></li>
              <li class="step0 active text-center" id="step2"><span>SHIPPED</span></li>
              <li class="step0 text-muted text-end" id="step3"><span
                  style="margin-right: 22px;">DELIVERED</span></li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
  </div>

   <button onclick="down()" type="submit">Download_Pdf</button>
</section>

<script src="js/jsPDF/dist"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>




<script>
function down(){
window.jsPDF =window.jspdf.jsPDF;
let doc= new jsPDF();
let elementHTML = document.body;
doc.html(elementHTML, {
callback: function(doc){
doc.save('orders.pdf');
},
x:15,
y:15,
width:170,
windowWidth:650
});
}
</script>