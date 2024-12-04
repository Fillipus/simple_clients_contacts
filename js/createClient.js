let isSubmitting = false;
async function handleClientFormSubmit(event) {
  event.preventDefault();

  if (isSubmitting) {
    return;
  }

  isSubmitting = true;

  const clientName = document.getElementById("clientName")?.value;

  if (!clientName) {
    alert("Please enter a client name.");
    isSubmitting = false;
    return;
  }

  try {
    const response = await fetch("scripts/saveClient.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ clientName }),
    });

    const data = await response.json();
    if (data.success) {
      lastCreatedClientId = data.clientId;
      switchTab("linking");
      showNotification("Client created successfully!", "success");
    } else {
      alert("Error creating client: " + data.message);
    }
  } catch (error) {
    alert("An error occurred while saving the client: " + error.message);
  } finally {
    isSubmitting = false;
  }
}

// Function to display notifications
function showNotification(message, type) {
  const notification = document.createElement("div");
  notification.className = `notification ${type}`;
  notification.innerText = message;

  document.body.appendChild(notification);

  // Remove notification after the fade-out animation
  setTimeout(() => {
    notification.remove();
  }, 4000);
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

