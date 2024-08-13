<?php

include '../config.php';
include 'user_headersidebar.php';
$user_id = $_SESSION['user_id'];
$get_book_id = $_GET['get_id'];
// if(isset($_GET['get_id'])){
// }else{
//    $get_id = '';
//    header('location:all_posts.php');
// }

if(isset($_POST['submit'])){

   if($user_id != ''){

      // $id = random_int(0,999999999999);
      $title = $_POST['title'];
      $description = $_POST['description'];
      $rating = $_POST['rating'];
      $verify_review = mysqli_query($conn, "SELECT * FROM `reviews` WHERE book_id = $get_book_id AND user_id = $user_id") or die("Query failed");

      if(mysqli_num_rows($verify_review) > 0){
         $warning_msg[] = 'Your review already added!';
      }else{
         $add_review = mysqli_query($conn, "INSERT INTO `reviews`(book_id, user_id, rating, title, description) VALUES('$get_book_id','$user_id','$rating','$title','$description')") or die("Query failed");
         $success_msg[] = 'Review added!';
      }

   }else{
      $warning_msg[] = 'Please login first!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="user_add_review.css">

</head>
<body>

<!-- add review section starts  -->

<section class="account-form">

   <form action="" method="post">
      <h3>post your review</h3>
      <p class="placeholder">review title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box">
      <p class="placeholder">review description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
      <p class="placeholder">review rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="submit review" name="submit" class="btn">
      <a href="user_view_post.php?get_id=<?= $get_book_id; ?>" class="option-btn">go back</a>
   </form>
   
</section>

<!-- add review section ends -->


<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- custom js file link  -->
<script src="user_script.js"></script>

</body>
</html>