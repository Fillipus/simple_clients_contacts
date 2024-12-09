<?php
include('../dbConnection/conn.php');

$data = json_decode(file_get_contents("php://input"), true);
$clientId = $data['Client_id'] ?? null;

if (!$clientId) {
    echo json_encode(['success' => false, 'message' => 'No Client ID found']);
    exit;
}

try {
    // Delete contacts associated with the client
    $stmt = $conn->prepare("DELETE FROM Contacts WHERE Client_id = ?");
    $stmt->execute([$clientId]);

    // Reset the contact count for the client
    $updateStmt = $conn->prepare("UPDATE Clients SET Number_of_contacts = 0 WHERE Client_id = ?");
    $updateStmt->execute([$clientId]);

    echo json_encode(['success' => true, 'message' => 'Contacts unlinked successfully']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
