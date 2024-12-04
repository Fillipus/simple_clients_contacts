// Function to switch between tabs
function switchTab(tabName) {
  const clientsTab = document.getElementById("clientsTab");
  const contactsTab = document.getElementById("contactsTab");
  const clientsContent = document.getElementById("clientsContent");
  const contactsContent = document.getElementById("contactsContent");

  // Hide both content sections
  clientsContent.style.display = "none";
  contactsContent.style.display = "none";

  // Remove 'active' class from both tabs
  clientsTab.classList.remove("active");
  contactsTab.classList.remove("active");

  // Show the selected content and activate the corresponding tab
  if (tabName === "clients") {
    clientsContent.style.display = "block";
    clientsTab.classList.add("active");
  } else if (tabName === "contacts") {
    contactsContent.style.display = "block";
    contactsTab.classList.add("active");
  }
}

function switchTab(tabName) {
  // Hide all content sections
  const contents = document.querySelectorAll(".tab-content");
  contents.forEach((content) => (content.style.display = "none"));

  // Show the selected content
  const selectedContent = document.getElementById(tabName + "Content");
  if (selectedContent) {
    selectedContent.style.display = "block";
  }

  // Highlight the active tab
  const tabs = document.querySelectorAll(".tabs li");
  tabs.forEach((tab) => tab.classList.remove("active"));
  const activeTab = document.getElementById(tabName + "Tab");
  if (activeTab) {
    activeTab.classList.add("active");
  }
}

// Function to fetch clients data from PHP script
async function fetchClients() {
  try {
    const response = await fetch("scripts/fetchClients.php");
    const clients = await response.json();
    if (clients.error) {
      console.error("Error fetching Clients", clients.error);
      return;
    }

    // Populate clients list in the DOM
    const clientsList = document.getElementById("clientsList");
    // Clear previous data
    clientsList.innerHTML = "";
    clients.forEach((client) => {
      const li = document.createElement("li");
      li.textContent = `${client.Name} (Code: ${client.Client_code})`;
      clientsList.appendChild(li);
    });
  } catch (error) {
    console.error("Error fetching clients:", error);
  }
}

//fetchClients clients on page load
fetchClients();

// Set "clients" tab active and its content visible
document.addEventListener("DOMContentLoaded", function () {
  switchTab("clients");
});
