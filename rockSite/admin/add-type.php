<?php include('partials/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Category: </td>
                        <td> 
                            <input type="text" name="type" placeholder="Category Name">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add" class="btn-secondary">
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
    $sql = "INSERT INTO `prod_types` (`id`, `type`) VALUES (NULL, '$type')";;
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