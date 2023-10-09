export function displayFlashMessage(message, type) {
  const flashMessage = document.getElementById("flash-message");
  const flashContent = document.getElementById("flash-content");

  flashMessage.classList.remove("hidden", "fadeOut");
  flashContent.textContent = message;

  if (type === "success") {
    flashMessage.style.backgroundColor = "#4CAF50";
  } else if (type === "error") {
    flashMessage.style.backgroundColor = "#f44336";
  }

  setTimeout(() => {
    flashMessage.classList.add("hidden");
  }, 3000);
}
