// form input fields
const photoTitle = document.querySelector('#photoTitle');
const photoDate = document.querySelector('#photoDate');
const photographer = document.querySelector('#photographer');
const photoLocation = document.querySelector('#location');

// form footer actions
const uploadFile = document.querySelector("#uploadFile");
const selectBtn = document.querySelector("#selectBtn");
const selectText = document.querySelector("#selectBtnText");

// triggers
photoTitle.addEventListener("focusout", validatePhotoTitle);
photoDate.addEventListener("focusout", validatePhotoDate);
photographer.addEventListener("focusout", validatePhotographer);
photoLocation.addEventListener("focusout", validateLocation);

// boolean flags for each field
var titleFlag, dateFlag, nameFlag, locationFlag, fileFlag;
titleFlag = dateFlag = nameFlag = locationFlag = fileFlag = false;

// validate fields
function validatePhotoTitle() {
  let errorMessage = document.querySelector("#error1");
  let errorIcon = document.querySelector("#title-times");
  let successIcon = document.querySelector("#title-check");

  if (photoTitle.value.trim() == "") {
    photoTitle.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
    titleFlag = false
  }
  else {
    photoTitle.setAttribute("style", "border: 5px solid #2ecc71;");
    errorMessage.style.visibility = "hidden";
    successIcon.style.visibility = "visible";
    errorIcon.style.visibility = "hidden";
    titleFlag = true
  }
}

function validatePhotoDate() {
  let errorMessage = document.querySelector("#error2");
  let errorIcon = document.querySelector("#date-times");
  let successIcon = document.querySelector("#date-check");
  let dateValue = photoDate.value.trim();
  let re = /(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d/i;
  
  if (dateValue == "") {
    photoDate.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
    dateFlag = false
  }
  else {

    if (re.test(dateValue)) {
      photoDate.setAttribute("style", "border: 5px solid #2ecc71;");
      errorMessage.style.visibility = "hidden";
      successIcon.style.visibility = "visible";
      errorIcon.style.visibility = "hidden";
      dateFlag = true;
    }

  }
}

function validatePhotographer() {
  let errorMessage = document.querySelector("#error3");
  let errorIcon = document.querySelector("#name-times");
  let successIcon = document.querySelector("#name-check");
  let nameValue = photographer.value.trim();
  let regex = /^[a-z]+$/i;

  if (nameValue == "") {
    photographer.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
    nameFlag = false
  }
  else {
    if (regex.test(nameValue)) {
      photographer.setAttribute("style", "border: 5px solid #2ecc71;");
      errorMessage.style.visibility = "hidden";
      successIcon.style.visibility = "visible";
      errorIcon.style.visibility = "hidden";
      nameFlag = true;
    }  
  }
}

function validateLocation() {
  let errorMessage = document.querySelector("#error4");
  let errorIcon = document.querySelector("#location-times");
  let successIcon = document.querySelector("#location-check");
  let locationValue = photoLocation.value.trim();
  let regex = /^[a-z]+$/i;

  if (locationValue == "") {
    photoLocation.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
    locationFlag = false
  }
  else {
    if (regex.test(locationValue)) {
      photoLocation.setAttribute("style", "border: 5px solid #2ecc71;");
      errorMessage.style.visibility = "hidden";
      successIcon.style.visibility = "visible";
      errorIcon.style.visibility = "hidden";
      locationFlag = true
    }
  }
}

// selecting a file...
selectBtn.addEventListener("click", function() {
    uploadFile.click();
});

uploadFile.addEventListener("change", function() {
  if (uploadFile.files) {
    selectText.innerHTML = uploadFile.files[0].name;
    fileFlag = true;
  } else {
    selectText.innerHTML = "No file selected";
    fileFlag = false;
  }
});

// final check of form fields when user hits submit
function finalCheck() {
  if (!titleFlag || !dateFlag || !nameFlag || !locationFlag || !fileFlag) {
    return false;
  }
  else {
    return true;
  }
};