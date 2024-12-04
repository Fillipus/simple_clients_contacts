// Function to switch between tabs
function switchTab(tabName) {
  const generalTab = document.getElementById("generalTab");
  const linkingTab = document.getElementById("linkingTab");
  const generalContent = document.getElementById("generalContent");
  const linkingContent = document.getElementById("linkingContent");

  // Hide both content sections
  generalContent.style.display = "none";
  linkingContent.style.display = "none";

  // Remove 'active' class from both tabs
  clientsTab.classList.remove("active");
  contactsTab.classList.remove("active");

  // Show the selected content and activate the corresponding tab
  if (tabName === "general") {
    generalContent.style.display = "block";
    generalTab.classList.add("active");
  } else if (tabName === "linking") {
    linkingContent.style.display = "block";
    linkingTab.classList.add("active");
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
