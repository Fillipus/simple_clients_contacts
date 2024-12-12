<?php
include('../dbConnection/conn.php');
require_once 'person.php';

// Client class (inherits from Person)
class Client extends Person
{
    private $client_code;

    // Constructor to initialize client-specific attributes
    public function __construct($name)
    {
        parent::__construct(name: $name);
    }

    public function getClientCode()
    {
        return $this->client_code;
    }

    // Save client data (including code generation)
    public function save(PDO $conn)
    {
        try {

            $stmt = $conn->prepare(query: "INSERT INTO Clients (Name) VALUES (?)");

            $stmt->execute(params: [$this->getName()]);

            // last client ID
            $clientId = $conn->lastInsertId();

            // client code 
            $this->client_code = $this->generateClientCode($conn, lastClientId: $clientId);

            // Update client record with the generated client code
            $updateStmt = $conn->prepare("UPDATE Clients SET client_code = ? WHERE Client_id = ?");
            $updateStmt->execute(params: [$this->client_code, $clientId]);

            // Return the clientId to be used in the response
            return $clientId;
        } catch (PDOException $e) {
            // Handle database-related errors
            echo "Error saving client: " . $e->getMessage();
            return null;
        }
    }
    function generateClientCode(PDO $conn, int $lastClientId): string
    {
        //fetch the client name using the provided last inserted client ID
        $stmt = $conn->prepare(query: "SELECT Name FROM Clients WHERE Client_id = ?");
        $stmt->execute(params: [$lastClientId]);
        $clientName = $stmt->fetchColumn();

        // Check if the client name exists
        if (!$clientName) {
            throw new Exception(message: "No Client name found for this Client_id" + $lastClientId);
        }

        // Extract the first three characters of the client's name, converted to uppercase
        $prefix = strtoupper(string: substr(string: $clientName, offset: 0, length: 3));

        // Pad the prefix if the name is shorter than 3 characters
        $prefix = str_pad(string: $prefix, length: 3, pad_string: 'A');

        // Query the database for the maximum numeric suffix for the prefix
        $stmt = $conn->prepare(query: "SELECT MAX(SUBSTRING(Client_code, 4)) AS max_suffix 
                               FROM Clients 
                               WHERE Client_code LIKE ?");
        $stmt->execute(params: [$prefix . '%']);
        $maxSuffix = $stmt->fetchColumn();

        // Increment the numeric suffix or start at 1 if none exists
        $nextSuffix = $maxSuffix ? (int) $maxSuffix + 1 : 1;

        // Format the numeric part to always be 3 digits
        $numericPart = str_pad(string: $nextSuffix, length: 3, pad_string: '0', pad_type: STR_PAD_LEFT);

        // Combine the prefix and numeric part to form the client code
        return $prefix . $numericPart;
    }

    //fetching the id of the last created clients for use when linking
    public static function getLastInsertedClientId(PDO $conn): ?int
    {
        try {
            // SQL squery
            $stmt = $conn->query("SELECT Client_id FROM Clients ORDER BY Client_id DESC LIMIT 1");

            // Fetch the result and return the Client_id
            $lastClientId = $stmt->fetchColumn();

            // If no client is found, return null
            return $lastClientId ? (int) $lastClientId : null;
        } catch (PDOException $e) {
            // error handling
            error_log(message: "Error fetching last inserted client ID: " . $e->getMessage());
            return null;
        }
    }


}
?>