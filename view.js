/*

feature not implemented as I want to seperate the view where leads are added, and displayed

const viewController = (function() {
  const domElements = {
    leadForm: document.querySelector("#addLead"),
    formBtn: document.querySelector("#formDisplay"),
    formClose: document.querySelector(".form-close")
  };

  const viewMethods = {
    showForm: function() {
      if (!domElements.leadForm.classList.contains("active")) {
        domElements.leadForm.style.display = "block";
        domElements.leadForm.classList.add("active");
      }
    },
    hideForm: function() {
      if (domElements.leadForm.classList.contains("active")) {
        domElements.leadForm.style.display = "none";
        domElements.leadForm.classList.remove("active");
      }
    }
  };

  const eventListeners = [
    domElements.formBtn.addEventListener("click", viewMethods.showForm),
    domElements.formClose.addEventListener("click", viewMethods.hideForm)
  ];

  return eventListeners;
})();
