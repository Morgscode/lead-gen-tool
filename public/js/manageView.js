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
    companyNotesSection: document.querySelector("#company-notes"),
    companyMeetingSection: document.querySelector("#company-meetings"),
    companyEventSection: document.querySelector("#company-events"),
    showNoteForm: document.querySelector("#show-note-form"),
    closeNoteForm: document.querySelector("#close-note-form"),
    showEventForm: document.querySelector("#show-event-form"),
    closeEventForm: document.querySelector("#close-event-form"),
    showMeetingForm: document.querySelector("#show-meeting-form"),
    closeMeetingForm: document.querySelector("#close-meeting-form"),
    saveNote: document.querySelector("#save-note"),
    getNotes: document.querySelector("#see-notes"),
    getEvents: document.querySelector("#see-events"),
    getMeetings: document.querySelector("#see-meetings"),
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
      if (metaPanel.classList.contains("d-none")) {
        metaPanel.classList.remove("d-none");
      }
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
      const currentFormInputs = e.path[2].elements;
      for (const input of currentFormInputs) {
        input.value = "";
      }
    }
  };

  const createNoteHTMLFunctions = {
    createNoteWrapper: function(note) {
      const noteWrapper = document.createElement("div");
      noteWrapper.classList.add("card");
      noteWrapper.classList.add("col-md-10");
      noteWrapper.classList.add("col-sm-12");
      noteWrapper.classList.add("p-2");
      noteWrapper.classList.add("mb-3");
      noteWrapper.id = note.id;
      return noteWrapper;
    },
    createNoteTitle: function(note) {
      const title = document.createElement("h5");
      title.innerHTML = note.note_title;
      title.classList.add("mb-2");
      return title;
    },
    createNoteContent: function(note) {
      const content = document.createElement("p");
      content.innerHTML = note.note_content;
      content.classList.add("mb-2");
      return content;
    },
    createNoteTimeStamp: function(note) {
      const timeStamp = document.createElement("p");
      timeStamp.innerHTML = note.created_at;
      timeStamp.classList.add("mb-0");
      return timeStamp;
    }
  };

  const createEventHTMLFunctions = {
    createEventWrapper: function(event) {
      const eventWrapper = document.createElement("div");
      eventWrapper.classList.add("card");
      eventWrapper.classList.add("col-md-10");
      eventWrapper.classList.add("col-sm-12");
      eventWrapper.classList.add("p-2");
      eventWrapper.classList.add("mb-3");
      eventWrapper.id = event.id;
      return eventWrapper;
    },
    createEventTitle: function(event) {
      const title = document.createElement("h5");
      title.innerHTML = event.event_title;
      title.classList.add("mb-2");
      return title;
    },
    createEventAddress: function(event) {
      const address = document.createElement("h5");
      address.innerHTML = event.event_address;
      address.classList.add("mb-2");
      return address;
    },
    createEventTime: function(event) {
      const time = document.createElement("h5");
      time.innerHTML = event.event_time;
      time.classList.add("mb-2");
      return time;
    },
    createEventDate: function(event) {
      const date = document.createElement("h5");
      date.innerHTML = event.event_date;
      date.classList.add("mb-2");
      return date;
    },
    createEventNote: function(event) {
      const note = document.createElement("p");
      note.innerHTML = event.event_note;
      note.classList.add("mb-2");
      return note;
    },
    createEventTimeStamp: function(event) {
      const timeStamp = document.createElement("p");
      timeStamp.innerHTML = event.created_at;
      timeStamp.classList.add("mb-0");
      return timeStamp;
    }
  };

  const createMeetingHTMLFunctions = {
    createMeetingWrapper: function(meeting) {
      const meetingWrapper = document.createElement("div");
      meetingWrapper.classList.add("card");
      meetingWrapper.classList.add("col-md-10");
      meetingWrapper.classList.add("col-sm-12");
      meetingWrapper.classList.add("p-2");
      meetingWrapper.classList.add("mb-3");
      meetingWrapper.id = meeting.id;
      return meetingWrapper;
    },
    createMeetingTitle: function(meeting) {
      const title = document.createElement("h5");
      title.innerHTML = meeting.meeting_title;
      title.classList.add("mb-2");
      return title;
    },
    createMeetingAddress: function(meeting) {
      const address = document.createElement("h5");
      address.innerHTML = meeting.meeting_address;
      address.classList.add("mb-2");
      return address;
    },
    createMeetingTime: function(meeting) {
      const time = document.createElement("h5");
      time.innerHTML = meeting.meeting_time;
      time.classList.add("mb-2");
      return time;
    },
    createMeetingDate: function(meeting) {
      const date = document.createElement("h5");
      date.innerHTML = meeting.meeting_date;
      date.classList.add("mb-2");
      return date;
    },
    createMeetingNote: function(meeting) {
      const note = document.createElement("p");
      note.innerHTML = meeting.meeting_note;
      note.classList.add("mb-2");
      return note;
    },
    createMeetingTimeStamp: function(meeting) {
      const timeStamp = document.createElement("p");
      timeStamp.innerHTML = meeting.created_at;
      timeStamp.classList.add("mb-0");
      return timeStamp;
    }
  };

  const appendEvent = event => {
    const eventWrapper = createEventHTMLFunctions.createEventWrapper(event);
    const eventTitle = createEventHTMLFunctions.createEventTitle(event);
    const eventAddress = createEventHTMLFunctions.createEventAddress(event);
    const eventTime = createEventHTMLFunctions.createEventTime(event);
    const eventDate = createEventHTMLFunctions.createEventTime(event);
    const eventNote = createEventHTMLFunctions.createEventNote(event);
    const eventTimeStamp = createEventHTMLFunctions.createEventTimeStamp(event);
    const eventElements = [
      eventTitle,
      eventAddress,
      eventTime,
      eventDate,
      eventNote,
      eventTimeStamp
    ];
    eventElements.forEach(element => {
      eventWrapper.appendChild(element);
      domElements.companyEventSection.appendChild(eventWrapper);
    });
  };

  const appendMeeting = meeting => {
    const meetingWrapper = createMeetingHTMLFunctions.createMeetingWrapper(
      meeting
    );
    const meetingTitle = createMeetingHTMLFunctions.createMeetingTitle(meeting);
    const meetingAddress = createMeetingHTMLFunctions.createMeetingAddress(
      meeting
    );
    const meetingTime = createMeetingHTMLFunctions.createMeetingTime(meeting);
    const meetingDate = createMeetingHTMLFunctions.createMeetingTime(meeting);
    const meetingNote = createMeetingHTMLFunctions.createMeetingNote(meeting);
    const meetingTimeStamp = createMeetingHTMLFunctions.createMeetingTimeStamp(
      meeting
    );
    const meetingElements = [
      meetingTitle,
      meetingAddress,
      meetingTime,
      meetingDate,
      meetingNote,
      meetingTimeStamp
    ];
    meetingElements.forEach(element => {
      meetingWrapper.appendChild(element);
      domElements.companyEventSection.appendChild(meetingWrapper);
    });
  };

  const appendNote = note => {
    const noteWrapper = createNoteHTMLFunctions.createNoteWrapper(note);
    const noteTitle = createNoteHTMLFunctions.createNoteTitle(note);
    const noteContent = createNoteHTMLFunctions.createNoteContent(note);
    const noteTimeStamp = createNoteHTMLFunctions.createNoteTimeStamp(note);
    const noteElements = [noteTitle, noteContent, noteTimeStamp];
    noteElements.forEach(element => {
      noteWrapper.appendChild(element);
      domElements.companyNotesSection.appendChild(noteWrapper);
    });
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
    },
    appendCompanyNote: function(note) {
      return appendNote(note);
    },
    appendCompanyEvent: function(event) {
      return appendEvent(event);
    },
    appendCompanyMeeting: function(meeting) {
      return appendMeeting(meeting);
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
      eventName,
      eventAddress,
      eventTime,
      eventDate
    ) {
      const event = new Event(
        companyID,
        eventNote,
        eventName,
        eventAddress,
        eventTime,
        eventDate
      );
      return event;
    },
    saveMeeting: function(
      companyID,
      meetingNote,
      meetingName,
      meetingAddress,
      meetingTime,
      meetingDate
    ) {
      const meeting = new Meeting(
        companyID,
        meetingNote,
        meetingName,
        meetingAddress,
        meetingTime,
        meetingDate
      );
      return meeting;
    },
    promiseRequest: function(url, action) {
      return ajaxPromise(url, action);
    }
  };
})();

// --- APP CONTROLLER
const manageLeadAppController = (function(uiCTRL, dataCTRL) {
  const dataUiFunctions = {
    getAllNotes: function() {
      const currentLeadID = uiCTRL.getLeadID();
      let url = `app/controllers/NoteController.php?action=getNotes&id=${currentLeadID}`;
      url = url.toString();
      const notes = dataCTRL.promiseRequest(url, "get").then(res => {
        console.log(res);
        return res;
      });
      notes.then(data => {
        const notesArr = JSON.parse(data);
        notesArr.forEach(note => {
          uiCTRL.appendCompanyNote(note);
        });
      });
    },
    getAllEvents: function() {
      const currentLeadID = uiCTRL.getLeadID();
      let url = `app/controllers/EventController.php?action=getEvents&id=${currentLeadID}`;
      url = url.toString();
      const events = dataCTRL.promiseRequest(url, "get").then(res => {
        console.log(res);
        return res;
      });
      events.then(data => {
        const eventsArr = JSON.parse(data);
        eventsArr.forEach(event => {
          uiCTRL.appendCompanyEvent(event);
        });
      });
    },
    getAllMeetings: function() {
      const currentLeadID = uiCTRL.getLeadID();
      let url = `app/controllers/MeetingController.php?action=getMeetings&id=${currentLeadID}`;
      url = url.toString();
      const meetings = dataCTRL.promiseRequest(url, "get").then(res => {
        console.log(res);
        return res;
      });
      meetings.then(data => {
        const meetingsArr = JSON.parse(data);
        meetingsArr.forEach(meeting => {
          uiCTRL.appendCompanyMeeting(meeting);
        });
      });
    },
    postNote: function(note) {
      let url = `app/controllers/NoteController.php?action=addNote&title=${note.title}&note=${note.note}&companyID=${note.companyID}`;
      url = url.toString();
      dataCTRL.promiseRequest(url, "post").then(res => {
        console.log(res);
      });
    },
    postEvent: function(event) {
      let url = `app/controllers/EventController.php?action=addEvent&companyID=${event.companyID}&title=${event.name}&address=${event.address}&time=${event.time}&date=${event.date}&note=${event.note}`;
      url = url.toString();
      dataCTRL.promiseRequest(url, "post").then(res => {
        console.log(res);
      });
    },
    postMeeting: function(meeting) {
      let url = `app/controllers/MeetingController.php?action=addMeeting&companyID=${meeting.companyID}&title=${meeting.name}&address=${meeting.address}&time=${meeting.time}&date=${meeting.date}&note=${meeting.note}`;
      url = url.toString();
      dataCTRL.promiseRequest(url, "post").then(res => {
        console.log(res);
      });
    }
  };

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
      e.target.innerHTML = "Refresh notes";
      domElements.companyNotesSection.style.minHeight = "450px";
      domElements.companyNotesSection.innerHTML = "";
      dataUiFunctions.getAllNotes();
      uiCTRL.showAddMetaPanel(e);
    });

    // grab data functions
    domElements.getEvents.addEventListener("click", e => {
      e.target.innerHTML = "Refresh events";
      domElements.companyEventSection.style.minHeight = "450px";
      domElements.companyEventSection.innerHTML = "";
      dataUiFunctions.getAllEvents();
      uiCTRL.showAddMetaPanel(e);
    });

    // save data functions
    domElements.saveNote.addEventListener("click", e => {
      const currentLeadID = uiCTRL.getLeadID();
      const noteTitle = domInputs.noteTitleInput.value;
      const noteContent = domInputs.noteInput.value;
      let note = dataCTRL.saveNote(currentLeadID, noteContent, noteTitle);
      dataUiFunctions.postNote(note);
      uiCTRL.clearForm(e);
    });

    domElements.saveEvent.addEventListener("click", e => {
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
      dataUiFunctions.postEvent(event);
      uiCTRL.clearForm(e);
    });

    domElements.saveMeeting.addEventListener("click", e => {
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
      dataUiFunctions.postMeeting(meeting);
      uiCTRL.clearForm(e);
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
