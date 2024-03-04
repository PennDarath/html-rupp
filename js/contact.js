document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname;
  const pageName = pathName.split("/").pop();

  if (pageName === "contact.php") {
    const homeLink = document.getElementById("contact");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-black");
    }
  }
  if (pageName === "contact.php") {
    const homeLink = document.getElementById("contact-nav");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-white", "bg-black");
    }
  }
});
