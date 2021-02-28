// form fields
const form = document.querySelector('.form');
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
  }
  else {
    photoTitle.setAttribute("style", "border: 5px solid #2ecc71;");
    errorMessage.style.visibility = "hidden";
    successIcon.style.visibility = "visible";
    errorIcon.style.visibility = "hidden";
  }
}

function validatePhotoDate() {
  let errorMessage = document.querySelector("#error2");
  let errorIcon = document.querySelector("#date-times");
  let successIcon = document.querySelector("#date-check");
  
  if (photoDate.value.trim() == "") {
    photoDate.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
  }
  else {
    photoDate.setAttribute("style", "border: 5px solid #2ecc71;");
    errorMessage.style.visibility = "hidden";
    successIcon.style.visibility = "visible";
    errorIcon.style.visibility = "hidden";
  }
}

function validatePhotographer() {
  let errorMessage = document.querySelector("#error3");
  let errorIcon = document.querySelector("#name-times");
  let successIcon = document.querySelector("#name-check");
  let nameValue = photographer.value.trim();
  if (nameValue == "") {
    photographer.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
  }
  else {
    photographer.setAttribute("style", "border: 5px solid #2ecc71;");
    errorMessage.style.visibility = "hidden";
    successIcon.style.visibility = "visible";
    errorIcon.style.visibility = "hidden";
  }
}

function validateLocation() {
  let errorMessage = document.querySelector("#error4");
  let errorIcon = document.querySelector("#location-times");
  let successIcon = document.querySelector("#location-check");
  if (photoLocation.value.trim() == "") {
    photoLocation.setAttribute("style", "border: 5px solid #e74c3c;");
    errorIcon.style.visibility = "visible";
    successIcon.style.visibility = "hidden";
    errorMessage.style.visibility = "visible";
    errorMessage.style.color = "#e74c3c";
  }
  else {
    photoLocation.setAttribute("style", "border: 5px solid #2ecc71;");
    errorMessage.style.visibility = "hidden";
    successIcon.style.visibility = "visible";
    errorIcon.style.visibility = "hidden";
  }
}

// selecting a file...
selectBtn.addEventListener("click", function() {
    uploadFile.click();
});

uploadFile.addEventListener("change", function() {
  if (uploadFile.files) {
    selectText.innerHTML = uploadFile.files[0].name;
  } else {
    selectText.innerHTML = "No file selected";
  }
});