import { displayFlashMessage } from "./displayFlashMessage";

export function handleButtonClick(
  buttonSelector,
  endpoint,
  successMessage,
  errorMessage
) {
  document.querySelector(buttonSelector).addEventListener("click", () => {
    const catId = document
      .querySelector(buttonSelector)
      .getAttribute("data-cat-id");
    fetch(`/${endpoint}/${catId}`, { method: "POST" })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          displayFlashMessage(successMessage, "success");
          return fetch("/get_next_cat");
        } else {
          displayFlashMessage(errorMessage, "error");
          throw new Error(`Failed to ${endpoint} cat`);
        }
      })
      .then((response) => response.json())
      .then((data) => {
        document.getElementById("cat-picture").src = data.picture;
        document.getElementById("cat-name").textContent = data.name;
        document.getElementById("cat-race").textContent = data.race;
        document.getElementById("cat-age").textContent = data.age;
        document.getElementById("cat-localisation").textContent =
          data.localisation;
        document
          .querySelector(".like-button")
          .setAttribute("data-cat-id", data.id);
        document
          .querySelector(".dislike-button")
          .setAttribute("data-cat-id", data.id);
      });
  });
}

handleButtonClick(
  ".like-button",
  "like_cat",
  "Chat ajouté en favori!",
  "Une erreur s'est produite lors de l'ajout en favori."
);
handleButtonClick(
  ".dislike-button",
  "dislike_cat",
  "Chat non ajouté en favori!",
  "Une erreur s'est produite lors du non ajout en favori."
);
