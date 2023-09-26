<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">

            <div class = "title"><h1>Manage Orders</h1></div>
            <br>
            <button onclick="filterPend()" class="btn-secondary"><?php if(isset($_SESSION['orderSearch'])){echo "Show All";}else{echo "Show Pending";}?></button>
            
            <table class= "tbl-full">
                <tr>
                    <th>Item</th>
                    <th width = "10%">Status</th>
                    <th>Customer Name</th>
                    <th>Shipping Address</th>
                    <th>Customer Email</th>
                    <th>Time of Order</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM orders INNER JOIN products ON orders.prod_id=products.ID ";

                    if(isset($_SESSION['orderSearch'])){ //filter by pending
                        $sql .=  "WHERE status = 'Pending' ";
                    }

                    $sql .= "ORDER BY order_id desc;";
                    $res = mysqli_query($conn, $sql);
                    if ($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);
                        if ($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id = $rows['order_id'];
                                $status=$rows['status'];
                                $custName=$rows['customer_first']." ".$rows['customer_last'];
                                $image=$rows['imageFile'];
                                $address=$rows['customer_address'];;
                                $email = $rows['customer_email'];
                                $time = $rows['time'];
                                ?>
                               
                                <tr>
                                    <td width = "20%"><img src="<?php echo SITEURL;?>/images/<?php echo $image; ?>" alt="<?php echo $prod_descr; ?>" width = "90%"></td>
                                    <td><?php echo $status;?></td>
                                    <td><?php echo $custName;?></td>
                                    <td><?php echo $address;?></td>
                                    <td><?php echo $email?></td>
                                    <td><?php echo $time?></td>
                                    <td width = '20%'>
                                        <button onclick="setStatus(<?php echo $id;?>,'<?php echo $status;?>')" class=<?php if($status == "Pending"){echo "btn-secondary";}else{echo "btn-third";} ?>><?php if ($status == "Pending") {
                                            echo "M";
                                        } else {
                                            echo "Unm";
                                        }?>ark as Complete</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr>no data found</tr>";
                        }
                    }
                ?>
            </table>
            <script>
                function setStatus(id=0, status = "Pending") {
                    location.href = "order-status.php?id=" + id + "&status=" + status;
                }
                
                function filterPend() {
                    location.href = "filter-order.php";
                }
            </script>
        </div>
    </div>

<?php include('partials/footer.php'); ?>

