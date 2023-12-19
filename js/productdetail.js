document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname;
  const pageName = pathName.split("/").pop();

  if (pageName === "productdetail.html") {
    const homeLink = document.getElementById("products");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-black");
    }
  }
});
