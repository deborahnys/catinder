/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import "./catButton.js";
document.addEventListener("DOMContentLoaded", (event) => {
  setTimeout(() => {
    const flashMessage = document.getElementById("flash-message");
    if (flashMessage) {
      flashMessage.classList.add("fadeOut");
      // Après l'animation, cachons vraiment le message
      flashMessage.addEventListener(
        "transitionend",
        () => {
          flashMessage.style.display = "none";
        },
        { once: true }
      );
    }
  }, 5000);
});
