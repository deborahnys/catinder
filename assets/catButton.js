/* import { displayFlashMessage } from "./displayFlashmessage";

document.querySelector(".like-button").addEventListener("click", () => {
  const catId = document
    .querySelector(".like-button")
    .getAttribute("data-cat-id");
  fetch(`/like_cat/${catId}`, { method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        displayFlashMessage("Chat ajouté en favori!", "success");
        return fetch("/get_next_cat");
      } else {
        displayFlashMessage(
          "Une erreur s'est produite lors de l'ajout en favori.",
          "error"
        );
        throw new Error("Failed to like cat");
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
    })
    .catch((error) => console.error("Erreur:", error));
});

/* document.querySelector(".dislike-button").addEventListener("click", () => {
  const catId = document
    .querySelector(".dislike-button")
    .getAttribute("data-cat-id");
  fetch(`/dislike_cat/${catId}`, { method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        displayFlashMessage("Chat non ajouté en favori!", "success");
        return fetch("/get_next_cat");
      } else {
        displayFlashMessage(
          "Une erreur s'est produite lors de l'ajout en favori.",
          "error"
        );
        throw new Error("Failed to dislike cat");
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
        .querySelector(".dislike-button")
        .setAttribute("data-cat-id", data.id);
    })
    .catch((error) => console.error("Erreur:", error));
});
*/
