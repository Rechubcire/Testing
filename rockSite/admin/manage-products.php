<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">

            <div class = "title"><h1>Manage Products</h1></div>
            <br>

            <?php
                if(isset($_SESSION['add']))
                {
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    unset($_SESSION['delete']);
                }
            ?>
            <br><br>
            <a href="add-product.php" class= "btn-primary">Add Product</a>
            
            <br><br>

            <table class ="tbl-full">
                <tr>
                    <th width = '20%'>Product Image</th>
                    <th width = '10%'>Product Name</th>
                    <th width = '10%'>Product Category</th>
                    <th width = '10%'>Price</th>
                    <th width = '10%'>Featured</th>
                    <th width = '10%'>Sold</th>
                    <th width = '20%'>Actions</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM products";
                    $res = mysqli_query($conn, $sql);
                    if ($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);
                        if ($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id = $rows['ID'];
                                $prod_name=$rows['Name'];
                                $prod_descr=$rows['Description'];
                                $image=$rows['imageFile'];
                                $price=number_format($rows['Price'], 2);
                                $featured = $rows['featured'];
                                $sold = $rows['sold'];
                                ?>
                               
                                <tr>
                                    <td width = "20%"><img src="<?php echo SITEURL;?>/images/<?php echo $image; ?>" class="img-curve" alt="<?php echo $prod_descr; ?>" width = "90%"></td>

                                    <td><?php echo $prod_name;?></td>

                                    <td><?php echo $prod_descr;?></td>

                                    <td> $<?php echo $price;?></td>

                                    <td><?php if ($featured == 1) {
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }?></td>

                                    <td><?php if ($sold == 1) {
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }?></td>

                                    <td width = '20%'>
                                        <button onclick="updateProd(<?php echo $id;?>)" class="btn-secondary" style="width: 80%">Update</button><br>
                                        <button onclick="removeProd(<?php echo $id;?>)" class="btn-third" style="width: 80%">Remove</button><br>
                                        <button onclick="setFeatured(<?php echo $id;?>,<?php echo $featured;?>)" class="<?php if($featured){ echo "btn-third";} else{echo "btn-secondary";}?>" style="width: 80%"><?php if ($featured == 1) {
                                        echo "Unf";
                                    } else {
                                        echo "F";
                                    }?>eature</button>
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
                function removeProd(id=0) {
                    if (confirm("Are you sure you want to delete this product?") == true) {
                        location.href = "delete-product.php?id=" + id;
                    }
                }
                function updateProd(id=0) {
                    location.href = "update-product.php?id=" + id;
                }
                function setFeatured(id=0, feat=0) {
                    location.href = "feature-product.php?id=" + id + "&feat=" + feat;
                }
            </script>
        </div>
    </div>

<?php include('partials/footer.php'); ?>

