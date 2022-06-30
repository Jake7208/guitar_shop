<?php
require('database.php');

    $db = db_connect();
    // Add the product to the database  
    $id = $_GET['id'];
    // $sql = "SELECT * FROM products WHERE id = $id";
    
    // $result = mysqli_query($db, $sql);
    if(is_post_request()) {

// TODO make this code categoryID connect to names set in index 'code' 
//* categoryID in index is category_id
        $subject = [];
        $subject['id'] = $id;
        $subject['categoryID'] = $_POST['category_id'] ?? '';
        $subject['productCode'] = $_POST['code'] ?? '';
        $subject['productName'] = $_POST['name'] ?? '';
        $subject['listPrice'] = $_POST['price'] ?? '';
      
        $update = update_subject($subject);
        if($update) {
        redirect_to('index.php');
        echo $update;

      // } else {
      //    $subject = find_subject_by_id($id);
      
      //   $subject_set = find_all_subjects();
      //   $subject_count = mysqli_num_rows($subject_set);
      //   mysqli_free_result($subject_set);
      
      }
}


?>


