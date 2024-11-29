<?php
// Include the PHP script for fetching clients
include 'scripts/fetchClients.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Contacts</title>
    <link rel="stylesheet" href="assets/styleSheet.css">
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
                    <button id="addButton" class="button" onclick="handleButtonClick()">
                        Add Contact
                    </button>
                </div>
                <h2 class="text-xl font-semibold mb-4">Clients List</h2>
                <table id="clientsList" class="w-full table-auto border-collapse">
                    <thead class="bg-black text-white">
                        <tr>

                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Code</th>
                            <th class="px-4 py-2">Number of Contacts</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if clients are available
                        if (isset($clients) && !empty($clients)) {
                            // Loop through clients and display their details
                            foreach ($clients as $index => $client) {
                                // Alternate row colors using Tailwind's odd and even row classes
                                $rowClass = $index % 2 === 0 ? 'bg-gray-100' : 'bg-white';
                                echo "<tr class='{$rowClass}'>";

                                // Display client Name
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($client['Name']) . "</td>";

                                // Display client Code or "No code"
                                echo "<td class='px-4 py-2'>" . (empty($client['Client_code']) ? 'No code' : htmlspecialchars($client['Client_code'])) . "</td>";

                                // Display Number of Contacts or "No contacts"
                                echo "<td class='px-4 py-2'>" . (empty($client['Number_of_contacts']) ? 'No Linked Contacts' : htmlspecialchars($client['Number_of_contacts'])) . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            // If no clients are available
                            echo "<tr><td colspan='5' class='text-center px-4 py-2'>No Clients Available.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="contactsContent" class="tab-content" style="display:none;">
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
                            // Loop through clients and display their details
                            foreach ($contacts as $index => $contact) {
                                // Alternate row colors using Tailwind's odd and even row classes
                                $rowClass = $index % 2 === 0 ? 'bg-gray-100' : 'bg-white';
                                echo "<tr class='{$rowClass}'>";

                                // Display client Name
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($client['Name']) . "</td>";

                                // Display client Surname
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($client['Surname']) . "</td>";

                                // Display client Email
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($client['Email']) . "</td>";


                                // Display Number of Number of linked clients or "No clients"
                                echo "<td class='px-4 py-2'>" . (empty($client['Number_of_clients']) ? 'No Linked Clients' : htmlspecialchars($client['Number_of_clients'])) . "</td>";

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

    <!-- Importing script.js -->
    <script src="js/script.js"></script>

</body>

</html>