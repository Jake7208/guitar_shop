<?php
require_once('database.php');

$id = $_GET['id'] ?? '';
$db = db_connect();

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
// Get name for selected category
$sql = "SELECT categoryName FROM categories ";
$sql .= "WHERE categoryID = '" . $category_id . "' ";

// $categories = [];
$result = mysqli_query($db, $sql);
$row = $result -> fetch_assoc();

// if (!$result) {
//     exit("Database query failed.");
// }
$category_name = $row['categoryName'];
// var_dump($category_name);



// Get all categories
$categories = array();
$sql = "SELECT * FROM categories ";

$result = mysqli_query($db, $sql);
$categories = $result;
// var_dump($categories);
// print_r($categories);
// Get products for selected category
$sql = "SELECT * FROM products ";
$sql .= "WHERE categoryID = '" . $category_id . "' ";

$products = array();
$result = mysqli_query($db, $sql);
$products = $result;

// var_dump($products);
?>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Product List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['productName']; ?></td>
                <td class="right"><?php echo $product['listPrice']; ?></td>
                <td><form action="delete_product.php" method="post">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $product['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
                //* action is sending form to edit_product_form.php and keeping productID in the url.
                <td><form action="edit_product_form.php?id=<?php echo $product['productID'];?> " method="post" >
                    <input type="hidden" name="product_id"
                           value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $product['categoryID']; ?>">
                    <input type="submit" name="Edit" value="Edit">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p></p>
        <p><a href="add_product_form.php">Add Product</a></p>
        <p><a href="category_list.php">List Categories</a></p>        
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>