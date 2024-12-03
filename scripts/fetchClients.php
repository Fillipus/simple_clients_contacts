<?php
// Include the database connection
include('/opt/lampp/htdocs/clients_contacts/dbConnection/conn.php');

// Initialize the clients array
$clients = [];

try {
    if ($conn) {
        // Query to fetch all clients from the database
        $stmt = $conn->query("SELECT * FROM Clients");
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
} catch (PDOException $e) {
    // Handle any errors during the fetching process
    echo "Database error: " . $e->getMessage();
}
?>

