<?php

include '../config.php';

if(isset($_POST['action'])){
    $query = "SELECT * FROM `products`";

    if(isset($_POST["sellingtype"])){
        $sellingtype = implode("",$_POST['sellingtype']);
        echo $sellingtype;
        $query = "SELECT * FROM `products` WHERE sellingtype='$sellingtype'";
    }
    else if(isset($_POST["genretype"])){
        $genretype = implode("",$_POST['genretype']);
        echo $genretype;
        $query = "SELECT * FROM `products` WHERE genretype='$genretype'";
    }
    else if(isset($_POST["authorname"])){
        $authorname = implode("",$_POST['authorname']);
        echo $authorname;
        $query = "SELECT * FROM `products` WHERE authorname='$authorname'";
    }
    ?>
    <h1>Shop Section</h1>
         <div class="box-container">
            
            <?php  
            $select_products = mysqli_query($conn, $query) or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
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
               echo '<p class="empty">no products added yet!</p>';
            }
            ?>
         </div>
<?php
}

// else{
//     echo '<p class="empty">Please select one filter at a time!</p>';
// }
?>
