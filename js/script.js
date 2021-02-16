const fileInput = document.querySelector("#file-input")
const selectBtn = document.querySelector("#select-btn")
const selectText = document.getElementById("select-btn-text");

selectBtn.addEventListener("click", function() {
    fileInput.click();
});

fileInput.addEventListener("change", function() {
  if (fileInput.files) {
    selectText.innerHTML = fileInput.files[0].name;
  } else {
    selectText.innerHTML = "No file selected";
  }
});