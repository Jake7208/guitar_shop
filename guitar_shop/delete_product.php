<?php
require_once('database.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
//! LIMIT 1 makes sure that you only Delete one row from the database.
$sql = "DELETE FROM products ";
$sql .= "WHERE productID='" . $product_id . "' ";
$sql .= "LIMIT 1";

$result = mysqli_query($db, $sql);

// Display the Product List page
//* if it pulls the result/deletes the result it will send this page back to index.php.
if($result) {
    redirect_to('index.php');
}else {
    echo mysqli_error($db);
}