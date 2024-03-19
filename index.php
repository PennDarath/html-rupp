<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// Check if user_id is set in session
if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT avatar FROM users WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $user_id);
    
    // Execute query
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $avatar = $row["avatar"];
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>KorngJak</title>
  <link rel="icon" href="/img/korngjak-modified.png">
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@4.4.14/dist/full.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/style.css" />
    

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <style>

#icon-user {
  color: white;
  -webkit-text-stroke-width: 1.5px;
  -webkit-text-stroke-color: black;
}
#icon-cart {
  color: white;
  -webkit-text-stroke-width: 1.5px;
  -webkit-text-stroke-color: black;
}
#icon-heart {
  color: white;
  -webkit-text-stroke-width: 1.5px;
  -webkit-text-stroke-color: black;
}
.active {
  background-color: red;
  color: red;
}
#icon-fill-product {
  color: white;
  -webkit-text-stroke-width: 1.5px;
  -webkit-text-stroke-color: gray;

}


    </style>
    <style>
      #icon-fill {
  color: black;
  -webkit-text-stroke-width: 0.1px;
  -webkit-text-stroke-color: white;

}
/* #icon-cart {
  color: white;
  -webkit-text-stroke-width: 1.5px;
  -webkit-text-stroke-color: black;
}
#icon-heart {
  color: white;
  -webkit-text-stroke-width: 1.5px;
  -webkit-text-stroke-color: black;
} */
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

#text-card {

  overflow: hidden;
  width: 100%;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

    </style>
   
  </head>

  <body class="min-h-screen bg-white w-screen scroll-smooth">
<!-- <my-navbar></my-navbar> -->
    <section
      class="flex border-b justify-between min-w-screen py-4 z-50  2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sticky top-0 bg-white"
    >
      <div class="flex items-center gap-x-10 justify-between w-full">
        <div class="flex items-center gap-x-1">

                   

          <p class="text-xl text-black font-medium">Korng Jakkk</p>
        </div>
        <div class="flex-1 max-sm:hidden relative">
          <input
            placeholder="Search"
            class="input w-full pl-11 h-11 text-sm bg-gray-100 text-black"
          />

          <span class="text-gray-400 absolute top-3 left-5 text-sm"
            ><i class="fa fa-search"></i
          ></span>
        </div>
        <ul class="flex items-center gap-x-1 max-lg:hidden">
          <nav>
            <ul class="flex gap-x-10">
              <li>
                <a id="home" href="index.php" class="text-sm">Home</a>
              </li>
              <li>
                <a id="products" href="products.php" class="text-sm"
                  >Product</a
                >
              </li>
              <a id="contact" href="contact.php" class="text-sm"
                >Contact Us</a
              >
              <li></li>
            </ul>
          </nav>
          <div class="flex items-center gap-x-5">
            <li>
              <a href="#"
                ><span class="text-black fill"
                  ><i id="icon-fill" class="fa fa-heart text-sm"></i></span
              ></a>
            </li>
            <li>
              <a href="#"
                ><span class="text-black"
                  ><i
                    id="icon-fill"
                    class="fa fa-shopping-cart text-sm"
                    aria-hidden="true"
                  ></i></span
              ></a>
            </li>
            <li>
              <a href="./login.php"
                >
             <?php 
if(isset($avatar)){
    echo '<img class="h-5 w-5 rounded-full" src="img/' . $avatar . '" alt="Avatar">';
} else {
    echo '<span class="text-black">
              <i id="icon-fill" class="fa fa-user text-sm" aria-hidden="true"></i>
          </span>';
}
?>

              
                </a>
            </li>
          </div>
        </ul>
        <div class="drawer z-50 lg:hidden w-fit flex justify-end">
          <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
          <div class="drawer-content flex flex-col">
            <div class="w-full">
              <div class="lg:hidden">
                <label for="my-drawer-3" class="btn btn-square btn-ghost">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 stroke-current"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"
                    ></path>
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
                  <p
                    class="font-serif text-xl text-black font-bold cursor-default"
                  >
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
    <section
      id="content"
      class="bg-[#0F0F0F] 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5"
    >
      <div
        class="w-full  max-md:flex-col flex justify-start max-md:pt-5 items-center "
      >
        <div
          class="text-white  w-screen max-md:justify-center max-md:pt-10 max-md:grid"
        >
          <p class="text-xl text-gray-500 max-md:text-center">Pro.Beyond</p>
          <h3 class="text-6xl pb-3 font-extralight max-md:text-center">
            IPhone 15 <b class="font-semibold max-md:text-center">Pro Max</b>
          </h3>
          <p class="text-base pb-4 text-gray-500 max-md:text-center">
            Created to change everything for the better. For everyone
          </p>
          <a class="max-md:justify-center max-md:grid" href="products.php"
            ><button
              class="btn text-white border-white bg-[#0F0F0F] hover:bg-[#fff] hover:text-black w-44 mt-3"
            >
              Shop now
            </button></a
          >
        </div>
        <div
          class="lg:pr-20  lg:pt-28 md:pt-20 max-md:w-60 max-md:pt-20 lg:w-[700px]"
        >
          <img
            class="max-md:pt-5"
            src="./img/Iphone Image.png"
            height="100%"
            width="100%"
            alt
          />
        </div>
      </div>
    </section>
    <section class="">
      <div class="min-md:flex-col lg:flex h-fit w-full lg:h-[600px]">
        <div
          class="lg:grid grid-rows-2 lg:grid-cols-2 lg:grid-flow-col lg:w-[50%] h-full"
        >
          <div
            class="lg:col-start-1 space-y-10 w-full h-full md:justify-start sm:justify-center items-center items-center min-sm:flex-col md:flex h-full lg:col-end-3 lg:row-start-1 lg:row-end-2"
          >
            <div
              class=" max-md:h-80 max-md:w-full max-md:flex max-md:justify-center h-72 lg:w-[50%] flex"
            >
              <img
                class="flex justify-center max-md:h-80 max-md:w-80 max-md:hidden"
                src="./img/PlayStation.png"
                height="100%"
                width="150%"
                alt
              />
              <img
                class="flex justify-center md:hidden "
                src="./img/PlayStation (1).png"
                height="100%"
                width="150%"
                alt
              />
            </div>

            <div class="lg:w-[50%] lg:pr-7 flex justify-center">
              <div class="max-md:px-5 ">

                <p class="text-3xl font-semibold text-black pb-3 text-start w-full">
                  Play Station 5
                </p>
                <p class="text-sm text-gray-500">
                  Incredibly powerful CPUs, GPUs, and an SSD with integrated I/O
                  will redefine your PlayStation experience.
                </p>
              </div>
            </div>
          </div>
          <div
            class="lg:row-start-2  max-md:my-20 lg:row-end-3 w-full h-full md:justify-start sm:justify-center items-center items-center min-sm:flex-col md:flex"
          >
            <div
              class="max-md:h-64 max-md:w-full md:pr-14 lg:pr-0 justify-center lg:h-74 lg:w-[30%] flex"
            >
              <img
              class="flex justify-center max-md:h-64 max-md:w-74 max-md:hidden"
                src="./img/hero__gnfk5g59t0qe_xlarge_2x 1.png"
                height="100%"
                width="150%"
                alt
              />
               <img
                class="flex justify-center md:hidden  max-md:h-72 max-md:w-80 "
                src="./img/hero__gnfk5g59t0qe_xlarge_2x 1 (1).png"
                height="100%"
                width="150%"
                alt
              />
            </div>
            <div class="lg:w-[70%] px-7 flex justify-center max-md:pt-10">
              <div>

                <p class="text-3xl font-extralight text-black pb-3">Apple</p>
                <p class="text-3xl font-extralight text-black pb-3">
                  AirPod
                  <span class="text-3xl font-semibold text-black">Max</span>
                </p>
                <p class="text-sm text-gray-500">
                  Computational audio. Listen, it's powerful
                </p>
              </div>
            </div>
          </div>
          <div
            class="lg:col-start-2 lg:h-full bg-black/80 md:h-[300px] lg:col-end-3 w-full md:justify-start sm:justify-center items-center items-center min-sm:flex-col md:flex"
          >
            <div
              class="max-md:h-64 max-md:w-full md:pr-14 lg:pr-0 justify-center lg:h-full lg:w-[40%] flex"
            >
              <img
                class="flex justify-center max-md:h-72 max-md:w-72 max-md:hidden"
                src="./img/image 36.png"
                height="100%"
                width="100%"
                alt
              />
                <img
                class="flex justify-center md:hidden  max-md:h-72 max-md:w-80 "
                src="./img/image 36 (1).png"
                height="100%"
                width="150%"
                alt
              />
            </div>
            <div class="lg:w-[60%] px-7 flex justify-center max-md:pb-10">
              <div>
                <p class="text-3xl font-extralight text-white pb-3">Apple</p>
                <p class="text-3xl font-extralight text-white pb-3">
                  Vision
                  <span class="text-3xl font-semibold text-white">Pro</span>
                </p>
                <p class="text-sm text-gray-400">
                  An immersive way to experience entertainment
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="lg:w-[50%] bg-gray-200/90">
          <div class="justify-between items-center max-md:pb-10  md:flex xs:flex-col lg:flex h-full w-full">
                <div
              class="max-md:h-72 md:hidden  max-md:w-full md:pr-14 lg:pr-0 justify-center items-center lg:h-80 lg:w-[50%] flex"
            >
            
               <img
                class="flex justify-center max-md:h-52  max-md:w-80 "
                src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/macbook-air-silver-select-201810?wid=1078&hei=624&fmt=png-alpha&.v=1664472289056"
                height="100%"
                width="150%"
                alt
              />
            </div>
            <div class="Lg:w-[50%] px-5 flex justify-center ">
              <div>

                <p class="text-3xl font-extralight text-black text-start max-md:text-center pb-3">
                  MacBook
                  <span class="text-3xl font-semibold text-black">Air</span>
                </p>
                <p class="text-sm text-gray-400">
                  The new 15inch MacBook Air makes room for more of what you love
                  with a spacious Liquid Retina display.
                </p>
                <a class="max-md:justify-center max-md:grid" href="products.php"
                ><button
                class="btn text-black bg-gray-200/90 border-black m border hover:bg-black hover:text-white w-44 mt-5"
                >
                Shop now
              </button></a
              >
            </div>
          </div>
            <div
              class="w-[50%] h-full md:h-96 md:w-96 justify-between lg:h-full lg:w-[50%] flex max-md:hidden"
            >
              <img
                class="w-full h-full py-5"
                src="./img/Cover.png"
                height="80%"
                width="100%"
                alt
              />
             

        </div>
      </div>
    </section>

    <section
      class="bg-white w-full 2xl:px-32 xl:px-28 lg:px-20 md:px-12 md:justify-center sm:px-5 px-5 py-5 pt-20"
    >
      <div class="flex items-center justify-between pb-5">
          <p class="text-xl text-black font-medium">Browse By Category</p>
        <div class="text-black text-lg font-ligt">
          <a href="#"
            ><i class="fa fa-chevron-left pr-2" aria-hidden="true"></i
          ></a>

          <a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </div>
      </div>
      <div class="grid items-center w-full justify-evenly grid-cols-6 max-md:grid-cols-3 max-sm:grid-cols-2">
        <!-- Repeat this block for 6 cards -->
        <div class="flex justify-center">

          <div
            id="icon-fill"
            class="text-black bg-gray-100 w-[160px] h-[128px] rounded-md justify-center grid mb-3"
          >
            <i
              class="justify-center items-end grid fa fa-mobile text-4xl"
              aria-hidden="true"
            ></i>
            <p class="text-sm pt-2 font-extralight text-black">Phones</p>
          </div>
        </div>
        <div class="flex justify-center">

          <div
            id="icon-fill"
            class="text-black bg-gray-100 w-[160px] h-[128px] rounded-md justify-center grid mb-3"
          >
            <i
              class="justify-center items-end grid fa fa-keyboard text-4xl"
              aria-hidden="true"
            ></i>
            <p class="text-sm pt-2 font-extralight text-black">
              Keyboard
            </p>
          </div>
        </div>
        <div class="flex justify-center">

          <div
            id="icon-fill"
            class="text-black bg-gray-100 w-[160px] h-[128px] rounded-md justify-center grid mb-3"
          >
            <i
              class="justify-center items-end grid fa fa-camera text-4xl"
              aria-hidden="true"
            ></i>
            <p class="text-sm pt-2 font-extralight text-black">Camera</p>
          </div>
        </div>
        <div class="flex justify-center">

          <div
            id="icon-fill"
            class="text-black bg-gray-100 w-[160px] h-[128px] rounded-md justify-center grid mb-3"
          >
            <i
              class="justify-center items-end grid fa fa-headphones text-4xl"
              aria-hidden="true"
            ></i>
            <p class="text-sm pt-2 font-extralight text-black">HeadPhone</p>
          </div>
        </div>
        <div class="flex justify-center">

          <div
            id="icon-fill"
            class="text-black bg-gray-100 w-[160px] h-[128px] rounded-md justify-center grid mb-3"
          >
            <i
              class="justify-center items-end grid fa fa-laptop text-4xl"
              aria-hidden="true"
            ></i>
            <p class="text-sm pt-2 font-extralight text-black">Computer</p>
          </div>
        </div>
        <div class="flex justify-center">

          <div
            id="icon-fill"
            class="text-black bg-gray-100 w-[160px] h-[128px] rounded-md justify-center grid mb-3"
          >
            <i
              class="justify-center items-end grid fa fa-gamepad text-4xl"
              aria-hidden="true"
            ></i>
            <p class="text-sm pt-2 font-extralight text-black">Gaming</p>
          </div>
        </div>
      </div>
    </section>

    <section class=" pt-10 2xl:px-32 xl:px-28 lg:px-20 md:px-12  sm:px-5 px-5">
       <p class="text-xl text-black font-medium pb-5">New Arrival</p>
      <div
        class="grid items-center w-full gap-5 justify-center xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4"
      >


    <a href="productdetail.php" >

        <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1694674022/Croma%20Assets/Communication/Mobiles/Images/300819_0_aunzde.png?tr=w-640"
              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
                <a href="productdetail.php">

           <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media.croma.com/image/upload/v1662655662/Croma%20Assets/Communication/Mobiles/Images/261979_oq7vjv.png"

              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
    <a href="productdetail.php" >

        <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1694674022/Croma%20Assets/Communication/Mobiles/Images/300819_0_aunzde.png?tr=w-640"
              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
                <a href="productdetail.php">

           <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media.croma.com/image/upload/v1662655662/Croma%20Assets/Communication/Mobiles/Images/261979_oq7vjv.png"

              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
    <a href="productdetail.php" >

        <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1694674022/Croma%20Assets/Communication/Mobiles/Images/300819_0_aunzde.png?tr=w-640"
              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
                <a href="productdetail.php">

           <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media.croma.com/image/upload/v1662655662/Croma%20Assets/Communication/Mobiles/Images/261979_oq7vjv.png"

              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
    <a href="productdetail.php" >

        <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1694674022/Croma%20Assets/Communication/Mobiles/Images/300819_0_aunzde.png?tr=w-640"
              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>
                <a href="productdetail.php">

           <div class="card w-64 h-[420px]  bg-gray-100 shadow-sm relative hover:scale-95 duration-300 group">
          <figure class="px-10 pt-10 ">
            <img
              src="https://media.croma.com/image/upload/v1662655662/Croma%20Assets/Communication/Mobiles/Images/261979_oq7vjv.png"

              alt="Shoes" class="rounded-xl object-fill w-fit h-fit" />
          </figure>
          <div class="card-body w-full items-center justify-end text-center text-black  ">
            <p id="text-card"class="w-full h-12 ">Apple iPhone 15 Pro Max</p>
            <p class="card-title">$1,599.00</p>
            <div class="card-actions w-full justify-center pt-1 hover:bg-white">
              <button class="btn  hover:bg-black bg-black w-[90%] border text-white">Buy Now</button>
            </div>
          </div>
          <div class="absolute right-3 top-2 hover:cursor-pointer">
             <i
             id="icon-fill-product"
            class="justify-center  items-end grid fa fa-heart text-2xl"
            aria-hidden="true"
          ></i>
          </div>
        </div>
        </a>

        

      </div>
    </section>

    <!-- <section class="px-44 py-5 bg-white">
      <div class="justify-center">
        <p class="text-black text-xl pb-5 font-bold">Discounts up to -50%</p>
      </div>
      <div class="flex space-x-5 justify-between">
        <div class="card w-72 bg-gray-100 shadow-sm">
          <figure class="px-10 pt-10">
            <img
              src="https://gait.com.qa/media/catalog/product/c/o/conf-wtch8-red-redsp__1_1.png?quality=100&fit=bounds&height=700&width=700"
              alt="Shoes"
              class="rounded-xl"
            />
          </figure>
          <div class="card-body w-full items-center text-center text-black">
            <p>Apple Watch Series 8</p>
            <h2 class="card-title">$179.5</h2>
            <strike>$359.99</strike>
            <div class="card-actions w-full justify-center">
              <button class="btn w-[90%] border">Buy Now</button>
            </div>
          </div>
        </div>
        <div class="card w-72 bg-gray-100 shadow-sm">
          <figure class="px-10 pt-10">
            <img
              src="https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1697018684/Croma%20Assets/Communication/Mobiles/Images/300652_0_ndr3y9.png?tr=w-640"
              alt="Shoes"
              class="rounded-xl"
            />
          </figure>
          <div class="card-body w-full items-center text-center text-black">
            <p>Apple iPhone 15</p>
            <h2 class="card-title">$399.00</h2>
            <strike>$799.00</strike>
            <div class="card-actions w-full justify-center">
              <button class="btn w-[90%] border">Buy Now</button>
            </div>
          </div>
        </div>
        <div class="card w-72 bg-gray-100 shadow-sm">
          <figure class="px-10 pt-10">
            <img
              src="https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1674044393/Croma%20Assets/Communication/Headphones%20and%20Earphones/Images/228341_0_vpkajr.png"
              alt="Shoes"
              class="rounded-xl"
            />
          </figure>
          <div class="card-body w-full items-center text-center text-black">
            <p>Samsung Galaxy Buds Plus</p>
            <h2 class="card-title">$64.5</h2>
            <strike>129.99</strike>
            <div class="card-actions w-full justify-center">
              <button class="btn w-[90%] border">Buy Now</button>
            </div>
          </div>
        </div>
        <div class="card w-72 bg-gray-100 shadow-sm">
          <figure class="px-10 pt-10">
            <img
              src="https://www.studioproper.com.au/cdn/shop/products/Airpods-3rd-Gen_0006_MME73_800x.png?v=1634860722"
              alt="Shoes"
              class="rounded-xl"
            />
          </figure>
          <div class="card-body w-full items-center text-center text-black">
            <p>Apple Airpods (Gen 3)</p>
            <h2 class="card-title">$89.99</h2>
            <strike>$175.00</strike>
            <div class="card-actions w-full justify-center">
              <button class="btn w-[90%] border">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <section>
      <div
        class="bg-[#001524] w-screen  py-20 max-sm:flex-col flex justify-between gap-x-5 items-center mt-12"
      >
        <div class="h-full w-[30%] max-sm:w-full max-sm:h-72">
          <img
            class="h-96 object-contain"
            src="https://lh3.googleusercontent.com/1Dwe1xxIG1nhlXjGlPiyrlVdfM484QWiOAzpx59G7kyMFQyHJy2hqNyTG_tTpVwbzz1qodMUJFyT5p4onTIfb-7BfM0vGUUG0tCMNYecyzhSqHFGP9p4"
            height="100%"
            width="100%"
            alt
          />
        </div>
        <div class="text-white w-[30%] max-sm:w-full max-sm:px-5 max-sm:pt-32">
          <h3 class="text-4xl pb-3 font-light">Big Summer <b class="font-semibold">Sale</b></h3>
          <p class="text-base pb-4">
            Best Products Seller of the 2024 Year that buying for everybody.
          </p>
          <a href="products.php"
            ><button
              class="justify-center items-center btn border-white  bg-black text-white hover:bg-white hover:text-black hover:border-white w-48"
            >
              Shop now
            </button></a
          >
        </div>
        <div class="h-full w-[30%]  max-sm:w-full max-sm:h-72">
          <img
            class="h-96 object-contain"
            src="https://cwpwp.betterthanpaper.com/wp-content/uploads/2020/05/Xiaomi-Redmi-9-series.png"
            height="100%"
            width="100%"
            alt
          />
        </div>
      </div>
    </section>
    <my-footer> </my-footer>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname;
  const pageName = pathName.split("/").pop();
  if (pageName === "index.php" || "") {
    const homeLink = document.getElementById("home");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-black");
    }
  }
  if (pageName === "") {
    const homeLink = document.getElementById("home");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-black");
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const pathName = window.location.pathname;
  const pageName = pathName.split("/").pop();
  if (pageName === "index.php") {
    const homeLink = document.getElementById("home-nav");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-white", "bg-black");
    }
  }
  if (pageName === "") {
    const homeLink = document.getElementById("home-nav");
    if (homeLink) {
      homeLink.classList.add("font-bold", "text-white", "bg-black");
    }
  }
});

    </script>
     <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/componets.js"></script>
  </body>
</html>
