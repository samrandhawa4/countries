<?php
header("Access-Control-Allow-Origin: http://localhost:3001"); // Replace http://localhost:3001 with your API url
header('Content-Type: application/json');
$query = $_GET['country'];
if($query) {
$servername = "localhost";
$username = ""; // your db username
$password = ""; // your db password
$dbname = ""; // your db name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, code FROM apps_countries WHERE name LIKE '%$query%'";
$result = $conn->query($sql);
$rows = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($r= $result->fetch_assoc()) {
        $rows[] = $r;
    }
    echo json_encode(array('status'=> 200, 'posts'=>$rows));
    return false;
} else {
  echo json_encode(array('status'=> 400, 'message'=> 'No record found.'));
  return false;
}
$conn->close();
}
  echo json_encode(array('status'=> 400, 'message'=> 'Please pass query string in url with country name Ex: ?country=a.'));
  return false;
?>
