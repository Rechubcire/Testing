<?php include('partials/menu.php'); ?>
   <div class="center">
    <br><br><br><br><br><br>
    <h1>Join Update Mailing List!</h1>
    <br>
    <p>Get updated whenever new products are posted or newletters come out.<p>
    
    <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="info-tbl">
            <tr style="padding-bottom:20px">
                <td>Email:  </td>
                <td> 
                    <input type="text" name="Email" placeholder="Email Address Here" size="40">
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Join Mailing List" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $email = $_POST['Email'];
            $sql = "SELECT * FROM `mailList`";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $found = false;
            $loop = 0;
           
            while($rows=mysqli_fetch_assoc($res)){
                if($found){
                    break;
                }
                if($rows['email'] == $email){
                    $found = true;
                }
                $loop++;
            }
            if($found){
                echo "<br>Sorry, Email already on mailing list";
            }
            else{
                $sql = "INSERT INTO `mailList` (`id`, `email`) VALUES (NULL, '$email')";
                $res = mysqli_query($conn, $sql);
                echo "<br>Thank you for joining the mailing list!";
            }
        
        }
    ?>

    <script>
        function homePg(){
            location.href = "home.php";
        }
    </script>
    <br><br><br>
    <button onclick="homePg()" class="btn-third">Back to Home Page</button><br>

    </div>

    <br><br><br>

<?php include('partials/footer.php'); ?>