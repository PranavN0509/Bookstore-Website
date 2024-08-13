<?php
   include '../config.php';
   include 'user_headersidebar.php';
   $user_id = $_SESSION['user_id']; 

   if(!isset($user_id))
   {
      header('location: ../LoginPage/loginform.php');
   }

   $user_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$user_id'") or die('query failed');
   $users_selected = mysqli_fetch_assoc($user_query);

   if(isset($_POST['submit'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
      $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
      $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
      $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
      $image = $_FILES['image']['name'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $old_image = $users_selected['image'];
      $image_Update_folder = 'Userimages/'.$image;


      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$user_id'") or die('query failed');
      $row = mysqli_fetch_assoc($select_users);
      if(($row['password'] == $old_pass) && ($new_pass==$cpass)){
         mysqli_query($conn, "UPDATE `users` SET name='$name', email='$email', password='$new_pass', phonenumber='$phonenumber', image = '$image_Update_folder' WHERE id='$user_id'") or die('query failed');

         move_uploaded_file($image_tmp_name, $image_Update_folder);
         unlink($old_image);
      }
      else if($row['password'] != $old_pass){
         $message = 'Old password entered wrong';
      }
      else if($cpass != $new_pass){
         $message = 'New password not equal to confirm password';
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="user_profileupdate.css">
   <link rel="icon" type="image/x-icon" href="./Images/favicon.ico">

</head>
<body>

<?php
?>

<?php
   
?>

<!-- register section starts  -->

<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form class="register" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <div class="flex">
         <div class="col">
            <p>your name </p>
            <input type="text" name="name" placeholder="<?= $users_selected['name']; ?>" maxlength="200"  class="box">
            <p>your email </p>
            <input type="email" name="email" placeholder="<?= $users_selected['email']; ?>" maxlength="20"  class="box">
            <p>Your Number</p>
            <input class="box" name="phonenumber" placeholder="<?= $users_selected['phonenumber']; ?>" maxlength="10" minlength="10">
            
         </div>
         <div class="col">
            <p>Old password :</p>
            <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"  class="box">
            <p>New password :</p>
            <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box">
            <p>Confirm password :</p>
            <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box">
         </div>
      </div>
      <p>update pic :</p>
      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" name="submit" value="update now" class="btn">
   </form>
</section>

<!-- register section ends -->



<script src="user_script.js"></script>
   
</body>
</html>