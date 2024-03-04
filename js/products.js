//sldider
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.getElementById("myinput");
  const result = document.getElementById("result");

  slider.style.background = `linear-gradient(to right, black 0%, black ${
    ((slider.value - slider.min) / (slider.max - slider.min)) * 100
  }%, #DEE2E6 ${
    ((slider.value - slider.min) / (slider.max - slider.min)) * 100
  }%, #DEE2E6 100%)`;

  slider.oninput = function () {
    this.style.background = `linear-gradient(to right, black 0%, black ${
      ((this.value - this.min) / (this.max - this.min)) * 100
    }%, #DEE2E6 ${
      ((this.value - this.min) / (this.max - this.min)) * 100
    }%, #DEE2E6 100%)`;

      result.innerText = this.value  + '$';
  };
});


//pathname
  document.addEventListener("DOMContentLoaded", function () {
    const pathName = window.location.pathname;
      const pageName = pathName.split("/").pop();
           

    if (pageName === "products.php") {
      const homeLink = document.getElementById("products");
      if (homeLink) {
        homeLink.classList.add("font-bold", "text-black");
      }
    }
    if (pageName === "products.php") {
      const homeLink = document.getElementById("product-nav");
      if (homeLink) {
        homeLink.classList.add("font-bold", "text-white", "bg-black");
      }
    }
  
  });

 