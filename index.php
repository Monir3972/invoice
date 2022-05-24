<?php  
  $con  = mysqli_connect('localhost','root','','invoice');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">
      <div class="card p-3 rounded-0">
        <div class="card-body">
          <div class="col-md-3 mx-auto">
            <h2 class="text-center">Create Order</h2>
          </div>
           
          <form action="" method="POST">         
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                  $sql = mysqli_query($con,"SELECT * FROM products");
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                  <td><?php echo $row['name'] ?></td>
                  <td class="price"><?php echo $row['price'] ?></td>
                  <td>
                    <input type="number" min="0"  value="0" class="quantity" name="quantity[]">
                    <input type="hidden" min="0"  value="<?php echo $row['id'] ?>" name="product_id[]">
                  </td>
                  <td class="tot_price">0</td>
                </tr>
              <?php } ?>
              </tbody>
              <tfoot>
                  <tr>
                      <td></td>
                      <td></td>
                      <td>In Total</td>
                      <td id="in_total">0</td>
                  </tr>
              </tfoot>
            </table>
             <button type="submit" class="btn btn-success btn-sm" name="submit">Order</button>
          </form>
        </div>
      </div>
    </div>
  </div>
 

   <div class="container mt-5">
     <div class="row">
       <div class="card p-3 rounded-0">
         <div class="card-body">
            <table class="table mt-4">
             <h2 class="text-center">List Order</h2>
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                <?php  

                  $sql = mysqli_query($con,"SELECT * FROM orders GROUP BY rand ORDER BY id DESC");
                    while($row = mysqli_fetch_assoc($sql)){
                      $rand = $row['rand'];
                ?>
                <tr>
                  <td><?php echo $row['rand'] ?></td>
                  <td><?php echo $row['inserted'] ?></td>
                  <td>


                    <table class="table mt-4">
                      <thead>
                        <tr>
                          <th>Products</th>
                          <th>Quantity</th>
                          <th>Rate</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $sumTotal = 0;
                          $sql1 = mysqli_query($con,"SELECT * FROM orders WHERE rand = $rand");
                            while($row2 = mysqli_fetch_assoc($sql1)){
                              $product_id = $row2['product_id'];

                              $pro = mysqli_fetch_assoc(mysqli_query($con,"SELECT name,price from products WHERE id = '$product_id'"));

                              $total = $row2['quantity'] * $pro['price'];

                              $sumTotal += $total;
                        ?>
                        <tr>
                          <td><?php echo $pro['name'] ?></td>
                          <td><?php echo $row2['quantity'] ?></td>
                          <td><?php echo $pro['price'] ?></td>
                          <td><?php echo number_format($total,2) ?></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td></td>
                              <td></td>
                              <td>Sub Total</td>
                              <td><?php echo number_format($sumTotal,2) ?></td>
                          </tr>
                      </tfoot>
                    </table>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-sm float-end">Print</button>
         </div>
       </div>

     </div>
   </div>
</div>
</body>
</html>


<script>
  $('.quantity').change(function() {
    var in_total = 0;
    
    var row = $(this).closest('tr');
    var price = Number(row.find('.price').text());
    var quantity = Number(row.find('.quantity').val());
    // alert(quantity);
    var tot_price = quantity * price;
    row.find('.tot_price').text(tot_price);
    in_total += tot_price;
    row.siblings().each(function() {
        in_total += Number($(this).find('.tot_price').text());
    });   
    $('#in_total').text(in_total);
});
</script>

<?php  
  if(isset($_POST['submit'])){
    $rand = mt_rand();
    $product_id = count($_POST["product_id"]);  
   if($product_id > 0)  
   {  
        for($i=0; $i<$product_id; $i++)  
        {  
             if(trim($_POST["product_id"][$i] != ''))  
             {  
                  $pro_id = $_POST["product_id"][$i];
                  $quantity = $_POST["quantity"][$i];
                  if($quantity != '0'){
                    $sql = "INSERT INTO orders (product_id,quantity,rand) VALUES('$pro_id','$quantity','$rand')";  
                    mysqli_query($con, $sql);  
                  }  
             }  
        }

        echo "Data Inserted";  
        echo "<script>window.location.href = 'index.php';</script>";
   }  
   else  
   {  
        echo "Please Enter A Quantity";  
   }  
 }  
 ?>