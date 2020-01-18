// --- UI CONTROLLER
const manageLeadUIController = (function() {
  //define domelements which allow for interactivity
  const domElements = {
    currentLeadForm: document.querySelector("#current-lead"),
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
    getNotes: document.querySelector("#see-notes"),
    saveEvent: document.querySelector("#save-event"),
    saveMeeting: document.querySelector("#save-meeting"),
    clearNoteForm: document.querySelector("#clear-note-form"),
    clearEventForm: document.querySelector("#clear-event-form"),
    clearMeetingForm: document.querySelector("#clear-meeting-form")
  };

  //define dom elements which hold data
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

  //define panel functions
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
    },
    showMetaPanel: function(e) {
      const metaPanel = e.target.parentNode.offsetParent.children[3];
      metaPanel.classList.remove("d-none");
    }
  };

  // define form functions
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
      return domElements.currentLeadForm.dataset.leadId;
    },
    clearCurrentForm: function(e) {
      const currentForm = e.path[2].elements;
      for (const childNode of currentForm) {
        childNode.value = "";
      }
    }
  };
  // make defined classes available
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
    showAddMetaPanel: function(e) {
      panelFunctions.showMetaPanel(e);
    },
    showForm: function(e) {
      manageFormFunctions.showForm(e);
    },
    hideForm: function(e) {
      manageFormFunctions.hideForm(e);
    },
    getLeadID: function() {
      return manageFormFunctions.getCurrentLeadID();
    },
    clearForm: function(e) {
      return manageFormFunctions.clearCurrentForm(e);
    }
  };
})();

// --- DATA CONTROLLER
const manageLeadDataController = (function() {
  // define client-side data models
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

  // define client-side ajax request
  let ajaxPromise = (url, method) => {
    // return a new promise.
    return new Promise((resolve, reject) => {
      // do the usual XHR stuff
      let xhr = new XMLHttpRequest();

      xhr.open(method, url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.setRequestHeader("Accept", "application/x-www-form-urlencoded");
      xhr.onload = () => {
        if (xhr.status == 200) {
          resolve(xhr.response);
        } else {
          reject({ status: xhr.status, statusText: xhr.statusText });
        }
      };
      // handle network errors
      xhr.onerror = () => {
        reject({ status: xhr.status, statusText: xhr.statusText });
      }; // make the request
      xhr.send();
    });
  };

  // make defined classes available
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
  //create an event listener box
  const manageLeadEventBox = () => {
    // make domInputs available to app controller
    const domElements = uiCTRL.getDomElements();
    const domInputs = uiCTRL.getDomInputs();

    // add event listners to panels
    const panelEventListeners = [
      domElements.notesTab,
      domElements.eventsTab,
      domElements.meetingsTab
    ];

    panelEventListeners.forEach(element => {
      element.addEventListener("click", uiCTRL.showPanel);
    });

    // add event listeners to forms
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
      ],
      [
        domElements.clearNoteForm,
        domElements.clearEventForm,
        domElements.clearMeetingForm
      ]
    ];

    formEventListeners[0].forEach(element => {
      element.addEventListener("click", uiCTRL.showForm);
    });
    formEventListeners[1].forEach(element => {
      element.addEventListener("click", uiCTRL.hideForm);
    });
    formEventListeners[2].forEach(element => {
      element.addEventListener("click", uiCTRL.clearForm);
    });

    // grab data functions
    domElements.getNotes.addEventListener("click", e => {
      const currentLeadID = uiCTRL.getLeadID();
      let url = `app/controllers/NoteController.php?action=getNotes&id=${currentLeadID}`;
      url = url.toString();
      const notes = dataCTRL.promiseRequest(url, "get").then(res => {
        return res;
      });
      notes.then(res => {
        const notesArr = JSON.parse(res);
        console.log(notesArr);
      });
      uiCTRL.showAddMetaPanel(e);
    });

    // save data functions
    domElements.saveNote.addEventListener("click", e => {
      const currentLeadID = uiCTRL.getLeadID();
      const noteTitle = domInputs.noteTitleInput.value;
      const noteContent = domInputs.noteInput.value;
      let note = dataCTRL.saveNote(currentLeadID, noteContent, noteTitle);
      let url = `app/controllers/NoteController.php?action=addNote&title=${note.title}&note=${note.note}&companyID=${note.companyID}`;
      url = url.toString();
      dataCTRL.promiseRequest(url, "post");
      uiCTRL.clearForm(e);
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
    //make event listeners available to window
    init: function() {
      console.log("manage lead js scripts running");
      manageLeadEventBox();
    }
  };
})(manageLeadUIController, manageLeadDataController);

if (window.location.pathname === "/leadGenTool/manage-lead") {
  manageLeadAppController.init();
}
