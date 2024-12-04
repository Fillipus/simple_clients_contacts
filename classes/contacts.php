<?php
include('../dbConnection/conn.php');
require_once 'person.php';
class Contact extends Person
{
    private $surname;
    private $email;
    private $numberOfClients;
    private $clientId;

    // Class Constructor 
    public function __construct($name, $surname, $email, $numberOfClients = null, $clientId = null)
    {
        parent::__construct($name);
        $this->surname = $surname;
        $this->email = $email;
        $this->numberOfClients = $numberOfClients;
        $this->clientId = $clientId;
    }

    // Setter and getter for surname
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function getSurname()
    {
        return $this->surname;
    }

    // Setter and getter for email
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    // Setter and getter for number of clients
    public function setNumberOfClients($numberOfClients)
    {
        $this->numberOfClients = $numberOfClients;
    }
    public function getNumberOfClients()
    {
        return $this->numberOfClients;
    }

    // Setter and getter for client ID
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }
    public function getClientId()
    {
        return $this->clientId;
    }

    public function save(PDO $conn)
    {
        try {
            // SQL statement to insert contact data
            $stmt = $conn->prepare(
                "INSERT INTO Contacts (Name, Surname, Email, Number_of_clients, Client_id) 
                 VALUES (?, ?, ?, ?, ?)"
            );

            // Execute array of values
            $stmt->execute([
                $this->getName(),
                $this->getSurname(),
                $this->getEmail(),
                $this->numberOfClients ?? 0,
                $this->clientId ?? 0
            ]);

        } catch (PDOException $e) {
            // error handling
            echo "Error saving contact: " . $e->getMessage();
            return null;
        }
    }


}
?>