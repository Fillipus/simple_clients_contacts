document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".unlink-button").forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();

      // Getting the clientId
      const clientId = button.getAttribute("data-client-id");

      if (!clientId) {
        alert("Client ID is missing.");
        return;
      }

      if (
        confirm("Are you sure you want to unlink all contacts for this client?")
      ) {
        try {
          const response = await fetch("scripts/unlinkContact.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ clientId }),
          });

          const data = await response.json();

          if (data.success) {
            alert("Contacts unlinked successfully!");
            // Refresh the page
            location.reload();
          } else {
            alert("Error unlinking contacts: " + data.message);
          }
        } catch (error) {
          alert("An error occurred: " + error.message);
        }
      }
    });
  });
});
