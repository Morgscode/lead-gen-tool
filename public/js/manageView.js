// --- UI CONTROLLER
const manageLeadUIController = (function() {
  const domElements = {
    notesTab: document.querySelector("#notes"),
    eventsTab: document.querySelector("#events"),
    meetingsTab: document.querySelector("#meetings"),
    notesPanel: document.querySelector("#notes-panel"),
    eventsPanel: document.querySelector("#events-panel"),
    meetingsPanel: document.querySelector("#meetings-panel"),
    noteForm: document.querySelector("#note-form"),
    showNoteForm: document.querySelector("#show-note-form"),
    closeNoteForm: document.querySelector("#close-note-form"),
    showEventForm: document.querySelector("#show-event-form"),
    closeEventForm: document.querySelector("#close-event-form"),
    showMeetingForm: document.querySelector("#show-meeting-form"),
    closeMeetingForm: document.querySelector("#close-meeting-form"),
    saveNote: document.querySelector("#save-note"),
    saveEvent: document.querySelector("#save-event"),
    saveMeeting: document.querySelector("#save-meeting")
  };

  const domInputs = {
    noteTitleInput: document.getElementsByName("note-title")[0],
    noteInput: document.getElementsByName("note")[0],
    eventNameInput: document.getElementsByName("event-name")[0],
    eventAddressInput: document.getElementsByName("event-address")[0],
    eventDateInput: document.getElementsByName("event-date")[0],
    eventTimeInput: document.getElementsByName("event-time")[0],
    eventNoteInput: document.getElementsByName("event-note")[0],
    meetingNameInput: document.getElementsByName("meeting-name")[0],
    meetingAddressInput: document.getElementsByName("meeting-address")[0],
    meetingDateInput: document.getElementsByName("meeting-date")[0],
    meetingTimeInput: document.getElementsByName("meeting-time")[0],
    meetingNoteInput: document.getElementsByName("meeting-note")[0]
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
    },
    getCurrentLeadID: function() {
      return domElements.noteForm.dataset.companyId;
    }
  };

  return {
    getDomElements: function() {
      return domElements;
    },
    getDomInputs: function() {
      return domInputs;
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
    },
    getLeadID: function() {
      return manageFormFunctions.getCurrentLeadID();
    }
  };
})();

// --- DATA CONTROLLER
const manageLeadDataController = (function() {
  class CoreDataModule {
    constructor(companyID, note) {
      this.companyID = companyID;
      this.note = note;
    }
  }

  class Note extends CoreDataModule {
    constructor(companyID, note, title) {
      super(companyID, note);
      this.title = title;
    }
  }

  class Event extends CoreDataModule {
    constructor(companyID, note, name, address, time, date) {
      super(companyID, note);
      this.name = name;
      this.address = address;
      this.time = time;
      this.date = date;
    }
  }

  class Meeting extends Event {
    constructor(companyID, note, name, address, time, date) {
      super(companyID, note, name, address, time, date);
    }
  }

  const ajaxPromise = (url, method) => {
    // return a new promise.
    return new Promise((resolve, reject) => {
      // do the usual XHR stuff
      var req = new XMLHttpRequest();

      req.open(method, url, true);
      req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      req.onload = () => {
        if (req.status == 200) {
          resolve(req.response);
        } else {
          reject({ status: req.status, statusText: req.statusText });
        }
      };
      // handle network errors
      req.onerror = () => {
        reject({ status: req.status, statusText: req.statusText });
      }; // make the request
      req.send();
    });
  };

  return {
    saveNote: function(companyID, noteContent, noteTitle) {
      const newNote = new Note(companyID, noteContent, noteTitle);
      return newNote;
    },
    saveEvent: function(
      companyID,
      eventNote,
      eventname,
      eventAddress,
      eventTime,
      eventDate
    ) {
      const event = new Event(
        companyID,
        eventNote,
        eventname,
        eventAddress,
        eventTime,
        eventDate
      );
      return event;
    },
    saveMeeting: function(
      companyID,
      meetingNote,
      meetingname,
      meetingAddress,
      meetingTime,
      meetingDate
    ) {
      const meeting = new Meeting(
        companyID,
        meetingNote,
        meetingname,
        meetingAddress,
        meetingTime,
        meetingDate
      );
      return meeting;
    },
    promiseRequest: function(url, action, data) {
      return ajaxPromise(url, action, data);
    }
  };
})();

// --- APP CONTROLLER
const manageLeadAppController = (function(uiCTRL, dataCTRL) {
  const manageLeadEventBox = () => {
    const domElements = uiCTRL.getDomElements();
    const domInputs = uiCTRL.getDomInputs();

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

    domElements.saveNote.addEventListener("click", () => {
      const currentLeadID = uiCTRL.getLeadID();
      const noteTitle = domInputs.noteTitleInput.value;
      const noteContent = domInputs.noteInput.value;
      let note = dataCTRL.saveNote(currentLeadID, noteContent, noteTitle);
      console.log(note);
      let url = `app/controllers/NoteController.php?action=addNote&title=${noteTitle}&note=${noteContent}&companyID=${currentLeadID}`;
      url = url.toString();
      console.log(url);
      dataCTRL.promiseRequest(url, "post").then(res => {
        console.log(res);
      });
    });

    domElements.saveEvent.addEventListener("click", () => {
      const currentLeadID = uiCTRL.getLeadID();
      const eventTitle = domInputs.eventNameInput.value;
      const eventNote = domInputs.eventNoteInput.value;
      const eventAddress = domInputs.eventAddressInput.value;
      const eventTime = domInputs.eventTimeInput.value;
      const eventDate = domInputs.eventDateInput.value;

      let event = dataCTRL.saveEvent(
        currentLeadID,
        eventNote,
        eventTitle,
        eventAddress,
        eventTime,
        eventDate
      );
      console.log(event);
    });

    domElements.saveMeeting.addEventListener("click", () => {
      const currentLeadID = uiCTRL.getLeadID();
      const meetingTitle = domInputs.meetingNameInput.value;
      const meetingNote = domInputs.meetingNoteInput.value;
      const meetingAddress = domInputs.meetingAddressInput.value;
      const meetingTime = domInputs.meetingTimeInput.value;
      const meetingDate = domInputs.meetingDateInput.value;

      let meeting = dataCTRL.saveMeeting(
        currentLeadID,
        meetingNote,
        meetingTitle,
        meetingAddress,
        meetingTime,
        meetingDate
      );
      console.log(meeting);
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
