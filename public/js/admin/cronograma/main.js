const upload__form = document.querySelector("#upload__form");
const upload__file = document.querySelector("#upload__file");
const upload__button = document.querySelector("#upload__button");
const feedbackMessage = document.querySelector("#feedbackMessage");
let validFile = false;
let timeoutToSave = "";
let lastName = "";
let lastType = "";

upload__button.onclick = () => {
  upload__file.click();
};

upload__form.onSubmit = (e) => {
  let file = upload__file.files[0];
  /**
    Checks if variable validFile is false
    The last uploaded file name and type is equal to the current one
    The type of the file is valid 
  */
  if (
    !validFile ||
    (lastName == file.name && lastType == file.type) ||
    type.split("/")[1] !== "vnd.openxmlformats-officedocument.spreadsheetml.sheet"
  ) {
    feedbackMessage.innerText = "Faça upload de um arquivo EXCEL .xlsx";
    feedbackMessage.classList.add("error");
    enable(feedbackMessage);
    e.preventDefault();
    return;
  }
};

upload__file.oninput = (e) => {
  clearTimeout(timeoutToSave);
  validFile = false;
  let file = upload__file.files[0];

  lastName = file.name;
  lastType = file.type;
  fileHandler(file, lastName, lastType);
};

function enable(element) {
  element.style.display = "";
  element.removeAttribute("aria-disabled");
}

function disable(element) {
  element.style.display = "none";
  element.setAttribute("aria-disabled", "true");
}

function fileHandler(file, name, type) {
  enable(feedbackMessage);

  if (type.split("/")[1] !== "vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
    feedbackMessage.innerText = "Faça upload de um arquivo EXCEL";
    feedbackMessage.classList.add("error");
    return false;
  }

  feedbackMessage.classList = "icons after loading";
  feedbackMessage.innerText = "Arquivo válido, carregando";

  timeoutToSave = setTimeout(() => {
    upload__form.submit();
  }, 1000);
}
