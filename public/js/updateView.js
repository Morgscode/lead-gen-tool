const updateLeadController = (function() {
  const domElements = {
    updateForm: document.querySelector("#update-lead-form"),
    updateCompanyName: document.querySelector("#company-name"),
    updateContactName: document.querySelector("#company-contact"),
    updateContactRole: document.querySelector("#contact-role"),
    updateContactEmail: document.querySelector("#contact-email")
  };
  const appendFormHtml = {
    updateCompany: function() {
      let formGroup = document.createElement("div");
      formGroup.classList.add("form-group");
      let label = document.createElement("label");
      label.innerText = "Update company name:";
      formGroup.appendChild(label);
      domElements.updateForm.appendChild(formGroup);
    },
    test: function() {
      console.log("clicked");
    }
  };
  const eventListeners = [
    domElements.updateCompanyName.addEventListener(
      "click",
      appendFormHtml.updateCompany
    )
  ];
  return eventListeners;
})();
