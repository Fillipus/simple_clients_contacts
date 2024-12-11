<?php
include('../dbConnection/conn.php');
include('../classes/contacts.php');
include('../classes/clients.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);
$contactName = $data['contactName'];
$contactSurname = $data['contactSurname'];
$contactEmail = $data['contactEmail'];

if (!$contactName || !$contactSurname || !$contactEmail) {
    echo json_encode(['success' => false, 'message' => 'Enter all Contact deatils']);
    exit;
}

try {

    $lastClientId = Client::getLastInsertedClientId($conn);

    error_log("Last inserted Client ID: " . $lastClientId);

    
    if (!$lastClientId) {
        throw new Exception("No client exists to link the contact.");
    }

    // Create a new Contact Class object
    $contact = new Contact($contactName, $contactSurname, $contactEmail);

    // Save the contact
    $savedContactId = $contact->save($conn);

    if ($savedContactId) {
        // Link the contact to the client in the ClientContacts table
        $contact->linkContactToClient($conn, $lastClientId, $savedContactId);

        echo json_encode(['success' => true, 'message' => 'Contact saved and linked successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error saving Contact']);
    }

} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred in saving Contact']);
}
?>