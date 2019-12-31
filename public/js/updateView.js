// -- UPDATE VIEW
const updateUIController = (function() {
  const evaluateUpdateButtons = () => {
    if (domElements.updateFormButtons.classList.contains("d-none")) {
      domElements.updateFormButtons.classList.remove("d-none");
    }
  };

  const domElements = {
    updateForm: document.querySelector("#update-lead-form"),
    updateFormFields: document.querySelector("#update-form-fields"),
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
    createFormGroup: function() {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");
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
    }
  };

  const appendFormHTMLFunctions = {
    updateCompany: function() {
      const formGroup = createFormHTMLFunctions.createFormGroup();

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
      const formGroup = createFormHTMLFunctions.createFormGroup();

      const label = createFormHTMLFunctions.createLabel("company contact");

      formGroup.appendChild(label);

      const input = createFormHTMLFunctions.createTextInput(
        "company contact",
        domElements.currentCompanyContact,
        "company-contact"
      );

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateContactName.disabled = true;
    },
    updateCompanyContactRole: function() {
      const formGroup = createFormHTMLFunctions.createFormGroup();

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
      const formGroup = createFormHTMLFunctions.createFormGroup();

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

  return {
    getDomInputs: function() {
      return domElements;
    },
    generateFormHTMLFunctions: function() {
      return appendFormHTMLFunctions;
    }
  };
})();

// -- UPDATE CONTROLLER
const updateAppController = (function(uiCTRL) {
  const updateLeadEventBox = () => {
    let domInterface = uiCTRL.getDomInputs();
    let appendFormHtml = uiCTRL.generateFormHTMLFunctions();

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
      )
    ];

    return eventListeners;
  }; // eventbox() end

  return {
    init: function() {
      console.log("update lead js scripts running");
      updateLeadEventBox();
    } // init fn() close
  };
})(updateUIController);

if (window.location.pathname === "/leadGenTool/update-lead") {
  updateAppController.init();
}
