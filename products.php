<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$sql = "SELECT product_name, product_price, product_id, product_image FROM products";
$result = mysqli_query($con, $sql);


if (!$result) {
  echo "Error fetching data: " . mysqli_error($con);
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KorngJak</title>
  <link rel="icon" href="/img/korngjak-modified.png">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.14/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="./js/componets.js"></script>
  <style>
    @keyframes rotateAnimation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
#logo {
  animation: rotateAnimation 1s linear infinite;
}
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
      color: white;
      -webkit-text-stroke-width: 1.5px;
      -webkit-text-stroke-color: gray;

    }
  </style>


</head>

<body class=" bg-white w-screen h-[150vh] scroll-smooth ">
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
            <a href="#"><span class="text-black fill"><i id="icon-fill" class="fa fa-heart text-sm"></i></span></a>
          </li>
          <li>
            <a href="#"><span class="text-black"><i id="icon-fill" class="fa fa-shopping-cart text-sm" aria-hidden="true"></i></span></a>
          </li>
          <li>
            <a href="./login.php"><span class="text-black"><i id="icon-fill" class="fa fa-user text-sm" aria-hidden="true"></i></span></a>
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
  <div class="pb-10"></div>
  <main class=" main grid grid-cols-12 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 w-full h-[150vh] bg-white">
    <div id="custom-grid-cols" class="grid list flex-1 overflow-auto overflow-y-auto scroll-bar-main  col-span-3 pr-5 pb-5 grid items-start justify-start">
      <ul class="menu text-black w-full ">
        <li>
          <details open>
            <summary id="dropdown-color" class=" font-semibold border-b px-0 min-w-screen  rounded-none pr-1.5 hover:bg-white ">Price</summary>
            <div class="pt-5">
              <div class="flex w-full justify-between text-gray-500 ">
                <h1>From</h1>
                <h1>To</h1>
              </div>
              <div class="flex min-w-full justify-between mt-3 mb-2 ">
                <h1 class="border py-2 px-4 rounded-md w-16">0$</h1>
                <h1 id="result" class="border py-2 px-4 rounded-md w-16">0$</h1>
              </div>
              <input id="myinput" type="range" min="0" class="w-full input_rage " value="0" max="1400" />
            </div>
          </details>
          <details open class="mt-5 ">
            <summary id="dropdown-color" class="font-semibold  border-b px-0 rounded-none pr-1.5 hover:bg-white ">Brand</summary>
            <ul class=" h-[400px] px-0 mx-0">
              <div class="border-r mt-5 relative overflow-auto h-full scroll-bar ">
                <div class=" mr-5">
                  <input type="text" placeholder="Type here" class="input pl-11 input-bordered bg-white w-full" />
                </div>
                <div>
                  <span class="text-gray-400 absolute top-3 left-5 text-base"><i class="fa fa-search"></i></span>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox  border-gray-200" />
                    <span class="label-text text-black">Apple</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Samsung</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Xiaomi</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Poco</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">OPPO</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Honor</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Motorola</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">ROG</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Realme</span>
                  </label>
                </div>
              </div>

            </ul>
          </details>
          <details open class="mt-5">
            <summary id="dropdown-color" class="font-semibold border-b  px-0 rounded-none pr-1.5 hover:bg-white ">Build-in memory</summary>
            <ul class=" h-[300px] px-0 mx-0">
              <div class="border-r relative overflow-auto h-full scroll-bar mt-5">
                <div class=" mr-5">
                  <input type="text" placeholder="Type here" class="input pl-11 input-bordered bg-white w-full max-w-xs" />
                </div>
                <div>
                  <span class="text-gray-400 absolute top-3 left-5 text-base"><i class="fa fa-search"></i></span>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox  border-gray-200" />
                    <span class="label-text text-black">16GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">32GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">64GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">128GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">256GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">512GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">1TB</span>
                  </label>
                </div>
              </div>


            </ul>
          </details>
          <details open class="mt-5">
            <summary id="dropdown-color" class="font-semibold border-b px-0 rounded-none pr-1.5 hover:bg-white ">Installed RAM Size</summary>
            <ul class=" h-[300px] px-0 mx-0">
              <div class="border-r relative overflow-auto h-full scroll-bar mt-5">
                <div class=" mr-5">
                  <input type="text" placeholder="Type here" class="input pl-11 input-bordered bg-white w-full max-w-xs" />
                </div>
                <div>
                  <span class="text-gray-400 absolute top-3 left-5 text-base"><i class="fa fa-search"></i></span>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox  border-gray-200" />
                    <span class="label-text text-black">Up to 1.9 GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">2 to 3.9 GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">4 to 5.9 GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">6 to 7.9 GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">8 to 9.9 GB</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">10 GB & above</span>
                  </label>
                </div>
              </div>


            </ul>
          </details>
          <details open class="mt-5">
            <summary id="dropdown-color" class="font-semibold border-b mb-5 px-0 rounded-none pr-1.5 hover:bg-white ">Included Components</summary>
            <ul class=" h-[300px] px-0 mx-0">
              <div class="border-r relative overflow-auto h-full scroll-bar ">
                <div class=" mr-5">
                  <input type="text" placeholder="Type here" class="input pl-11 input-bordered bg-white w-full max-w-xs" />
                </div>
                <div>
                  <span class="text-gray-400 absolute top-3 left-5 text-base"><i class="fa fa-search"></i></span>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox  border-gray-200" />
                    <span class="label-text text-black">Phone Case</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Power Adapter</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Sim Tray Ejector</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">USB Cable</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Headset</span>
                  </label>
                </div>
                <div class="form-control pt-2">
                  <label class="label cursor-pointer flex justify-start gap-x-3">
                    <input type="checkbox" class="checkbox border-gray-200" />
                    <span class="label-text text-black">Screen Protector</span>
                  </label>
                </div>
              </div>


            </ul>
          </details>
        </li>
      </ul>
    </div>


    <div id="custom-width" class="grid list flex-1 overflow-auto items-start justify-center gap-x-5 col-span-9 w-full pb-5 scroll-bar-main overflow-y-auto min-h-screen flex-1">
      <div" id="custom-column" class="grid grid-cols-3 gap-5 sm:px-0 md:px-0 lg:px-5">
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            <?php
            $products = array();
            while ($row = mysqli_fetch_assoc($result)) {
              $products[] = $row;
            }
            echo "const products = " . json_encode($products) . ";";
            ?>
            const container = document.getElementById("custom-column");
            if (Array.isArray(products) && products.length > 0 && container) {
              container.innerHTML = "";
              const products = <?php echo json_encode($products); ?>;
              products.forEach(product => {
           const productHTML = `
  <a href="productdetail.php?id=${product.product_id}">
    <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
      <figure class="px-10 pt-10 ">
        <img src="img/${product.product_image}" alt="Product Image" class="rounded-xl object-fill w-fit h-fit">
      </figure>
      <div class="card-body w-full items-center justify-end text-center text-black  ">
        <p id="text-card" class="w-full h-12">${product.product_name}</p>
        <p class="card-title">${product.product_price}</p>
        <div class="card-actions w-full justify-center pt-1 hover:bg-white">
          <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
        </div>
      </div>
      <div class="absolute right-3 top-2 hover:cursor-pointer">
        <i id="icon-fill-product" class="justify-center  items-end grid fa fa-heart text-2xl" aria-hidden="true"></i>
      </div>
    </div>
  </a>
`;

                container.innerHTML += productHTML;
              });
            } else {
              console.error("No products found or container element not found.");
            }
          });
        </script>
    </div>
    </div>
  </main>
  <my-footer> </my-footer>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const slider = document.getElementById("myinput");
      const result = document.getElementById("result");

      slider.style.background = `linear-gradient(to right, black 0%, black ${
    ((slider.value - slider.min) / (slider.max - slider.min)) * 100
  }%, #DEE2E6 ${
    ((slider.value - slider.min) / (slider.max - slider.min)) * 100
  }%, #DEE2E6 100%)`;

      slider.oninput = function() {
        this.style.background = `linear-gradient(to right, black 0%, black ${
      ((this.value - this.min) / (this.max - this.min)) * 100
    }%, #DEE2E6 ${
      ((this.value - this.min) / (this.max - this.min)) * 100
    }%, #DEE2E6 100%)`;

        result.innerText = this.value + '$';
      };
    });
    document.addEventListener("DOMContentLoaded", function() {
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
  </script>
</body>

</html>