-- Script for clients tables
-- ------------------------
CREATE TABLE `Clients` (
  `Client_id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Client_code` varchar(6) NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--add auto client id incremend
ALTER TABLE Clients 
MODIFY COLUMN Client_id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY;

-----add date stamps
ALTER TABLE `Clients`
ADD `CreatedAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;


--id incremend test 
INSERT INTO Clients (Name, Client_code, Number_of_contacts, Contact_id)
VALUES ('Test Client', '123456', 10, 1);



CREATE TABLE `Contacts` (
  `Contact_id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-----add time stamps
ALTER TABLE `Contacts`
ADD `CreatedAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

--add auto contact id incremend
ALTER TABLE Contacts
MODIFY COLUMN Contact_id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY;


--relationships table
CREATE TABLE ClientContacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Client_id INT NOT NULL,
    Contact_id INT NOT NULL,
    FOREIGN KEY (Client_id) REFERENCES Clients(Client_id) ON DELETE CASCADE,
    FOREIGN KEY (Contact_id) REFERENCES Contacts(Contact_id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

---updated
ALTER TABLE ClientContacts 
ADD CONSTRAINT fk_client 
FOREIGN KEY (Client_id) REFERENCES Clients(Client_id) ON DELETE CASCADE;

ALTER TABLE ClientContacts 
ADD CONSTRAINT fk_contact 
FOREIGN KEY (Contact_id) REFERENCES Contacts(Contact_id) ON DELETE CASCADE;


-- DUMMY DATA
INSERT INTO `Clients` (`Client_id`, `Name`, `Client_code`, `Number_of_contacts`)
VALUES
(1, 'John Doe', 'JD1234', 0, NULL),
(2, 'Jane Smith', 'JS5678', 0, NULL),
(3, 'Alex Johnson', 'AJA001', 1, 77);



