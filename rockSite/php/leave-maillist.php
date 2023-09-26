<?php include('partials/menu.php'); ?>
   <div class="center">
    <br><br><br><br><br><br>
    <h1>Leave Mailing List</h1>
    <br>
    <?php
        $id = $_GET['id'];
        $sql = "DELETE FROM `maillist` WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        if($res == true){
            echo "Successfully removed from mailing list";
        }
        else{
            echo "Error removing you from mailing list";
        }
    ?>
    

    <script>
        function homePg(){
            location.href = "home.php";
        }
    </script>
    <br><br><br>
    <button onclick="homePg()" class="btn-third">Go to Home Page</button><br>

    </div>

    <br><br><br>

<?php include('partials/footer.php'); ?>
