<?php
include('../dbConnection/conn.php');
require_once 'person.php';
class Contact extends Person
{
    private $surname;
    private $email;

    // Class Constructor 
    public function __construct($name, $surname, $email)
    {
        parent::__construct($name);
        $this->surname = $surname;
        $this->email = $email;
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

    public function save(PDO $conn): ?int
    {
        try {
            // insert contact data
            $sql = "
                INSERT INTO Contacts (Name, Surname, Email) 
                VALUES (:name, :surname, :email)
            ";
            $stmt = $conn->prepare($sql);

            $name = $this->getName();
            $surname = $this->getSurname();
            $email = $this->getEmail();
            $numberOfClients = $this->numberOfClients ?? null;
            $clientId = $this->clientId ?? null;

            // Bind parameters
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                return (int) $conn->lastInsertId();
            }

            //error handling
            throw new Exception("Failed to execute save operation.");
        } catch (PDOException $e) {
            // Log and rethrow the error for higher-level handling
            error_log("Error saving contact: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("General error in save: " . $e->getMessage());
            return null;
        }
    }


    public function linkContactToClient(PDO $conn, int $clientId, int $contactId): void
    {
        try {
            $stmt = $conn->prepare("INSERT INTO ClientContacts (Client_id, Contact_id) VALUES (?, ?)");
            $stmt->execute([$clientId, $contactId]);
        } catch (PDOException $e) {
            // error handling
            error_log("Error linking contact to client: " . $e->getMessage());
            throw new Exception("Failed to link contact to client");
        }
    }



}
?>