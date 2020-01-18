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
    updateContactName: document.querySelector("#contact-name"),
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
    },
    generateFormGroup: function(idParam, labelParam, inputParam, domElParam) {
      const formGroup = this.createFormGroup(idParam);
      const formClose = this.createFormClose(idParam);
      formGroup.appendChild(formClose);
      const label = this.createLabel(labelParam);
      formGroup.appendChild(label);
      const input = this.createTextInput(labelParam, inputParam, idParam);
      formGroup.appendChild(input);
      domElements.updateFormFields.appendChild(formGroup);
      evaluateUpdateButtons();
      domElParam.disabled = true;
      return formGroup;
    }
  };

  const appendFormHTMLFunctions = {
    updateCompany: function() {
      const group = createFormHTMLFunctions.generateFormGroup(
        "company-name",
        "company name",
        domElements.currentCompanyName,
        domElements.updateCompanyName
      );
      return group;
    },
    updateCompanyContact: function() {
      const group = createFormHTMLFunctions.generateFormGroup(
        "contact-name",
        "contact name",
        domElements.currentCompanyContact,
        domElements.updateContactName
      );
      return group;
    },
    updateCompanyContactRole: function() {
      const group = createFormHTMLFunctions.generateFormGroup(
        "contact-role",
        "contact role",
        domElements.currentContactRole,
        domElements.updateContactRole
      );
      return group;
    },
    updateCompanyContactEmail: function() {
      const group = createFormHTMLFunctions.generateFormGroup(
        "contact-email",
        "contact email",
        domElements.currentContactEmail,
        domElements.updateContactEmail
      );
      return group;
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
      console.log(targetEL);
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
