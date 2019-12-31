// --- UI CONTROLLER
const manageLeadUIController = (function() {
  const domElements = {
    notesTab: document.querySelector("#notes"),
    eventsTab: document.querySelector("#events"),
    meetingsTab: document.querySelector("#meetings"),
    //proposalsTab: document.querySelector("#proposals"),
    notesPanel: document.querySelector("#notes-panel"),
    eventsPanel: document.querySelector("#events-panel"),
    meetingsPanel: document.querySelector("#meetings-panel"),
    //proposalsPanel: document.querySelector("#proposals-panel"),
    noteForm: document.querySelector("#note-form"),
    showNoteForm: document.querySelector("#show-note-form"),
    closeNoteForm: document.querySelector("#close-note-form"),
    showEventForm: document.querySelector("#show-event-form"),
    closeEventForm: document.querySelector("#close-event-form"),
    showMeetingForm: document.querySelector("#show-meeting-form"),
    closeMeetingForm: document.querySelector("#close-meeting-form")
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
    showForm: function(e) {
      manageFormFunctions.showForm(e);
    },
    hideForm: function(e) {
      manageFormFunctions.hideForm(e);
    }
  };
})();

// --- DATA CONTROLLER
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
})();

// --- APP CONTROLLER
const manageLeadAppController = (function(uiCTRL, dataCTRL) {
  const manageLeadEventBox = () => {
    const domElements = uiCTRL.getDomElements();

    const panelEventListeners = [
      domElements.notesTab,
      domElements.eventsTab,
      domElements.meetingsTab
    ];

    panelEventListeners.forEach(element => {
      element.addEventListener("click", uiCTRL.showPanel);
    });

    const formEventListeners = [
      [
        domElements.showNoteForm,
        domElements.showEventForm,
        domElements.showMeetingForm
      ],
      [
        domElements.closeNoteForm,
        domElements.closeEventForm,
        domElements.closeMeetingForm
      ]
    ];

    formEventListeners[0].forEach(element => {
      element.addEventListener("click", uiCTRL.showForm);
    });
    formEventListeners[1].forEach(element => {
      element.addEventListener("click", uiCTRL.hideForm);
    });
  }; // manageLeadEventBox() end

  return {
    init: function() {
      console.log("manage lead js scripts running");
      manageLeadEventBox();
    }
  };
})(manageLeadUIController, manageLeadDataController);

if (window.location.pathname === "/leadGenTool/manage-lead") {
  manageLeadAppController.init();
}
