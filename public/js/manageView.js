const manageLeadUIController = (function() {
  const domElements = {
    notesTab: document.querySelector("#notes"),
    eventsTab: document.querySelector("#events"),
    meetingsTab: document.querySelector("#meetings"),
    proposalsTab: document.querySelector("#proposals"),
    notesPanel: document.querySelector("#notes-panel"),
    eventsPanel: document.querySelector("#events-panel"),
    meetingsPanel: document.querySelector("#meetings-panel"),
    proposalsPanel: document.querySelector("#proposals-panel"),
    addNoteForm: document.querySelector("#note-form"),
    showNoteForm: document.querySelector("#show-note-form"),
    closeNoteForm: document.querySelector("#close-note-form")
  };

  const panelFunctions = {
    hidePanel: function() {
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
    },
    showActivePanel: function(e) {
      const newActiveTab = document.querySelector(`#${e.target.id}`);
      newActiveTab.classList.add("active");
      const newActivePanel = document.querySelector(`#${e.target.id}-panel`);
      newActivePanel.classList.remove("d-none");
      newActivePanel.classList.add("d-block");
    }
  };

  const manageFormFunctions = {
    evaluateTargetID: function(e) {
      const showBtnID = e.target.id;
      const formNameArray = showBtnID.split("-", 3);
      formNameArray.shift();
      const formTarget = formNameArray.join("-");
      return formTarget;
    },
    showForm: function(e) {
      const target = this.evaluateTargetID(e);
      document.querySelector(`#${target}`).classList.add("d-block");
    },
    hideForm: function(e) {
      const target = this.evaluateTargetID(e);
      document.querySelector(`#${target}`).classList.remove("d-block");
    }
  };

  return {
    getDomElements: function() {
      return domElements;
    },
    showPanel: function(e) {
      panelFunctions.hidePanel();
      panelFunctions.showActivePanel(e);
    },
    showAddForm: function(e) {
      manageFormFunctions.showForm(e);
    },
    hideAddForm: function(e) {
      manageFormFunctions.hideForm(e);
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

  class Event {
    constructor(name, address, time, date, note) {
      this.name = name;
      this.address = address;
      this.time = time;
      this.date = date;
      this.note = note;
    }
  }

  return {};
})();

const manageLeadAppController = (function(uiCTRL, dataCTRL) {
  const manageLeadEventBox = () => {
    const domElements = uiCTRL.getDomElements();

    const panelEventListeners = [
      domElements.notesTab.addEventListener("click", uiCTRL.showPanel),
      domElements.eventsTab.addEventListener("click", uiCTRL.showPanel),
      domElements.meetingsTab.addEventListener("click", uiCTRL.showPanel),
      domElements.proposalsTab.addEventListener("click", uiCTRL.showPanel),
      domElements.showNoteForm.addEventListener("click", uiCTRL.showAddForm),
      domElements.closeNoteForm.addEventListener("click", uiCTRL.hideAddForm)
    ];
  }; // manageLeadEventBox() end

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
