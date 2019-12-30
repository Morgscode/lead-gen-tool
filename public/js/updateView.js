// -- VIEW
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

  const appendFormHTMLFunctions = {
    updateCompany: function() {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");

      let label = document.createElement("label");
      label.innerText = "Update company name:";

      formGroup.appendChild(label);

      let input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute(
        "placeholder",
        `Current company name: ${domElements.currentCompanyName.innerText}`
      );
      input.classList.add("form-control");
      input.setAttribute("required", "required");
      input.setAttribute("name", "company-name");

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateCompanyName.disabled = true;
    },
    updateCompanyContact: function() {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");

      let label = document.createElement("label");
      label.innerText = "Update company contact:";

      formGroup.appendChild(label);

      let input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute(
        "placeholder",
        `Current contact name: ${domElements.currentCompanyContact.innerText}`
      );
      input.classList.add("form-control");
      input.setAttribute("required", "required");
      input.setAttribute("name", "contact-name");

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateContactName.disabled = true;
    },
    updateCompanyContactRole: function() {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");

      let label = document.createElement("label");
      label.innerText = "Update contact role:";

      formGroup.appendChild(label);

      let input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute(
        "placeholder",
        `Current contact role: ${domElements.currentContactRole.innerText}`
      );
      input.setAttribute("required", "required");
      input.setAttribute("name", "contact-role");
      input.classList.add("form-control");

      formGroup.appendChild(input);

      domElements.updateFormFields.appendChild(formGroup);

      evaluateUpdateButtons();

      domElements.updateContactRole.disabled = true;
    },
    updateCompanyContactEmail: function() {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");

      let label = document.createElement("label");
      label.innerText = "Update contact email:";

      formGroup.appendChild(label);

      let input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute(
        "placeholder",
        `Current contact email: ${domElements.currentContactEmail.innerText}`
      );
      input.classList.add("form-control");
      input.setAttribute("required", "required");
      input.setAttribute("name", "company-contact-email");

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

// --- CONTROLLER
const updateAppController = (function(updateViewController) {
  const eventBox = () => {
    let domInterface = updateViewController.getDomInputs();
    let appendFormHtml = updateViewController.generateFormHTMLFunctions();

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
  }; // eventbox() end

  return {
    init: function() {
      console.log("update scripts running");
      eventBox();
    } // init fn() close
  };
})(updateUIController);

if (window.location.pathname === "/leadGenTool/update-lead") {
  updateAppController.init();
}
