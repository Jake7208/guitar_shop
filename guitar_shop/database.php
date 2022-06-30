<?php
//Create database connection
// * DataBase connection 
define("DB_SERVER", "localhost");
define("DB_USER", "Guitar_Employee");
define("DB_PASS", "abc1234");
define("DB_NAME", "my_guitar_shop1");

ob_start(); // output buffering is turned on

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

//? function url_for add missing data from a url to another page.

function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }

//! u allows to encode anything belonging to the string

  function u($string="") {
    return urlencode($string);
  }

  
  function raw_u($string="") {
    return rawurlencode($string);
  }

  //* allows me to keep the data by converting the data from index into html entities.
  function h($string="") {
    return htmlspecialchars($string);
  }
  
//* sends immediately to Location given like 'index.php'
  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

//* make sure that it is working if failed reports database failed.
  function confirm_result_set($result_set) {
    if (!$result_set) {
        exit("Database query failed.");
    }        
}

//* reports to the database
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
} 

//* disconnects from the database 
function db_disconnect() {
  if(isset($connection)) {
      mysqli_close($connection);
  }
}


//* sends to the database to change current product.
  function update_subject($subject) {
    global $db;
    
    $sql = "UPDATE products SET ";
    $sql .= "categoryID= '" . $subject['categoryID'] . "', ";
    $sql .= "productCode= '" . $subject['productCode'] . "', ";
    $sql .= "productName= '" . $subject['productName'] . "', ";
    $sql .= "listPrice= '" . $subject['listPrice'] . "' ";  
    $sql .= "WHERE productID= '" . $subject['id'] . "' ";

    $result = mysqli_query($db, $sql);
    echo $sql;
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    }else {
      echo mysqli_error($db);
    }
  }


//* find all products id's in products productID
  function find_subject_by_id($id) {
    global $db;
    $sql = "SELECT * FROM products ";
    $sql .= "WHERE productID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject;
  }

  // finds everything in products orders by products ID starting from lowest going to highest. 
  function find_all_subjects() {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "ORDER BY productID ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
?>