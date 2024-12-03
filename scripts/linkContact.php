<?php
include('../dbConnection/conn.php');
include('../classes/clients.php');

$data = json_decode(file_get_contents("php://input"), true);

// Decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);
$clientId = $data['Client_id'];

if (!$clientId) {
    echo json_encode(['success' => false, 'message' => 'Client ID not found']);
    exit;
}

$contactName = $data['contactName'];
$contactSurname = $data['contactSurname'];
$contactEmail = $data['contactEmail'];

if (!$contactName || !$contactSurname || !$contactEmail ) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO Contacts (Name, Surname, Email, Client_id) VALUES (?, ?, ?, ?)");
$stmt->execute([$contactName, $contactSurname, $contactEmail, $clientId]);

echo json_encode(['success' => true]);
?>
