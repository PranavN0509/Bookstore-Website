<?php
include '../config.php';
$search_value = $_POST['search'];

//  if(isset($_POST['search'])){
   // $input = $_POST['search'];
   // $book_to_be_searched = mysqli_real_escape_string($conn, $_POST['search_books']);
   $select_books_query = mysqli_query($conn, "SELECT * from `products` WHERE (name LIKE '%{$search_value}%') OR (authorname LIKE '%{$search_value}%')") or die("SQL Query failed");
   $output = '';
   
   if(isset($_POST['search'])){
      if(mysqli_num_rows($select_books_query)>0){
         while($fetch_products = mysqli_fetch_assoc($select_books_query)){
            ?>   
         <form action="" method="post" class="box">
            <img class="image" src="../uploaded_img/<?php echo $fetch_products['image'];?>" alt="">
            <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
         <input aria-label="Enter quantity of books" type="number" min="1" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <a href="user_view_post.php?get_id=<?php echo $fetch_products['id'];?>" class="btn">Reviews</a>
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">

      </form>
      <?php
   }
   }
   else{
      echo '<p class="empty">Sorry! This book is not available with us.</p>';
   }
}   
?>
