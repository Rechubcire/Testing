    <?php
        $sql = "SELECT * FROM promotions WHERE featured = 1";
        $res = mysqli_query($conn, $sql);
        if ($res==TRUE){
            $count = mysqli_num_rows($res);
            if ($count>0){
                $row=mysqli_fetch_assoc($res);
                $cate = $row['category'];
                $text = $row['promo_text'];
                $discount = round((float)$row['percent_off'] * 100 ) . '%';
                ?>
                    <div class="promobar">
                        <p><?php echo $text?><br></p>
                    </div>
                <?php
            }
        }
    ?>
    