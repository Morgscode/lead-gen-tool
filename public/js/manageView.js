const manageLeadUIController = (function() {
  const domElements = {
    notesTab: document.querySelector("#notes"),
    eventsTab: document.querySelector("#events"),
    meetingsTab: document.querySelector("#meetings"),
    proposalsTab: document.querySelector("#proposals"),
    notesPanel: document.querySelector("#notes-panel"),
    eventsPanel: document.querySelector("#events-panel"),
    meetingsPanel: document.querySelector("#meetings-panel"),
    proposalsPanel: document.querySelector("#proposals-panel")
  };

  const hidePanel = () => {
    const activeTab = document.querySelector("ul.nav-tabs a.nav-link.active");
    if (activeTab) {
      activeTab.classList.remove("active");
      const activeTabID = activeTab.id;
      const panelToHide = document.querySelector(`#${activeTabID}-panel`);
      panelToHide.classList.remove("d-block");
      panelToHide.classList.add("d-none");
    } else {
      return;
    }
  };

  return {
    getDomElements: function() {
      return domElements;
    },
    showPanel: function(e) {
      hidePanel();
      const newActiveTab = document.querySelector(`#${e.target.id}`);
      newActiveTab.classList.add("active");
      const newActivePanel = document.querySelector(`#${e.target.id}-panel`);
      newActivePanel.classList.remove("d-none");
      newActivePanel.classList.add("d-block");
    }
  };
})();

const manageLeadDataController = (function() {
  class Note {
    constructor(title, note, id) {
      this.title = title;
      this.note = note;
      this.companyID = id;
    }
  }
})();

const manageLeadAppController = (function() {
  const manageLeadEventBox = () => {
    const domElements = manageLeadUIController.getDomElements();

    const eventListeners = [
      domElements.notesTab.addEventListener(
        "click",
        manageLeadUIController.showPanel
      ),
      domElements.eventsTab.addEventListener(
        "click",
        manageLeadUIController.showPanel
      ),
      domElements.meetingsTab.addEventListener(
        "click",
        manageLeadUIController.showPanel
      ),
      domElements.proposalsTab.addEventListener(
        "click",
        manageLeadUIController.showPanel
      )
    ];

    return eventListeners;
  };

  return {
    init: function() {
      console.log("manage lead scripts running");
      manageLeadEventBox();
    }
  };
})(manageLeadUIController, manageLeadDataController);

if (window.location.pathname === "/leadGenTool/manage-lead") {
  manageLeadAppController.init();
}
