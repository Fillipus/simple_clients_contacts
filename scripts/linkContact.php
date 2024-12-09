<?php
include('../dbConnection/conn.php');
include('../classes/clients.php');
include('../classes/contacts.php');
error_log(json_encode($data));

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);

$contactName = $data['contactName'];
$contactSurname = $data['contactSurname'];
$contactEmail = $data['contactEmail'];

if (!$contactName || !$contactSurname || !$contactEmail) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

try {
    // Step 1: Retrieve the last inserted Client ID from Clients Class
    $clientId = Client::getLastInsertedClientId($conn);

    //check if client id was fetched successfully in Client Class
    if (!$clientId) {
        throw new Exception("No client found to link the contact.");
    }

    // Step 2: Save the contact for the retrieved client ID
    $contact = new Contact($contactName, $contactSurname, $contactEmail, null, clientId: $clientId);
    $contact->save($conn);

    // Respond with success
    echo json_encode(['success' => true, 'clientId' => $clientId]);
} catch (Exception $e) {
    //error handling
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

echo json_encode(['success' => true]);
?>



