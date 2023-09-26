<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">

            <div class = "title"><h1>Active Promotions</h1></div>
            <br><br>

            <a href="add-promo.php" class= "btn-primary">New Promotion</a>
            
            <br><br>

            <table class= "tbl-full">
                <tr>
                    <th>Category</th>
                    <th>Featured Text</th>
                    <th>Discount</th>
                    <th>Manage</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM promotions ORDER BY featured DESC";
                    $res = mysqli_query($conn, $sql);
                    if ($res==TRUE){
                        $count = mysqli_num_rows($res);
                        if ($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id = $rows['id'];
                                $cate = $rows['category'];
                                $text = $rows['promo_text'];
                                $discount = $rows['percent_off'];
                                $feat = $rows['featured'];
                                ?>
                               
                                <tr <?php if($feat==1){echo 'style="background-color:#fcfaa9;"';}?>>
                                    <td width = "20%"><?php echo $cate?></td>
                                    <td width = "20%"><?php echo $text?></td>
                                    <td width = "20%"><?php echo round((float)$discount * 100 ) . '%';?></td>

                                    <td width = '20%'>
                                        <button onclick="editPromo(<?php echo $id;?>)" class="btn-secondary">Edit</button>
                                        <button onclick="featurePromo(<?php echo $id;?><?php if($feat==1){echo',0';}?>)" class="btn-<?php if($feat==1){ echo "third";}else{echo "secondary";}?>"><?php if($feat==1){echo "Unf";}else{echo "F";}?>eature</button>
                                        <button onclick="removePromo(<?php echo $id;?>)" class="btn-third">Remove</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<br>no promotions found";
                        }
                    }
                ?>
            </table>
            <script>
                function editPromo(id=0) {
                    location.href = "update-promo.php?id=" + id;
                }
                function featurePromo(id=0,feat=1) {
                    location.href = "feature-promo.php?id=" + id  + "&flipped=" + feat;
                }
                function removePromo(id=0) {
                    if (confirm("Are you sure you want to remove this promotion?") == true) {
                        location.href = "delete-promo.php?id=" + id;
                    }
                }
            </script>
        </div>
    </div>

<?php include('partials/footer.php'); ?>
