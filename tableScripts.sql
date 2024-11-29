-- Script for clients tables
-- ------------------------
CREATE TABLE `Clients` (
  `Client_id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Client_code` varchar(6) NULL,
  `Number_of_contacts` int(255) NULL,
  `Contact_id` int(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Contacts` (
  `Contact_id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Number_of_clients` int(255) NULL,
  `Client_id` int(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- DUMMY DATA
INSERT INTO `Clients` (`Client_id`, `Name`, `Client_code`, `Number_of_contacts`, `Contact_id`)
VALUES
(1, 'John Doe', 'JD1234', 0, NULL),
(2, 'Jane Smith', 'JS5678', 0, NULL),
(3, 'Alex Johnson', 'AJA001', 1, 77);