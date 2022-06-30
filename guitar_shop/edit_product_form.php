<?php
require('database.php');
// connects to database
$db = db_connect();
// connects id so i am able to pull the form in the url
$id = $_GET['id'];

$product = find_subject_by_id($id);



//  Get Categories from the Database
    $sql = "SELECT * FROM categories ";


    $categories = array();
    $result = mysqli_query($db, $sql);
    $categories = $result;
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>
        <h1>Edit Product</h1>
        <form action="edit_product.php?id=<?php echo $product['productID'];?> " method="post"
              id="edit_product_form">

        <!-- category Don't mess with. -->
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo h($category['categoryID']); ?>">
                    <?php echo h($category['categoryName']); ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <!-- Form you need to Edt. -->
            <!-- Need to get productID here to call the rest of the page. -->



            <!-- this is saving the values now!  -->
            <label>Code:</label>
            <input type="text" name="code" value="<?php echo h($product['productCode']); ?>"><br>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo h($product['productName']); ?>"><br>

            <label>List Price:</label>
            <input type="text" name="price" value="<?php echo h($product['listPrice']); ?>"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Edit Product"><br>
            

            <!-- the h function allows special chars and allows me to keep data from index in edit_product_form  -->
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>