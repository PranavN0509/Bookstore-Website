<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_headerstyle.css">
    <title>Admin Header</title>
</head>
<body>
<header class="header">

   <a href="admin_home.php" class="logo">Admin<span>Panel</span></a>

   <nav class="navbar">
      <a href="admin_home.php">Home</a>
      <a href="admin_products.php">Books</a>
      <a href="admin_orders.php">Orders</a>
      <a href="admin_users.php">Users</a>
      <!-- <a href="admin_contacts.php">Messages</a> -->
   </nav>

   <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <div id="user-btn" class="fas fa-user"></div>
   </div>

   <div class="account-box">
      <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
      <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
      <a href="logout.php" class="delete-btn">logout</a>
   </div>

</header>
</body>
<script type="text/javascript" src="./js/admin_script.js"></script>
</html>