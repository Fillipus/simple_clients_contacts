<?php
include('../dbConnection/conn.php');
include('../classes/clients.php');

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);
$clientName = $data['clientName'];

if (!$clientName) {
    echo json_encode(['success' => false, 'message' => 'Client name is required']);
    exit;
}

try {
    // Create a new Client object
    $client = new Client($clientName);

    // Save the client and get the clientId
    // Now it returns the clientId
    $clientId = $client->save($conn); 

    if ($clientId) {
        // saved client id 
        echo json_encode(['success' => true, 'clientId' => $clientId]);
    } else {
        // error handling
        echo json_encode(['success' => false, 'message' => 'Error saving client']);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An unexpected error occurred']);
}
?>