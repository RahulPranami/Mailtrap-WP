document.addEventListener("DOMContentLoaded", (event) => {
  // Get all tab buttons
  let tabButtons = Array.from(document.querySelectorAll("#default-tab button"));

  // Add click event listener to each tab button
  tabButtons.forEach((tabButton) => {
    tabButton.addEventListener("click", (event) => {
      let targetTabId = event.currentTarget.getAttribute("data-tabs-target");
      console.log(targetTabId);
      let targetTabPanel = document.querySelector(targetTabId);

      // Hide all tab panels
      let tabPanels = Array.from(
        document.querySelectorAll("#default-tab-content div.tab-content")
      );
      tabPanels.forEach((tabPanel) => {
        tabPanel.setAttribute("aria-hidden", "true");
        tabPanel.classList.add("hidden");
      });

      if (targetTabPanel) {
        // Show targeted tab panel
        targetTabPanel.setAttribute("aria-hidden", "false");
        targetTabPanel.classList.remove("hidden");
      }

      // Update aria-selected attribute for all tab buttons
      tabButtons.forEach((button) => {
        button.setAttribute("aria-selected", "false");
        button.classList.remove(
          "text-blue-600",
          "border-b-2",
          "border-blue-600",
          "active"
        );
      });

      // Set aria-selected to true for the clicked tab button
      event.currentTarget.setAttribute("aria-selected", "true");
      event.currentTarget.classList.add(
        "text-blue-600",
        "border-b-2",
        "border-blue-600",
        "active"
      );
    });
  });
});
