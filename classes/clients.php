<?php
include('../dbConnection/conn.php');
require_once 'person.php';

// Client class (inherits from Person)
class Client extends Person
{
    private $total_contacts;
    private $client_code;

    // Constructor to initialize client-specific attributes
    public function __construct($name, $total_contacts)
    {
        parent::__construct(name: $name);
        $this->total_contacts = $total_contacts;
    }

    public function setTotalContacts($total_contacts): void
    {
        $this->total_contacts = $total_contacts;
    }

    public function getTotalContacts()
    {
        return $this->total_contacts;
    }
      public function getClientCode()
      {
          return $this->client_code;
      }

    //save client data (including code generation)
    public function save(PDO  $conn)
    {
        try {

            $stmt =  $conn->prepare("INSERT INTO clients (name, total_contacts) VALUES (?, ?)");
            // total_contacts is 0 if null
            $stmt->execute([$this->getName(), $this->total_contacts ?? 0]);

            // Retrieve newly inserted client ID
            $clientId =  $conn->lastInsertId();

            // Generate the client code 
            $this->client_code = $this->generateClientCode( $conn, $clientId);

            // Update the client record with the generated client code
            $updateStmt =  $conn->prepare("UPDATE clients SET client_code = ? WHERE id = ?");
            $updateStmt->execute([$this->client_code, $clientId]);

        } catch (PDOException $e) {
            // Handle database-related errors
            echo "Error saving client: " . $e->getMessage();
        }
    }

    function generateClientCode(PDO  $conn, int $lastClientId): string
    {
        //fetch the client name using the provided last inserted client ID
        $stmt =  $conn->prepare("SELECT Name FROM Clients WHERE id = ?");
        $stmt->execute([$lastClientId]);
        $clientName = $stmt->fetchColumn();

        // Check if the client name exists
        if (!$clientName) {
            throw new Exception("No Client name found for this id" + $lastClientId);
        }

        // Extract the first three characters of the client's name, converted to uppercase
        $prefix = strtoupper(substr($clientName, 0, 3));

        // Pad the prefix if the name is shorter than 3 characters
        $prefix = str_pad($prefix, 3, 'A');

        // Query the database for the maximum numeric suffix for the prefix
        $stmt =  $conn->prepare("SELECT MAX(SUBSTRING(client_code, 4)) AS max_suffix 
                               FROM clients 
                               WHERE client_code LIKE ?");
        $stmt->execute([$prefix . '%']);
        $maxSuffix = $stmt->fetchColumn();

        // Increment the numeric suffix or start at 1 if none exists
        $nextSuffix = $maxSuffix ? (int) $maxSuffix + 1 : 1;

        // Format the numeric part to always be 3 digits
        $numericPart = str_pad($nextSuffix, 3, '0', STR_PAD_LEFT);

        // Combine the prefix and numeric part to form the client code
        return $prefix . $numericPart;
    }

}
?>