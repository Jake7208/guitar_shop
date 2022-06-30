<?php
require_once('database.php');
$db = db_connect();

// Get all categories
$sql = "SELECT * FROM categories ";

$result = mysqli_query($db, $sql);
$rows = $result;
?>
<!DOCTYPE html>
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
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <!-- The non-breaking space looked ugly so I commented it out  -->
            <!-- <th>&nbsp;</th> -->
        
    
        <!-- add code for the rest of the table here -->
        <?php

        $sql = "SELECT categoryName FROM categories ";

     
        $result = mysqli_query($db, $sql);
//    this while loop is essentially allowing it to run 
//    through a row then go to the next row
//    until it there are no more rows left.
        while ($count = mysqli_fetch_assoc($result)) {
           echo "<th>" . $count ['categoryName'] . "</th> ";
        } ?></tr>

        


    </table>

    <h2>Add Category</h2>
    
    <!-- add code for the form here -->
    <?php 
    

function insert_category($categories) {
    global $db;
        $sql = "INSERT INTO categories ";
        $sql .= "(categoryName) ";
        $sql .= "VALUES (";
        $sql .= "'" . $categories['categoryName'] . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);
    if($result){
        return true;
    } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
    }
}

// if there is a post request redirect so it doesn't bug.
    if(is_post_request()){
    $category = [];
    $category['categoryName'] = $_POST['categoryName'] ?? '';

    
    $result = insert_category($category);
    $move = redirect_to('index.php');
}

    ?>

    <!-- Form that needs to be connected to the database -->
    <!--  -->
    <form action="" method="post">
        <dl>
            <dt>Category Name</dt>
            <dd><input = type="text" name="categoryName" value="" /></dd>
        </dl>
        <div>
            <input type="submit" value="Create Category"/>
        </div>
    </form>
    
    
    <br>
    <p><a href="index.php">List Products</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>