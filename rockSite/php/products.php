<?php include('partials/menu.php'); ?>
    <section>
    <br><br><br>
        <div class="center">
            <h2 style="margin-bottom:0px;">Shop</h2>
        </div>
    </section>
     <!--sidebar-->
    <section>
        <div class="side-sort">
            <b nowrap>Filter by Categories<br></b>
 
            <div class="items">
                    <?php   
                    $sql = "SELECT * FROM prod_types";
                    $res = mysqli_query($conn, $sql);
                    if ($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);
                        if ($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id = $rows['id'];
                                $type = $rows['type'];

                                ?>
                                    <a class="btn-sort" href="products.php?sort=<?php echo $type;?>"><?php echo $type; ?></a>
                                <?php
                                
                            }
                        }
                    }
                       ?>
                       <br>
                 
                        <a class="btn-sort" href="products.php">All</a>
                    
                        <br>
                        <form action="" method="POST">
                            <b style="padding-bottom:5px">Filter by Price Range<br></b>
                            <div class="center">
                                <label for="min-price" style="margin-right:10px;">Min:</label> <label for="max-price">Max:</label><br>
                                <input type="number" id="min-price" name="min-price" style="margin-right:10px;">
                                <input type="number" id="max-price" name="max-price"><br><br>
                                <input type="submit" class="btn-sort" name="range-submit" id="price-filter" value="Filter">
                            </div>
                        </form>
                        <?php
                    if(isset($_POST['range-submit']))
                    {
                        
                        $min = $_POST['min-price'];
                        $max = $_POST['max-price'];
                        
                        if($max==Null)
                        {
                            echo '<script>function jsFunction(){location.href = "products.php?sort-min-price='.$_POST['min-price'].'";}';
                            echo 'jsFunction();</script>';
                        }
                        if($min==Null)
                        {
                            echo '<script>function jsFunction(){location.href = "products.php?sort-max-price='.$_POST['max-price'].'";}';
                            echo 'jsFunction();</script>';
                        }
                        if(isset($_POST['min-price']) && isset($_POST['max-price']))
                        {
                            echo '<script>function jsFunction(){location.href = "products.php?sort-min-price='.$_POST['min-price'].'&sort-max-price='.$_POST['max-price'].'";}';
                            echo 'jsFunction();</script>';
                        }
                    }       
                        ?>
            </div>
        </div> 
    </section>
    <!--sidebar-->

    <!--products-->
    
<section style="padding-left:300px;">
    <?php 
        $sql = "SELECT * FROM products WHERE sold = 0";
        $res = mysqli_query($conn, $sql);
        if ($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            if ($count>0)
            {
                $counter = 0;
                while($rows=mysqli_fetch_assoc($res))
                {
                    $id = $rows['ID'];
                    $prod_name=$rows['Name'];
                    $prod_descr=$rows['Description'];
                    $image=$rows['imageFile'];
                    $price=number_format($rows['Price'], 2);


                    if(isset($_GET['sort'])){
                        $sorter = $_GET['sort'];
                        if($prod_descr != $sorter){
                            continue;
                        }
                    }
                    if(isset($_GET['sort-max-price'])){
                        $priceSorterMax = $_GET['sort-max-price'];
                        if($price > $priceSorterMax){
                            continue;
                        }
                    }
                    if(isset($_GET['sort-min-price'])){
                        $priceSorterMin = $_GET['sort-min-price'];
                        if($price < $priceSorterMin){
                            continue;
                        }
                    }

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
                        $price="$".$price;
                    }

                    $counter++;
                    ?>
                        <table class="pro-tbl" >
                            <tr><td style="text-align:center"><img src="<?php echo SITEURL;?>/images/<?php echo $image; ?>" alt="<?php echo $prod_descr;?>" height="250px" class="img-curve"></tr></td>
                            <tr><td style="text-align:center"><?php echo $prod_name;?></tr></td>
                            <tr><td style="text-align:center"><?php if(isset($saleText)){echo "<div class='on-sale' style='background-color:rgb(80,250,80)'>$saleText</div>";}else{echo "<br>";}?></tr></td>
                            <tr><td style="text-align:center"><?php echo $price;?></tr></td>
                            <tr><td style="text-align:center"><button onclick="sendOrder(<?php echo $id;?>)" class="btn-secondary">Order</button></tr></td>
                        </table>
                    <?php
                    unset($saleText);
                }
                if($counter == 0){
                    echo '<br><div class = "center">No Products Found</div>';
                }
            } else {
                echo '<br><div class = "center">No Products Found</div>';
            }
            
        }
    ?> 
</section>

        <script>
            function sendOrder(id=0) {
                location.href = "order.php?id=" + id;
            }
        </script>
<?php include('partials/footer.php'); ?>
