<?php
include('../dbConnection/conn.php');

$data = json_decode(file_get_contents("php://input"), true);
$clientId = $data['clientId'] ?? null;

if (!$clientId) {
    echo json_encode(['success' => false, 'message' => 'No Client ID found']);
    exit;
}

try {
    // Start a transaction to ensure data consistency
    $conn->beginTransaction();

    // Find the Contact IDs associated with the client in the ClientContacts table
    $stmt = $conn->prepare("SELECT Contact_id FROM ClientContacts WHERE Client_id = ?");
    $stmt->execute([$clientId]);
    $contactIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Check if there are any contacts for the given client
    if (empty($contactIds)) {
        echo json_encode(['success' => false, 'message' => 'No contacts found for the given client']);
        // Rollback the transaction
        $conn->rollBack();
        exit;
    }

    // Delete the relationships in ClientContacts table
    $deleteRelationshipStmt = $conn->prepare("DELETE FROM ClientContacts WHERE Client_id = ?");
    $deleteRelationshipStmt->execute([$clientId]);

    // Delete the contacts from the Contacts table
    $deleteContactsStmt = $conn->prepare("DELETE FROM Contacts WHERE Contact_id IN (" . implode(',', array_fill(0, count($contactIds), '?')) . ")");
    $deleteContactsStmt->execute($contactIds);

    // Commit the transaction
    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Contacts and relationships deleted successfully']);
} catch (PDOException $e) {
    // Rollback the transaction on error
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
