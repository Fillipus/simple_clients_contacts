<?php
// Database connection
include('/opt/lampp/htdocs/clients_contacts/dbConnection/conn.php');
function getContactCount(PDO $conn, int $clientId): int
{
    try {
        $stmt = $conn->prepare(query: "SELECT COUNT(*) FROM Contacts WHERE Client_id = ?");
        $stmt->execute(params: [$clientId]);
        return (int) $stmt->fetchColumn();
    } catch (PDOException $e) {
        // error handling
        error_log("Error fetching contacts count: " . $e->getMessage());
        return 0; 
    }
}
