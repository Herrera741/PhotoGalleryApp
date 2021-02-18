const uploadFile = document.querySelector("#uploadFile");
const selectBtn = document.querySelector("#selectBtn");
const selectText = document.querySelector("#selectBtnText");

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