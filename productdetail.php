<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

function sanitize_input($input) {
  global $con;
  return mysqli_real_escape_string($con, $input);
}

$product = null;
if(isset($_GET['id'])) {
    $product_id = sanitize_input($_GET['id']);
    
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
}

if (!$product) {
  echo "Product not found.";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KorngJak</title>
    <link rel="icon" href="/img/korngjak-modified.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./css/products.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product-detail.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      #logo {
  animation: rotateAnimation 1s linear infinite;
}
      @keyframes rotateAnimation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

    </style>
</head>


<body>
<section class="flex border-b justify-between min-w-screen py-4 z-50 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sticky top-0 bg-white">
    <div class="flex items-center gap-x-10 justify-between w-full">
        <div class="flex items-center gap-x-1">
            <img  src="https://media.istockphoto.com/id/1162451364/vector/valknut-symbol-icon.jpg?s=612x612&w=0&k=20&c=h6Svj7Ddads1DVDf8wh_G2PJFhV4IJvO-ZSdpRDFrac=" alt="Logo" width="40px" height="40px" id="logo" class="border-none pb-3 rounded-full">
            <p class="text-xl text-black font-medium">Korng Jak</p>
        </div>
        <div class="flex-1 max-sm:hidden relative">
            <input placeholder="Search" class="input w-full pl-11 h-11 text-sm bg-gray-100 text-black">
            <span class="text-gray-400 absolute top-3 left-5 text-sm"><i class="fa fa-search"></i></span>
        </div>
        <ul class="flex items-center gap-x-1 max-lg:hidden">
            <nav>
                <ul class="flex gap-x-10">
                    <li><a id="home" href="index.php" class="text-sm">Home</a></li>
                    <li><a id="products" href="products.php" class="text-sm">Product</a></li>
                    <a id="contact" href="contact.php" class="text-sm">Contact Us</a>
                    <li></li>
                </ul>
            </nav>
            <div class="flex items-center gap-x-5">
                <li><a href="#"><span class="text-black fill"><i id="icon-fill" class="fa fa-heart text-sm"></i></span></a></li>
                <li><a href="#"><span class="text-black"><i id="icon-fill" class="fa fa-shopping-cart text-sm" aria-hidden="true"></i></span></a></li>
                <li><a href="./login.php"><span class="text-black"><i id="icon-fill" class="fa fa-user text-sm" aria-hidden="true"></i></span></a></li>
            </div>
        </ul>
        <div class="drawer z-50 lg:hidden w-fit flex justify-end">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle">
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
                            <p class="font-serif text-xl text-black font-bold cursor-default">KorngJak</p>
                        </div>
                        <label for="my-drawer-3" class="drawer-overlay">
                            <div class="cursor-pointer rounded-sm p-0.5 text-black"><i class="fa fa-times" aria-hidden="true"></i></div>
                        </label>
                    </div>
                    <li><a id="home-nav" href="index.php" class="text-black mb-1 font-semibold hover:bg-black hover:text-white">Home</a></li>
                    <li><a id="product-nav" href="products.php" class="text-black mb-1 font-semibold hover:bg-black hover:text-white">Products</a></li>
                    <li><a id="contact-nav" href="contact.php" class="text-black mb-1 font-semibold hover:bg-black hover:text-white">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="min-w-screen">
    <div class="container flex pt-12 min-w-screen gap-x-10 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sm:px-5 px-5">
        <div class="left">
            <div class="main_image grid items-center justify-center">
                <img src="<?php echo $product['image_url']; ?>" alt="" class="slide">
            </div>
            <div class="option flex mt-5">
                <?php foreach ($product['image_gallery'] as $image): ?>
                    <img src="<?php echo $image; ?>" onclick="img('<?php echo $image; ?>')">
                <?php endforeach; ?>
            </div>
        </div>
        <div id="padding-iphone" class="right pt-4">
            <h3 class="font-bold text-2xl text-black"><?php echo $product['product_name']; ?></h3>
            <div>
                <h4 class="text-black text-xl py-1.5"> <small>$</small><?php echo $product['product_price']; ?></h4>
                <h5>Color: <?php echo $product['color']; ?></h5>
                <p><?php echo $product['product_details']; ?></p>
            </div>
            <h5 class="pt-1">Quantity</h5>
            <div class="add flex1">
                <span class="hover:cursor-pointer">-</span>
                <span>1</span>
                <span class="hover:cursor-pointer">+</span>
            </div>
            <p>Size : 
                <select class="bg-white" name="size">
                    <option class="bg-white" value="select Size">Select Size</option>
                    <?php foreach ($product['phone_storage'] as $size): ?>
                        <option value="<?php echo $size; ?>"><?php echo $size; ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <div class="my-8 flex justify-start gap-x-5">
                <div class="bg-white hover:text-white hover:bg-blue-500 hover:border-none rounded-md border border-black text-black p-3 px-6 w-fit hover:cursor-pointer ">
                    <i class="fa fa-shopping-cart"></i>
                    Add to Cart
                </div>
                <div class="bg-black hover:bg-red-500 hover:border-none rounded-md border border-black text-white p-3 px-8 w-fit hover:cursor-pointer ">
                    <i class="fa fa-shopping-cart"></i>
                    Buy now
                </div>
            </div>
        </div>
    </div>
</section>
<my-footer> </my-footer>
<script>
    function img(anything) {
        document.querySelector('.slide').src = anything;
    }

    document.addEventListener("DOMContentLoaded", function () {
        const pathName = window.location.pathname;
        const pageName = pathName.split("/").pop();

        if (pageName === "productdetail.php") {
            const homeLink = document.getElementById("products");
            if (homeLink) {
                homeLink.classList.add("font-bold", "text-black");
            }
        }
    });
</script>
<script src="/js/componets.js"></script>
</body>
</html>

