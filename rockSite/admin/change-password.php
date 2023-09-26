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
                        <td>Old Password: </td>
                        <td> 
                            <input type="password" name="oldPass" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password: </td>
                        <td> 
                            <input type="password" name="newPass" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Retype New Password: </td>
                        <td> 
                            <input type="password" name="newPass2" value="">
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
    if($_POST['newPass'] == null){
        echo "Please enter a new password";
    } else {
        $oldPass = md5($_POST['oldPass']);
        $passLen = strlen($_POST['newPass']);
        $newPass = md5($_POST['newPass']);
        $newPass2 = md5($_POST['newPass2']);
        if ($newPass == $newPass2) {
            if ($oldPass == $hashedPass) {
                $sql = "UPDATE login SET Password = '$newPass', passwordLength = '$passLen';";
                $res = mysqli_query($conn, $sql) or die();
                if ($res = TRUE) {
                    header("location:" . SITEURL . 'admin/manage-account.php');
                } else {
                    echo "Failed to Change";
                }
            } else {
                echo "Wrong password";
            }
        } else {
            echo "Passwords must match";
        }
    }
}
?>