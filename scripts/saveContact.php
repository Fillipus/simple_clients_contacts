<?php
include('../dbConnection/conn.php');
include('../classes/contacts.php');
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
    // Create a new Contact Class object
    $contact = new Contact($contactName, $contactSurname, $contactEmail, $numberOfClients, $clientId);

    // Save the contact
    $savedContact = $contact->save($conn);

    if ($savedContact) {
        // contact saved
        echo json_encode(['success' => true, 'message' => 'Contact saved successfully']);
    } else {
        // If there was an error, return failure
        echo json_encode(['success' => false, 'message' => 'Error saving Contact']);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred in saving Contact']);
}
?>