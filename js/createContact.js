let isSubmitting = false;

async function handleContactFormSubmit(event) {
    event.preventDefault();
  
    if (isSubmitting) {
      return;
    }
  
    isSubmitting = true;
  
    const contactName = document.getElementById("contactName")?.value;
    const contactSurname = document.getElementById("contactSurname")?.value;
    const Email = document.getElementById("contactEmail")?.value;
  
    if (!contactName || !contactSurname || !Email) {
      alert("All contact details are Required, Name, Surname and Email");
      isSubmitting = false;
      return;
    }
  
    try {
      const response = await fetch("scripts/saveContact.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ clientName }),
      });
  
      const data = await response.json();
      if (data.success) {
        showNotification("Contact created successfully!", "success");
      } else {
        alert("Error creating Contact: " + data.message);
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
    .getElementById("contactForm")
    .addEventListener("submit", handleContactFormSubmit);