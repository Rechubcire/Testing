<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Username</h1>
            <br><br>
        
            <?php  
                $sql="SELECT * FROM login;";
                $res=mysqli_query($conn, $sql);
                if ($res==true)
                {
                    $count = mysqli_num_rows($res);
                    if ($count>=1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $username = $row['Username'];
                        $passwordLength=$row['passwordLength'];
                        $hashedPass=$row['Password'];
                    }
                    else{
                     
                        header('location:'.SITEURL.'admin/manage-account.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>New Username: </td>
                        <td> 
                            <input type="text" name="username" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td> 
                            <input type="password" name="password" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Save" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>    
    </div>
<section class="footer-bottom">
<?php include('partials/footer.php'); ?>
</section>

<?php

if(isset($_POST['submit']))
{
    $newUsername = $_POST['username'];
    if ($newUsername == null) {
        echo "Please enter a new Username";
    } else {
        $checkPass = md5($_POST['password']);
        if ($checkPass == $hashedPass) {
            $sql = "UPDATE login SET Username = '$newUsername';";
            $res = mysqli_query($conn, $sql) or die();
            if ($res = TRUE) {
                header("location:" . SITEURL . 'admin/manage-account.php');
            } else {
                echo "Failed to Change";
            }
        } else {
            echo "Wrong password";
        }
    }
}
?>