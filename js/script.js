const uploadFile = document.querySelector("#fileToUpload");
const selectBtn = document.querySelector("#select-btn");
const selectText = document.querySelector("#select-btn-text");

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