<?php
include '../config.php';
include 'user_headersidebar.php';
$get_book_id = $_GET['get_id'];
$user_id = $_SESSION['user_id'];
// if(isset($_GET['get_id'])){
// }else{
//    $get_id = '';
//    header('location:all_posts.php');
// }

if(isset($_POST['submit'])){

   $title = $_POST['title'];
   $description = $_POST['description'];
   $rating = $_POST['rating'];
   $update_review = mysqli_query($conn, "UPDATE `reviews` SET rating = '$rating', title = '$title', description = '$description' WHERE (user_id = '$user_id' AND book_id = '$get_book_id')") or die("Query failed");

   $success_msg[] = 'Review updated!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="user_update_review.css">

</head>
<body>

<!-- update reviews section starts  -->

<section class="account-form">

   <?php
      $select_review = mysqli_query($conn, "SELECT * FROM `reviews` WHERE id = $get_book_id LIMIT 1") or die("Query failed");
   if(mysqli_num_rows($select_review) > 0){
   while($fetch_review = mysqli_fetch_assoc($select_review)){
   ?>
   <form action="" method="post">
      <h3>edit your review</h3>
      <p class="placeholder">review title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box" value="<?= $fetch_review['title']; ?>">
      <p class="placeholder">review description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"><?= $fetch_review['description']; ?></textarea>
      <p class="placeholder">review rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="<?= $fetch_review['rating']; ?>"><?= $fetch_review['rating']; ?></option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="update review" name="submit" class="btn">
      <a href="user_view_post.php?get_id=<?= $fetch_review['book_id']; ?>" class="option-btn">go back</a>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">something went wrong!</p>';
      }
   ?>

</section>

<!-- update reviews section ends -->














<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="user_script.js"></script>

</body>
</html>