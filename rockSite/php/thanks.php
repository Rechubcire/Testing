<?php include('partials/menu.php'); ?>
   <div class="center">
    <br><br><br><br><br><br>
    <h2>Thanks for Ordering!</h2>
    <p>Check your email for your order receipt</p>
    <br><br>

    <script>
        function homePg(){
            location.href = "home.php";
        }
    </script>


    <button onclick="homePg()" class="btn-secondary">Back to Home Page</button><br>
    </div>
    <br><br><br>
   <?php include('partials/footer.php'); ?>