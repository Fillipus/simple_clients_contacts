<?php
// database connection
include('dbConnection/conn.php');
function getClientCount(PDO $conn, int $Contact_id): int
{
    try {
        
        $stmt = $conn->prepare(query: "SELECT COUNT(*) FROM ClientContacts WHERE Contact_id = ?");
        $stmt->execute(params: [$Contact_id]);
        return (int) $stmt->fetchColumn();

    } catch (PDOException $e) {
        // error handling
        error_log("Error fetching client count: " . $e->getMessage());
        return 0; 
    }
}
