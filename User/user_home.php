<?php
include '../config.php';
include 'user_headersidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link -->

    <link rel="stylesheet" href="user_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kitfontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>User Home</title>
</head>
<body>

<section class="Home">

   <div class="bookslider">
      <div class="images">
         <img src="./Carouselimages/1.jpg" alt="">
         <img src="./Carouselimages/2.jpg" alt="">
         <img src="./Carouselimages/3.jpg" alt="">
         <img src="./Carouselimages/4.jpg" alt="">
         <img src="./Carouselimages/5.jpg" alt="">
      </div>
      <div onclick="side_slide(-1)" class="slide left">
         <span class="fa-solid fa-angles-left"></span>
      </div>
      <div onclick="side_slide(1)" class="slide right">
         <span class="fa-solid fa-angles-right"></span>
      </div>
      <div class="butn-sliders">
         <span onclick="butn_slide(1)"></span>
         <span onclick="butn_slide(2)"></span>
         <span onclick="butn_slide(3)"></span>
         <span onclick="butn_slide(4)"></span>
         <span onclick="butn_slide(5)"></span>
      </div>
   </div>


   <div class="content">
      <h2>Hand Picked Book to Your Door</h2>
      <!-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam pariatur nulla, eos obcaecati rem id! Odio corrupti nisi et fugit minus sapiente. Dolores architecto atque libero qui aspernatur, ea doloremque.</p> -->
      <a href="user_shop.php">Get started</a>
   </div>
</section>
     
<?php
   include 'user_footer.php';
?>
    
</body>
<script src="user_script.js"></script>
</html>