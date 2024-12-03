<?php
// Include the database connection
include('/opt/lampp/htdocs/clients_contacts/dbConnection/conn.php');

// Initialize the contacts array
$contacts = [];

try {
    if ($conn) {
        // Query to fetch all contacts from the database
        $stmt = $conn->query("SELECT * FROM Contacts");
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
} catch (PDOException $e) {
    // Handle any errors during the fetching process
    echo "Database error: " . $e->getMessage();
}
?>