<?php
// fetching clients
include 'scripts/fetchClients.php';
// fetching contacts
include 'scripts/fetchContacts.php';
//contact count script
include 'scripts/getContactCount.php';
//contact count script
include 'scripts/getClientCount.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Contacts</title>
    <link rel="stylesheet" href="assets/styleSheet.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Main container for the page -->
    <div class="container">

        <!-- Left-side tabs -->
        <div class="tabs">
            <ul>
                <li id="clientsTab" class="active" onclick="switchTab('clients')">Clients</li>
                <li id="contactsTab" onclick="switchTab('contacts')">Contact</li>
            </ul>
        </div>

        <div class="content w-full">
            <div id="clientsContent" class="tab-content">
                <!-- Button Row -->
                <div class="button-container">
                    <button id="addButton" class="button" data-toggle="modal" data-target="#clientModal">
                        Add Client
                    </button>
                </div>
                <h2 class="text-xl font-semibold mb-4">Clients List</h2>
                <table id="clientsList" class="w-full table-auto border-collapse">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Code</th>
                            <th class="px-4 py-2">Number of Contacts</th>
                            <th class="px-4 py-2">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if clients are available
                        if (isset($clients) && !empty($clients)) {
                            foreach ($clients as $index => $client) {
                                // contact count using the helper function
                                $contactCount = getContactCount($conn, $client['Client_id']);

                                // Alternate row colors using Tailwind's odd and even row classes
                                $rowClass = $index % 2 === 0 ? 'bg-gray-100' : 'bg-white';
                                echo "<tr class='{$rowClass}'>";

                                // Display client Name
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($client['Name']) . "</td>";

                                // Display client Code or "No code"
                                echo "<td class='px-4 py-2'>" . (empty($client['Client_code']) ? 'No code' : htmlspecialchars($client['Client_code'])) . "</td>";

                                // Display Number of Contacts or 0 if no contacts found
                                echo "<td class='px-4 py-2'>" . ($contactCount > 0 ? htmlspecialchars($contactCount) : '0') . "</td>";

                                //unlink contacts
                                echo "<td class='px-4 py-2'> <a href='#' class='text-blue-500 unlink-button' data-client-id='" . $client['Client_id'] . "'>Unlink</a> </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center px-4 py-2'>No Clients Available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <div id="contactsContent" class="tab-content" style="display:none;">
                <!-- Button Row -->
                <div class="button-container">
                    <button id="addButton" class="button" data-toggle="modal" data-target="#contactModal">
                        Add Contact
                    </button>
                </div>
                <h2 class="text-xl font-semibold mb-4">Contacts List</h2>
                <table id="contactsList" class="w-full table-auto border-collapse">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Surname</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Number of Clients</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if contacts are available
                        if (isset($contacts) && !empty($contacts)) {
                            // Loop through contacts and display their details
                            foreach ($contacts as $index => $contact) {
                                // client count using the helper function
                                $clientCount = getClientCount($conn, $contact['Contact_id']);

                                // Alternate row colors using Tailwind's odd and even row classes
                                $rowClass = $index % 2 === 0 ? 'bg-gray-100' : 'bg-white';
                                echo "<tr class='{$rowClass}'>";

                                // Display client Name
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($contact['Name']) . "</td>";

                                // Display client Surname
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($contact['Surname']) . "</td>";

                                // Display client Email
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($contact['Email']) . "</td>";

                                // Display Number of Contacts or 0 if no contacts found
                                echo "<td class='px-4 py-2'>" . ($clientCount > 0 ? htmlspecialchars($clientCount) : '0') . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            // If no contacts are available
                            echo "<tr><td colspan='5' class='text-center px-4 py-2'>No Contacts available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php include 'view/clientModal.php'; ?>
    <?php include 'view/contactModal.php'; ?>

    <!-- Importing script.js -->
    <script src="js/script.js"></script>
    <!-- Importing createClient.js -->
    <script src="js/createClient.js"></script>
    <!-- Importing createContact.js -->
    <script src="js/createContact.js"></script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>