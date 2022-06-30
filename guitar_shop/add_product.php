<?php
// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate inputs
if ($category_id == null || $category_id == false ||
        $code == null || $name == null || $price == null || $price == false) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require('database.php');
    $db = db_connect();
    // Add the product to the database  

    
    if(is_post_request()) {
        $sql = "INSERT INTO products ";
        $sql .= "(categoryID, productCode, productName, listPrice) ";
        $sql .= "VALUES (";
        $sql .= "'" . $category_id . "', ";
        $sql .= "'" . $code . "', ";
        $sql .= "'" . $name . "', ";
        $sql .= "'" . $price . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
    }

    // Display the Product List page
    if ($result) {
        redirect_to('index.php');
    } else{
    echo mysqli_error($db);
    }
}
?>


 <?php
    // trash Pile



    // add product to page
    // }

    // if(is_post_request()){
    //     $product['productCode'] = $_POST['productCode'] ?? '';
    //     $product['productName'] = $_POST['productName'] ?? '';
    //     $product['listPrice'] = $_POST['listPrice'] ?? '';

    //     $result = insert_product($product);
    //     $move = redirect_to('index.php');
    // } ?>