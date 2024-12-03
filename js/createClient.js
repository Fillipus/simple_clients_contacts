// Handle client form submission
async function handleClientFormSubmit(event) {
  event.preventDefault(); // Prevent default form submission

  const clientName = document.getElementById("clientName")?.value;

  if (!clientName) {
    alert("Please enter a client name.");
    return;
  }

  console.log("Saving client:", clientName);

  try {
    const response = await fetch("scripts/saveClient.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ clientName }),
    });

    const data = await response.json();
    console.log("Save client response:", data);

    if (data.success) {
      alert("Client created successfully!");
      lastCreatedClientId = data.clientId; // Store the client ID for linking
      console.log("New client ID:", lastCreatedClientId);
      switchTab("linking"); // Switch to linking tab
    } else {
      alert("Error creating client: " + data.message);
    }
  } catch (error) {
    alert("An error occurred while saving the client: " + error.message);
  }
}

document
  .getElementById("clientForm")
  .addEventListener("submit", handleClientFormSubmit);

// Handle form submission for linking contact
function handleLinkingFormSubmit(event) {
  event.preventDefault();

  const contactName = document.getElementById("contactName").value;
  const contactSurname = document.getElementById("contactSurname").value;
  const contactEmail = document.getElementById("contactEmail").value;
  const clientId = document.getElementById("linkingTab").dataset.clientId;

  fetch("scripts/linkContact.php", {
    method: "POST",
    body: JSON.stringify({
      contactName: contactName,
      contactSurname: contactSurname,
      contactEmail: contactEmail,
      Client_id: clientId,
    }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Contact linked successfully!");
      } else {
        alert("Error linking contact: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error linking contact:", error);
    });
}

