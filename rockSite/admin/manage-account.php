<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <div class = "title"><h1>Manage Account</h1></div>
        <?php 
               
            $sql = "SELECT * FROM login"; //get account info
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $row=mysqli_fetch_assoc($res);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    $username = $row['Username'];
                    $passwordLength = $row['passwordLength'];
                }
            }

            $sql = "SELECT * FROM about"; //get about info 
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $row=mysqli_fetch_assoc($res);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    $oldAbout = $row['about'];
                }
            }
            
            ?>

            <br><br>
            <table class= "tbl-full"> <!--username/password info-->
                <tr>
                    <td>Username:</td>
                    <td><?php echo $username;?></td>
                    <td>
                        <a href="change-username.php" class="btn-primary">Change Username</a>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <?php for ( //make the number of dots as password length, so we dont know the password
                        $x = 0;
                        $x < $passwordLength;
                        $x++
                    ) {
                        echo "●";
                    }?>
                    </td>
                    <td>
                        <a href="change-password.php" class="btn-primary">Change Password</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button onclick="logOut()" class="btn-secondary">Log Out</button>
                    </td>
                </tr>
            </table>
            <br><br><br>

            <script>
                function logOut(){ //logout button
                    location.href = "login.php";
                }
            </script>

            
            
            <form action="" method="POST" enctype="multipart/form-data"> <!--Update About Me Text-->
                <table class="tbl-30">
                    <tr>
                        <td nowrap>About Me:</td> <!--nowrap makes it one line-->
                        <td> 
                            <textarea style="padding:3px" id="about" name="about" cols="80" rows="10"><?php echo $oldAbout;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Update About" class="btn-secondary">
                        </td>
                    </tr>
                </table>
                <pre style="font-size: 14px">(Supports use of html tags, i.e. &lt;b>*bold text*&lt;/b> and &lt;u>*underlined text*&lt;/u>)</pre>
                <!--pre and &lt; to write html code as text-->
            </form>
            <?php 
            if(isset($_SESSION['aboutIn']))
                {
                    echo '<br>About Updated';
                    unset($_SESSION['aboutIn']);
                }
            ?>
            <?php
            if(isset($_POST['submit']))
            {
                $about = $_POST['about'];
                $sql = "UPDATE about SET about = '$about' WHERE id = 1;";
                $res = mysqli_query($conn, $sql) or die();
                if ($res = TRUE)
                {
                    $_SESSION['aboutIn'] = "1";
                    echo '<script>function jsFunction(){location.href = "manage-account.php";}';
                    echo 'jsFunction();</script>';
                }
                else{
                    echo "Failed to Update";
                }
            }
            ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
