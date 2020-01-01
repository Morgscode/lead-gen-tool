// -- UPDATE VIEW
const updateLeadUIController = (function() {
  const evaluateUpdateButtons = () => {
    if (domElements.updateFormButtons.classList.contains("d-none")) {
      domElements.updateFormButtons.classList.remove("d-none");
    }
  };

  const domElements = {
    updateForm: document.querySelector("#update-lead-form"),
    updateFormFields: document.querySelector("#update-form-fields"),
    closeFieldIcon: document.querySelector(".close-field"),
    updateFormButtons: document.querySelector("#update-buttons"),
    updateCompanyName: document.querySelector("#company-name"),
    updateContactName: document.querySelector("#company-contact"),
    updateContactRole: document.querySelector("#contact-role"),
    updateContactEmail: document.querySelector("#contact-email"),
    currentCompanyName: document.querySelector("#current-company-name"),
    currentCompanyContact: document.querySelector("#current-company-contact"),
    currentContactRole: document.querySelector("#current-contact-role"),
    currentContactEmail: document.querySelector("#current-contact-email")
  };

  const createFormHTMLFunctions = {
    createFormGroup: function(fieldID) {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");
      formGroup.id = `${fieldID}-group`;
      formGroup.style.position = "relative";
      return formGroup;
    },
    createLabel: function(labelParam) {
      let label = document.createElement("label");
      label.innerText = `Update ${labelParam}:`;
      return label;
    },
    createTextInput: function(
      placeHolderParam,
      domElementParam,
      formNameParam
    ) {
      let input = document.createElement("input");
      input.classList.add("form-control");
      input.setAttribute("type", "text");
      input.setAttribute(
        "placeholder",
        `Current ${placeHolderParam}: ${domElementParam.innerText}`
      );

      input.setAttribute("required", "required");
      input.setAttribute("name", formNameParam);
      return input;
    },
    createFormClose: function(groupID) {
      let closeIcon = document.createElement("i");
      closeIcon.classList.add("fas");
      closeIcon.classList.add("fa-times");
      closeIcon.id = `close-${groupID}`;
      closeIcon.classList.add("close-field");
      return closeIcon;
    }
  };

  const appendFormHTMLFunctions = {
    updateCompany: function() {
      const formClose = createFormHTMLFunctions.createFormClose("company-name");
      const formGroup = createFormHTMLFunctions.createFormGroup("company-name");
      formGroup.appendChild(formClose);

      const label = createFormHTMLFunctions.createLabel("company name");

      formGroup.appendChild(label);

      const input = createFormHTMLFunctions.createTextInput(
        "company name",
        domElements.currentCompanyName,
        "company-name"
      );

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateCompanyName.disabled = true;
    },
    updateCompanyContact: function() {
      const formClose = createFormHTMLFunctions.createFormClose(
        "company-contact"
      );

      const formGroup = createFormHTMLFunctions.createFormGroup(
        "company-contact"
      );

      formGroup.appendChild(formClose);

      const label = createFormHTMLFunctions.createLabel("company contact");

      formGroup.appendChild(label);

      const input = createFormHTMLFunctions.createTextInput(
        "contact name",
        domElements.currentCompanyContact,
        "contact-name"
      );

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateContactName.disabled = true;
    },
    updateCompanyContactRole: function() {
      const formClose = createFormHTMLFunctions.createFormClose("contact-role");

      const formGroup = createFormHTMLFunctions.createFormGroup("contact-role");

      formGroup.appendChild(formClose);

      const label = createFormHTMLFunctions.createLabel("contact role");

      formGroup.appendChild(label);

      const input = createFormHTMLFunctions.createTextInput(
        "contact role",
        domElements.currentContactRole,
        "contact-role"
      );

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateContactRole.disabled = true;
    },
    updateCompanyContactEmail: function() {
      const formClose = createFormHTMLFunctions.createFormClose(
        "contact-email"
      );

      const formGroup = createFormHTMLFunctions.createFormGroup(
        "contact-email"
      );

      formGroup.appendChild(formClose);

      const label = createFormHTMLFunctions.createLabel("contact email");

      formGroup.appendChild(label);

      const input = createFormHTMLFunctions.createTextInput(
        "contact email",
        domElements.currentContactEmail,
        "contact-email"
      );

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateContactEmail.disabled = true;
    }
  };

  const unDisableFormFieldAdd = targetID => {
    const targetInputArr = targetID.split("-", 3);
    targetInputArr.pop();
    const buttonID = targetInputArr.join("-");
    const targetButton = document.querySelector(`#${buttonID}`);
    targetButton.disabled = false;
  };

  const removeFormHTMLFunctions = {
    removeUpdateFormField: function(e) {
      const formGroup = domElements.updateFormFields;

      const targetID = e.path[1].id;

      const targetEL = document.querySelector(`#${targetID}`);

      formGroup.removeChild(targetEL);

      unDisableFormFieldAdd(targetID);
    }
  };

  return {
    getDomInputs: function() {
      return domElements;
    },
    generateFormHTMLFunctions: function() {
      return appendFormHTMLFunctions;
    },
    destroyFormHTMLFunctions: function() {
      return removeFormHTMLFunctions;
    }
  };
})();

// -- UPDATE CONTROLLER
const updateLeadAppController = (function(uiCTRL) {
  const updateLeadEventBox = () => {
    let domInterface = uiCTRL.getDomInputs();
    let appendFormHtml = uiCTRL.generateFormHTMLFunctions();
    let removeFormHtml = uiCTRL.destroyFormHTMLFunctions();

    const eventListeners = [
      domInterface.updateCompanyName.addEventListener(
        "click",
        appendFormHtml.updateCompany
      ),
      domInterface.updateContactName.addEventListener(
        "click",
        appendFormHtml.updateCompanyContact
      ),
      domInterface.updateContactRole.addEventListener(
        "click",
        appendFormHtml.updateCompanyContactRole
      ),
      domInterface.updateContactEmail.addEventListener(
        "click",
        appendFormHtml.updateCompanyContactEmail
      ),
      domInterface.updateForm.addEventListener("click", e => {
        if (e.target.classList.contains("close-field")) {
          removeFormHtml.removeUpdateFormField(e);
        }
      })
    ];

    return eventListeners;
  }; // eventbox() end

  return {
    init: function() {
      console.log("update lead js scripts running");
      updateLeadEventBox();
    } // init fn() close
  };
})(updateLeadUIController);

if (window.location.pathname === "/leadGenTool/update-lead") {
  updateLeadAppController.init();
}
