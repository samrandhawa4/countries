<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$query = $_GET['country'];
if($query) {
$servername = "localhost";
$username = "*****";
$password = "*****";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* check if the passed value in url exists in our database or not.*/
if(filter_input(INPUT_GET, 'country', FILTER_VALIDATE_INT)){
    $sql = "SELECT id, nicename as name, iso as code FROM apps_countries WHERE id = $query";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $rows= $result->fetch_assoc();
        echo json_encode(array('status'=> 200, 'post'=>$rows));
        return false;
    } else {
      echo json_encode(array('status'=> 400, 'message'=> 'No record found.'));
      return false;
    }
}else{
    echo json_encode(array('status'=> 400, 'message'=> 'please pass the id of the country.'));
    return false;
}
$conn->close();
return false;
}
 
?>
