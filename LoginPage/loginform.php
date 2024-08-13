<?php
include '../config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $number = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $user_type =  $_POST['user_type'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'Userimages/'.$image;

    $select_users = mysqli_query($conn, "SELECT * from `users` where email = '$email' AND password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select_users)>0){
        $message[] = 'user already exists!';
    }
    else{
        mysqli_query($conn, "INSERT INTO `users`(name, email, password, phonenumber, user_type, image) VALUES('$name', '$email', '$pass', '$number', '$user_type', '$image_folder')") or die('query failed');
        move_uploaded_file($image_tmp_name, $image_folder);
        echo $image_folder;
        $message[] = 'Registered Successfully!';
    }
   
}

elseif(isset($_POST['login'])){
    session_start();
    $email = mysqli_real_escape_string($conn, $_POST['emaillogin']);
    $pass = mysqli_real_escape_string($conn, $_POST['passwordlogin']);
    $user_type = mysqli_real_escape_string($conn, $_POST['passwordlogin']);
    
    // $user_type = $_POST['user_type'];
    
    $select_users = mysqli_query($conn, "SELECT * from `users` where email = '$email' AND password = '$pass'") or die('query failed');
    // $user = mysqli_fetch_assoc($select_users);
    // $select_admin = mysqli_query($conn, "SELECT * from `admin` where email = '$email' AND password = '$pass'") or die('query failed');
    // $admin = mysqli_fetch_assoc($select_admin);


    if(mysqli_num_rows($select_users)>0){

        $row = mysqli_fetch_assoc($select_users);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location: ../Admin/admin_home.php');
        }
        elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_image'] = $row['image'];
            $_SESSION['email_id'] = $_POST['emaillogin'];
            header('location: ../User/user_home.php');
        }
    }
    else{
        $message[] = 'incorrect email or password';
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- custom css file link   -->
    <link rel="stylesheet" href="loginformstyle.css">

    <link  href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<body>
<div class="bg-image"></div>
        
<div class="container">
<?php
    if(isset($message)){
    foreach ($message as $message){
        echo '
        <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick = "this.parentElement.remove();"></i>
        </div>';
    }
    }
?>
<div class="card">
    <div class="inner-box" id="card">
        <div class="card-front">
        <!-- <div ><a aria-label="This buton directs you to the homepage" class="fa-solid fa-x SymbolXLogin" href=""></a></div> -->
        <h2>LOGIN</h2>
        <form action="" method="post">
            <input type="email" name="emaillogin" class="input-box" placeholder="Email" required>
            <input type="password" name="passwordlogin" class="input-box" placeholder="Password" required>
            <!-- <select class="input-box" name="login_user_type" title="To select the user type">
                <option value="user">User</option> 
                <option value="admin">Admin</option> 
            </select> -->
            <label for=""><input type="checkbox"><span>Remember Me</span></label>
            <button class="submit-btn" name ="login" type="submit" onclick="login()">Login</button>
        </form>
        <button  class="btn" onclick="openRegister()">I am New here</button>
        <div ><a href="">Forgot Username or Password ?</a></div>
        </div>


        <div class="card-back">
            <!-- <div><a aria-label="This buton directs you to the homepage" class="fa-solid fa-x SymbolXRegister" href=""></a></div> -->
            <h2>REGISTER</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" class="input-box" name="name" placeholder="Your Name" required>
                <input type="email" class="input-box" name="email" placeholder="Your Email" required>
                <input type="password" class="input-box" name="password" placeholder="Your Password" required>
                <input type="tel" class="input-box" name="phonenumber" placeholder="Your Number" maxlength="10" minlength="10" required>
                <select class="input-box" name="user_type" title="To select the user type">
                    <option value="user">User</option>
                </select>
                <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="input-box" required>
                <button type="submit" name="submit" class="submit-btn">SUBMIT</button>
                <button type="button" class="btn" onclick="openLogin()">I have an Account</button>
            </form>
        </div>
    </div>
    </div>
</div>

        <script>
            function openRegister() {
                var card = document.getElementById("card");
                card.style.transform = "rotateY(-180deg)"
            }

            function openLogin() {
                var card = document.getElementById("card");
                card.style.transform = "rotateY(0deg)"
            }
        </script>
    </body>

</html>