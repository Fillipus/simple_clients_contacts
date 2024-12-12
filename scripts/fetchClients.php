<?php
// database connection
include('dbConnection/conn.php');

// initial empty clients
$clients = [];

try {
    if ($conn) {
        // fetch query
        $stmt = $conn->query("SELECT * FROM Clients");
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
} catch (PDOException $e) {
    // error handling
    echo "Database error: " . $e->getMessage();
}
?>

