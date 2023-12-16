document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname;
  const pageName = pathName.split("/").pop();
  if (pageName === "index.html") {
    const homeLink = document.getElementById("home");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-black");
    }
  }
});
