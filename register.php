<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['email']) && isset($_POST['password'])) {

    $name = $_POST['name'] 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $poc_email = $_POST['poc_email'];
    // include db connect class
    require_once __DIR__ . '/dbcontroller.php';
 
    // connecting to db
    $db = new DBController();
 
    // mysql inserting a new row
                
    $result = mysql_query("INSERT INTO `ticket_tool`.`users` (`name`,`email`,`password`,`poc_email`)"
            . " VALUES('$name', '$email', md5('$password'),'$poc_email')")or die(mysql_error());
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Retailer successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>