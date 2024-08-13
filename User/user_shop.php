<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="user_shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap-grid.min.css" integrity="sha512-JQksK36WdRekVrvdxNyV3B0Q1huqbTkIQNbz1dlcFVgNynEMRl0F8OSqOGdVppLUDIvsOejhr/W5L3G/b3J+8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>User Shop</title>
</head>
<body>
<?php
    include '../config.php';
    include 'user_headersidebar.php';
    $user_id = $_SESSION['user_id'];
    if(!isset($user_id))
    {
       header('location:loginform.php');
    }

?>


<?php
   if(isset($_POST['add_to_cart'])){
      
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];
   
      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   
      if(mysqli_num_rows($check_cart_numbers) > 0){
         $message[] = 'already added to cart!';
      }else{
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
         $message[] = 'product added to cart!';
      }
      
   }
   ?>

<section class="flex">

<section class="filters">
      <h1>Filters</h1>
   <div class="filter-container">
      
         <!-- <div class="filterbox">
            <h1>By Price Range</h1>
            1000-650000
         </div> -->
         <div class="filterbox">
            <select id="filtertype">
               <option value="">Select Filter</option>
               <option value="sellingtype">Selling Type </option>
               <option value="author">Author Name</option>
               <option value="genre">Genre Type</option>
            </select>
         </div>


         <div class="filterbox data" id="sellingtype">
            <h1>By Selling Type</h1>
            <div class="">
               <?php
               $sellingtype_query = mysqli_query($conn, "SELECT DISTINCT(sellingtype) from  `products`") or die("Query failed");
               while($sellingtype = mysqli_fetch_assoc($sellingtype_query)){
               ?>
               <label for=""><input type="checkbox" class="common_selector sellingtype" value="<?php echo $sellingtype['sellingtype'];?>">
               <?php if($sellingtype['sellingtype'] == 'Sell'){
                  echo'Books for sale';
               }
               else if($sellingtype['sellingtype'] == 'Donate'){
                  echo'Books for donation';
               }
               ?>
               </label>
               <?php
               }
               ?>
            </div>
         </div>


         <div class="filterbox data" id="author">
            <h1>By Author Name</h1>
         <div class="">
            <?php
            $authorname_query = mysqli_query($conn, "SELECT DISTINCT(authorname) from  `products`") or die("Query failed");
            while($authorname = mysqli_fetch_assoc($authorname_query)){
            ?>
            <label for=""><input type="checkbox" class="common_selector author" name="" value="<?php echo $authorname['authorname']?>"> <?php echo $authorname['authorname'];?></label>
            <?php
            }
            ?>
         </div>
         </div>

         <div class="filterbox data" id="genre">
               <h1>By Genre</h1>
            <div class="">
               <?php
               $genretype_query = mysqli_query($conn, "SELECT DISTINCT(genretype) from  `products`") or die("Query failed");
               while($genretype = mysqli_fetch_assoc($genretype_query)){
               ?>
               <label for=""><input type="checkbox" class="common_selector genre" value="<?php echo $genretype['genretype'];?>"> <?php echo $genretype['genretype'];?> </label>
               <?php
               }
               ?>
            </div>
         </div>
      </div>
</section>



<section class="shop"></section>

</section>



<?php include 'user_footer.php';?>         
</body>

<script type="text/javascript">

   $(document).ready(function(){
      $('#filtertype').on('change' ,function(){
         // alert($(this).val());
         $(".data").hide();
         $("#" + $(this).val()).fadeIn(700);
      }).change();
   });



   $(document).ready(function(){
      filter_data();
      function filter_data(){
         $('.shop').html();
         var action = 'ajax_filterdata';
         var sellingtype = get_filter('sellingtype');
         var genretype = get_filter('genre');
         var authorname = get_filter('author');
         $.ajax({
            url: 'ajax_filterdata.php',
            method: "POST",
            data:{action:action, sellingtype:sellingtype, genretype:genretype, authorname:authorname},
            success:function(data){
               $('.shop').html(data);
            } 
         });

      }
      
      
      function get_filter(class_name){
         var filter = [];
         $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
         });
         return filter;
      }
      
      $('.common_selector').click(function(){
         filter_data();
      });
   });

</script>



<script src="user_script.js"></script>
</html>
