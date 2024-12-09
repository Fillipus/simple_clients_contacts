<?php
include('../dbConnection/conn.php');
include('../classes/clients.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);
$clientName = $data['clientName'];

if (!$clientName) {
    echo json_encode(['success' => false, 'message' => 'Client name is required']);
    exit;
}

try {
    // Create a new Client object
    $client = new Client($clientName, total_contacts: 0);

    // Save the client and get the clientId
    $clientId = $client->save($conn); // Now it returns the clientId

    if ($clientId) {
        // If client was saved, return success with clientId
        echo json_encode(['success' => true, 'clientId' => $clientId]);
    } else {
        // If there was an error, return failure
        echo json_encode(['success' => false, 'message' => 'Error saving client']);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred']);
}
?>