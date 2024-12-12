<?php
// database connection
include('../dbConnection/conn.php');
include('../classes/clients.php');
include('../classes/contacts.php');

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);

try {
    // Validate input
    if (empty($data['contactName']) || empty($data['contactSurname']) || empty($data['contactEmail'])) {
        throw new Exception("All contact fields are required.");
    }

    $conn->beginTransaction();

    // Step 1: Retrieve the last inserted Client ID
    $clientId = Client::getLastInsertedClientId($conn);
    if (!$clientId) {
        throw new Exception("No client found to link the contact.");
    }

    // Step 2: Save the contact
    $contact = new Contact(
        $data['contactName'],
        $data['contactSurname'],
        $data['contactEmail']
    );
    
    $contactId = $contact->save($conn);

    if (!$contactId) {
        throw new Exception("Failed to save contact.");
    }

    // Step 3: Link contact to client
    $contact->linkContactToClient($conn, $clientId, $contactId);

    $conn->commit(); 

    echo json_encode(['success' => true, 'clientId' => $clientId]);
} catch (Exception $e) {
    $conn->rollBack(); 
    error_log("Error in linkContact.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
