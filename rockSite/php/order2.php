<?php include('partials/menu.php'); ?>

    <br><br><br><br><br><br>
    <?php 
    $id =  $_GET['prod_id'];
    $sql = "SELECT * FROM products WHERE ID = '$id';";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        $rows = mysqli_fetch_assoc($res);
            $id = $rows['ID'];
            $image=$rows['imageFile'];
            $prod_descr=$rows['Description'];
            $price=number_format($rows['Price'], 2);
            $pricePal=number_format($rows['Price'], 2);
            $sql2 = "SELECT * FROM promotions WHERE category = '$prod_descr'"; //check for sales
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2>0){
                $rows2 = mysqli_fetch_assoc($res2);
                $perc = $rows2['percent_off'];
                $sale = $perc*100;

                $saleText = "Save ".$sale."%";
                $price="<strike style='font-size:16px'>$".number_format(($price/(1-$perc)),2)."</strike> $$price";
            }
            else{
                $price = "$".$price;
            }
            
            ?>
            <div class="center">

                <h1>ORDER ITEM</h1>
                <img src="<?php echo SITEURL;?>/images/<?php echo $image; ?>" alt="<?php echo $prod_descr; ?>" width = "20%" class="img-curve">
                <h3><?php echo $price; ?></h3>

                <p>Please review your information before ordering:</p>
                
                <br>
                
                <p><u>Name:</u> <?php echo $_GET['fname'];?> <?php echo $_GET['lname'];?></p>
                <p><u>Email:</u> <?php echo $_GET['email'];?></p>
                <p><u>Address:</u><br><?php echo $_GET['address1'];?><br>
                    <?php if($_GET['address2'] != ""){echo $_GET['address2'];echo "<br>";}?>
                    <?php echo $_GET['address3'];?><br>
                    <?php echo $_GET['address4'];?>
                </p>
            </div>
        <?php
    }
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $email = $_GET['email'];
        $address1 = $_GET['address1'];
        $address2 = $_GET['address2'];
        $address3 = $_GET['address3'];
        $address4 = $_GET['address4'];

        $vars = "?prod_id=$id&fname=$fname&lname=$lname&email=$email&address1=$address1&address2=$address2&address3=$address3&address4=$address4";      
    ?>

    <!--paypal stuff-->
    <div id="smart-button-container">
      <div style="text-align: center; ">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'blue',
          layout: 'vertical',
          label: 'paypal',
          
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value": <?php echo $pricePal;?>}}]
          });

          sendOrder();
          
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();

    </script>

    <script>
        function sendOrder(){
            location.href = "send-order.php<?php echo $vars?>";
        }
        function back(){
            location.href = "products.php";
        }
    </script>
      <div class ="center">         
          <button class="btn-third" style="padding: 3px" onclick="back()" colspan="2">Cancel Order</button>
      </div>
        <br><br><br>
      <div class="center"> <!-- this is temporary -->
            <button onclick="sendOrder()" class="btn-secondary">Temp Order Button</button><br>
      </div>

<?php include('partials/footer.php');?>

