<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "clientsContacts";

try {
    // Create the PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // error handling
    echo "DB connection failed: " . $e->getMessage();
    die();
}
?>
