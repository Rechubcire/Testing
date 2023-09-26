<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>
        
            <?php 
                $id=$_GET['id'];

                $sql="SELECT * FROM prod_types WHERE id = $id";

                $res=mysqli_query($conn, $sql);

                if ($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if ($count>=1)
                    {
                        $row=mysqli_fetch_assoc($res);

                        $id = $row['id'];
                        $type=$row['type'];
                        $oldType = $row['type'];
                    }
                    else{
                        header('location:'.SITEURL.'admin/manage-types.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>New Category: </td>
                        <td> 
                            <input type="text" name="type" value="<?php echo $type?>">
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

    $type = $_POST['type'];
    
    $sql = "UPDATE prod_types SET type = '$type' WHERE id = $id;";

    $res = mysqli_query($conn, $sql) or die();

    $sql = "UPDATE products SET Description = '$type' WHERE Description = '$oldType';";

    $res = mysqli_query($conn, $sql) or die();

    if ($res = TRUE)
    {
        header("location:".SITEURL.'admin/manage-types.php');
    }
    else{
        echo "Failed to Insert Data";
    }

}
?>