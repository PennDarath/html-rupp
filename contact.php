<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KorngJak</title>
  <link rel="icon" href="/img/korngjak-modified.png">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="css/contact.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="js/componets.js"></script>
  <style>
    @media (max-width: 1250px) {
      #custom-grid-cols {
        visibility: hidden;
        display: none;
      }

      #custom-column {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        justify-content: space-between;
        align-items: center;
        min-width: auto;
      }

      #custom-width {
        grid-column: span 12 / span 12;
      }
    }

    @media (min-width: 1690px) {
      #custom-column {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        justify-content: space-between;
        align-items: center;
        min-width: auto;
      }
    }

    @media (max-width: 890px) {
      #custom-grid-cols {
        visibility: hidden;
        display: none;
      }

      #custom-column {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        justify-content: space-between;
        align-items: center;
        min-width: auto;
      }

      #custom-width {
        grid-column: span 12 / span 12;
      }
    }

    @media (max-width: 500px) {
      #custom-grid-cols {
        visibility: hidden;
        display: none;
      }

      #custom-column {
        grid-template-columns: repeat(1, minmax(0, 1fr));
        justify-content: space-between;
        align-items: center;
        min-width: auto;
      }

      #custom-width {
        grid-column: span 12 / span 12;
      }
    }

    .scroll-bar::-webkit-scrollbar {
      width: 3px;
    }

    .scroll-bar::-webkit-scrollbar-thumb {
      background-color: black;
      border-radius: 6px;
    }

    .scroll-bar::-webkit-scrollbar-track {
      background-color: #f1f1f1;
    }

    .scroll-bar-main::-webkit-scrollbar {
      width: 0px;
    }

    .scroll-bar-main::-webkit-scrollbar-thumb {
      background-color: black;
      border-radius: 6px;
    }

    .scroll-bar-main::-webkit-scrollbar-track {
      background-color: #f1f1f1;
    }

    .input_rage {
      border-radius: 8px;
      height: 4px;
      outline: none;
      background-color: #000;
      color: #000;
      -webkit-appearance: none;
    }

    input[type="range"]::-webkit-slider-thumb {
      width: 12px;
      -webkit-appearance: none;
      height: 12px;
      background: black;
      border-radius: 10px;
    }

    #dropdown-color:active {
      background-color: #fff;
      color: #000;
      cursor: pointer;
      transition: background-color 4s, color 4s;

    }

    #icon-fill-product {
      color: black;
      -webkit-text-stroke-width: 0.1px;
      -webkit-text-stroke-color: white;

    }
  </style>
</head>

<body class="min-h-screen bg-white">
  <section class="flex border-b justify-between min-w-screen py-4 z-50  2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sticky top-0 bg-white">
    <div class="flex items-center gap-x-10 justify-between w-full">
      <div class="flex items-center gap-x-1">
        <img src="https://media.istockphoto.com/id/1162451364/vector/valknut-symbol-icon.jpg?s=612x612&w=0&k=20&c=h6Svj7Ddads1DVDf8wh_G2PJFhV4IJvO-ZSdpRDFrac=" alt="Logo" width="40px" height="40px" id="logo" class="border-none pb-3 rounded-full" />
        <p class="text-xl text-black font-medium">Korng Jak</p>
      </div>
      <div class="flex-1 max-sm:hidden relative">
        <input placeholder="Search" class="input w-full pl-11 h-11 text-sm bg-gray-100 text-black" />

        <span class="text-gray-400 absolute top-3 left-5 text-sm"><i class="fa fa-search"></i></span>
      </div>
      <ul class="flex items-center gap-x-1 max-lg:hidden">
        <nav>
          <ul class="flex gap-x-10">
            <li>
              <a id="home" href="index.php" class="text-sm">Home</a>
            </li>
            <li>
              <a id="products" href="products.php" class="text-sm">Product</a>
            </li>
            <a id="contact" href="contact.php" class="text-sm">Contact Us</a>
            <li></li>
          </ul>
        </nav>
        <div class="flex items-center gap-x-5">
          <li>
            <a href="#"><span class="text-black fill"><i id="icon-fill-product" class="fa fa-heart text-sm"></i></span></a>
          </li>
          <li>
            <a href="#"><span class="text-black"><i id="icon-fill-product" class="fa fa-shopping-cart text-sm" aria-hidden="true"></i></span></a>
          </li>
          <li>
            <a href="./login.php"><span class="text-black"><i id="icon-fill-product" class="fa fa-user text-sm" aria-hidden="true"></i></span></a>
          </li>
        </div>
      </ul>
      <div class="drawer z-50 lg:hidden w-fit flex justify-end">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
          <div class="w-full">
            <div class="lg:hidden">
              <label for="my-drawer-3" class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </label>
            </div>
          </div>
        </div>
        <div class="drawer-side">
          <label for="my-drawer-3" class="drawer-overlay"></label>
          <ul class="menu p-4 w-80 h-full bg-white">
            <div class="flex items-center justify-between pb-5">
              <div class="flex">
                <div></div>
                <p class="font-serif text-xl text-black font-bold cursor-default">
                  KorngJak
                </p>
              </div>
              <label for="my-drawer-3" class="drawer-overlay">
                <div class="cursor-pointer rounded-sm p-0.5 text-black">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </div>
              </label>
            </div>
            <li>
              <a id="home-nav" href="index.php" class="text-black mb-1 font-semibold hover:bg-black hover:text-white">Home</a>
            </li>
            <li>
              <a id="product-nav" href="products.php" class="text-black mb-1 font-semibold hover:bg-black hover:text-white">Products</a>
            </li>
            <li>
              <a id="contact-nav" href="contact.php" class="text-black mb-1 font-semibold hover:bg-black hover:text-white">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  </section>
  <section class="bg-stone-400/20  pt-[60px] pb-[40px] rounded-3xd 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5">
    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-5">
      <div>
        <h2 class="mb-4 font-bold text-2xl md:text-3xl text-black">
          Get in Touch With Us
        </h2>
        <p class=" text-sm md:text-base mb-6 text-zinc-950">
          Please feel free to contact us if you have any questions.
        </p>
        <form onsubmit="{yourSubmitFunction}" class="mb-6" novalidate="">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block mb-1 text-sm text-zinc-950">
                Name
                <input required type="text" name="name" placeholder="Enter your name" class="block p-2 mt-1 bg-white text-sm text-white w-full rounded-md" />
              </label>
            </div>
            <div>
              <label class="block mb-1 text-sm text-zinc-950">
                Email
                <input required type="email" name="email" placeholder="Enter your email " class="block p-2 mt-1 bg-white text-sm text-white w-full rounded-md" />
              </label>
            </div>
          </div>
          <div>
            <label class="block mb-1 text-sm text-zinc-950 mt-2">
              Subject
              <select required name="subject" class="p-2 bg-white mt-1 text-sm text-gray-500 rounded-md w-full">
                <option>Ask a Question</option>
                <option>Request a Quotes</option>
                <option>Something else</option>
              </select>
            </label>
          </div>
          <label class="block mb-1 text-sm text-zinc-950 bg-white  rounded-md">
            <textarea placeholder="Enter your message" required name="message" rows="3" class="w-full bg-white p-2 mt-1 text-sm text-black rounded-md"></textarea>
          </label>
          <button type="submit" class="w-full mt-4 px-4 py-2 text-sm md:text-base rounded-md border text-black border-transparent bg-white font-medium hover:border hover:border-white hover:bg-black hover:text-white flex justify-center">
            Submit
          </button>
        </form>
      </div>

      <!-- <div class="mt-6">
        <div class="contents">
          <div class="left-side text-2xl">
            <div class="address details">
              <div class="flex items-center gap-x-1 mt-2">

                <i class="fas fa-map-marker-alt text-xl text-red-900"></i>
                <div class="topic font-bold text-red-900 ">A</div>
              </div>
              <div class="text-base text-zinc-950">Poipet, KH11</div>
              <div class="text-base text-zinc-950">7makara 33</div>
            </div>
            <div class="phone details">
              <div class="flex items-center gap-x-1 mt-2">
                <i class="fas fa-phone-alt text-xl text-red-900"></i>
                <div class="topic font-bold text-red-900 ">Phone</div>
              </div>
              <div class="text-base text-zinc-950">+855123456789</div>
              <div class="text-base text-zinc-950">+855123456789</div>
            </div>
            <div class="email details">
              <div class="flex items-center gap-x-1 mt-2">
                <i class="fas fa-envelope text-xl text-red-900 "></i>
                <div class="topic font-bold  text-red-900">Email</div>
              </div>
              <div class="text-base text-zinc-950">coidiii@gmail.com</div>
              <div class="text-base text-zinc-950">info.dkkoooo@gmail.com</div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="   min-w-full h-full">
        <div class=" ">

          <iframe class=" rounded-md w-full rounded-lg " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d292.6304367381881!2d104.89866464206008!3d11.56438331891097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109510c8f54157b%3A0x687e6fdc9413c323!2s176b%20St%20150%2C%20Phnom%20Penh!5e0!3m2!1sen!2skh!4v1617642120248!5m2!1sen!2skh" width="100%" height="400px" frameborder="0" allowfullscreen loading="lazy"></iframe>
        </div>
      </div>

    </div>

  </section>



  <my-footer> </my-footer>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
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
  </script>

</body>

</html>