<?php include('partials/menu.php'); ?>
<br>
    <!--About Info Starts-->
    
   <section>
        <br><br>
        <h2 style="text-align:center">About</h2>
        <?php 
               $sql = "SELECT * FROM about"; //get about from database
               $res = mysqli_query($conn, $sql);
               if ($res == TRUE) {
                   $row=mysqli_fetch_assoc($res);
                   $count = mysqli_num_rows($res);
                   if ($count > 0) {
                       $about = $row['about'];
                   }
               }
               ?>
        <table style="width:100%">
            <tr>
                <td>
                    <div class="about-text">
                        <?php echo $about?>
                    </div>
                </td>
                <td  style="padding-right:5%">
                    <div>
                        <img src="../images/PPRock Dudes.webp" alt="Owner's Profile Picture" class="img-respond" style="float: right;" >
                    </div>
                </td>
            </tr>
        </table>
        <div class="center" style="font-size:5vh"><b>Links to Socials:</b></div>
        <table style="width: 100%; padding-left:35.75%;  padding-right:33%">
            <tr>
                <td>
                    <a href="https://www.facebook.com/Peacelovedots/">
                        <div>
                            <span class="socials socials-fb" role="img" aria-label="Link to Facebook"> </span>
                        </div>
                    </a>
                </td>
                <td>
                    <a href="https://www.instagram.com/peacelovedots/">
                        <div>
                            <span class="socials socials-ig" role="img" aria-label="Link to Instagram"> </span>
                        </div>
                    </a>
                </td> 
                <td>
                    <a href="http://tiktok.com/@peacelovedots">
                        <div>
                            <span class="socials socials-tt" role="img" aria-label="Link to TikTok"> </span>
                        </div>
                    </a>
                </td> 
                <td>
                    <a href="http://www.pinterest.com/amykk727">
                        <div>
                            <span class="socials socials-pi" role="img" aria-label="Link to Pinterest"> </span>
                        </div>
                    </a>
                </td>    
            </tr>
        </table>
        <!--About Info Ends-->
    </section>
    
   <?php include('partials/footer.php'); ?>