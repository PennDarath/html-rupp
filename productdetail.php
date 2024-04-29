<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
  $sql = "SELECT avatar FROM users WHERE user_id = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $avatar = $row["avatar"];
  }
}
function sanitize_input($input)
{
  global $con;
  return mysqli_real_escape_string($con, $input);
}

$product = null;
if (isset($_GET['id'])) {
  $product_id = sanitize_input($_GET['id']);

  $sql = "SELECT * FROM products WHERE product_id = $product_id";
  $result = mysqli_query($con, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
  }
}

if (!$product) {
  echo "Product not found.";
  exit();
}

$user_id = (int)$_SESSION["user_id"];
$user_email = $_SESSION["user_email"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  // Check if the user is logged in
  if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
  }

  $product_id = (int)sanitize_input($_POST['product_id']);
  $quantity = (int)$_POST['quantity'];
  $color = sanitize_input($_POST['color']);
  $name = sanitize_input($_POST['name']);
  $phone_storage = sanitize_input($_POST['phone_storage']);
  $sql = "INSERT INTO orders (user_id, product_id, color, quantity, name, phone_storage, user_email) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($con, $sql);

  if ($stmt) {
    if (mysqli_stmt_bind_param($stmt, "iisisss", $user_id, $product_id, $color, $quantity, $name, $phone_storage, $user_email)) {

      if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Ordered successful');</script>";
      } else {
        echo "Error: " . mysqli_stmt_error($stmt);
      }
    } else {
      echo "Error binding parameters: " . mysqli_stmt_error($stmt);
    }
  } else {
    echo "Error: " . mysqli_error($con);
  }
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


<body class="min-h-screen">
  <section class="flex border-b justify-between min-w-screen py-4 z-50  2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sticky top-0 bg-white">
    <div class="flex items-center gap-x-10 justify-between w-full">
      <div class="flex items-center gap-x-1">


        <img src="https://media.istockphoto.com/id/1162451364/vector/valknut-symbol-icon.jpg?s=612x612&w=0&k=20&c=h6Svj7Ddads1DVDf8wh_G2PJFhV4IJvO-ZSdpRDFrac=" alt="Logo" width="40px" height="40px" id="logo" class="border-none pb-3 rounded-full">
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
          <li class="relative">
            <a href="#">
              <span class="text-black">
                <i id="icon-fill" class="fa fa-shopping-cart text-sm" aria-hidden="true"></i>
              </span>


              <span id="cart-item-count" class="text-[10px] flex items-center justify-center h-5 w-5 rounded-full  absolute -top-3 left-1 p-0.5 "></span>

            </a>
          </li>

          <li>
            <a href="./login.php">
              <?php
              if (isset($avatar)) {
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
  <section class="min-w-screen h-full">
    <div class="flex-col items-center justify-center flex lg:flex-row h-full pt-12 min-w-screen gap-x-10 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sm:px-5 px-5">
      <img src="img/<?php echo $product['product_image']; ?>" alt="Avatar" class="h-[500px] w-fit mb-10 lg:mb:1">
      <div id="padding-iphone" class="right pt-4 grid items-center justify-center">
        <h3 class="font-bold text-2xl text-black"><?php echo $product['product_name']; ?></h3>
        <div>
          <h4 class="text-black text-xl py-1.5"> <small>$</small><?php echo $product['product_price']; ?></h4>
          <h5>Color: <?php echo $product['color']; ?></h5>
          <p class="pt-3"><?php echo $product['product_details']; ?></p>
        </div>
        <h5 class="pt-1  ">Quantity</h5>
        <div class="add flex1">
          <span class="hover:cursor-pointer">-</span>
          <span>1</span>
          <span class="hover:cursor-pointer">+</span>
        </div>
        <p>Size :
          <select class="bg-white" name="size">
            <option class="bg-white" value="select Size"><?php echo $product['phone_storage']; ?></option>
            <?php
            if (isset($product['phone_storage'])) {
              echo '<option value="' . $product['phone_storage'] . '">' . $product['phone_storage'] . '</option>';
            } else {
              echo '<option value="">No sizes available</option>';
            }
            ?>
          </select>

        </p>
        <div class="my-8 flex justify-start gap-x-5">
          <div class="bg-white hover:text-white hover:bg-blue-500 hover:border-none rounded-md border border-black text-black p-3 px-6 w-fit hover:cursor-pointer" onclick="addToCart('<?php echo $product['product_id']; ?>', '<?php echo $user_id; ?>')">
            <i class="fa fa-shopping-cart"></i>
            Add to Cart
          </div>
          <form id="buy-now-form" action="" method="post" class="bg-black hover:bg-red-500 hover:border-none rounded-md border border-black text-white p-3 px-8 w-fit hover:cursor-pointer">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="color" value="<?php echo $product['color']; ?>">
            <input type="hidden" name="quantity" value="<?php echo $product['quantity']; ?>">
            <input type="hidden" name="name" value="<?php echo $product['product_name']; ?>">
            <input type="hidden" name="phone_storage" value="<?php echo $product['phone_storage']; ?>">
            <input type="hidden" name="user_email" value="<?php echo $user_email; ?>">
            <input type="submit" name="submit" value="Buy now">
          </form>



        </div>
      </div>
    </div>
  </section>

  <div id="cart-drawer" class="hidden  fixed inset-y-0 right-0 w-[30%] h-full bg-black bg-white z-50 duration-300 shadow-lg rounded-l-lg">
    <div class="p-4 bg-gray-200 h-screen">
      <div class="flex justify-start my-4">
        <button id="close-cart-drawer" class="px-2 py-1 bg-black text-white rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">Back</button>
      </div>
      <ul id="cart-items" class="divide-y divide-gray-200">
      </ul>
     
    </div>
  </div>


  <my-footer> </my-footer>
  <script>
    function updateCartIcon() {
      const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
      const totalItems = cartItems.reduce((acc, item) => acc + item.quantity, 0); // Start with an initial value of 0
      const cartItemCount = document.getElementById('cart-item-count');
      cartItemCount.textContent = totalItems;

      // Check if there are items in the cart
      if (totalItems > 0) {
        cartItemCount.style.color = 'white'; // Change text color to red
        cartItemCount.style.backgroundColor = 'red';


      } else {
        cartItemCount.style.color = 'white'; // Change text color to red
        cartItemCount.style.backgroundColor = 'red';
      }
    }

    function img(anything) {
      document.querySelector('.slide').src = anything;
    }

    document.addEventListener("DOMContentLoaded", function() {
      const pathName = window.location.pathname;
      const pageName = pathName.split("/").pop();

      if (pageName === "productdetail.php") {
        const homeLink = document.getElementById("products");
        if (homeLink) {
          homeLink.classList.add("font-bold", "text-black");
        }
      }
    });
    document.addEventListener("DOMContentLoaded", function() {
      const decrementButton = document.querySelector('.add span:first-child');
      const incrementButton = document.querySelector('.add span:last-child');
      const quantityElement = document.querySelector('.add span:nth-child(2)');

      let quantity = parseInt(quantityElement.textContent);

      decrementButton.addEventListener('click', function() {
        if (quantity > 1) {
          quantity--;
          quantityElement.textContent = quantity;
        }
      });

      incrementButton.addEventListener('click', function() {
        quantity++;
        quantityElement.textContent = quantity;
      });
    });

    function toggleCartDrawer() {
      const cartDrawer = document.getElementById('cart-drawer');
      cartDrawer.classList.toggle('hidden');
    }

    function closeCartDrawer() {
      const cartDrawer = document.getElementById('cart-drawer');
      cartDrawer.classList.add('hidden');
    }

    const cartIcon = document.querySelector('.fa.fa-shopping-cart');
    cartIcon.addEventListener('click', toggleCartDrawer);

    const closeButton = document.getElementById('close-cart-drawer');
    closeButton.addEventListener('click', closeCartDrawer);

    function addToCart(productId) {
      updateCartIcon();

      const quantityElement = document.querySelector('.add span:nth-child(2)');
      const quantity = parseInt(quantityElement.textContent);

      const product = {
        id: productId,
        name: '<?php echo $product['product_name']; ?>',
        price: '<?php echo $product['product_price']; ?>',
        image: '<?php echo $product['product_image']; ?>',
        color: '<?php echo $product['color']; ?>',
        phone_storage: '<?php echo $product['phone_storage']; ?>',
        quantity: quantity
      };

      let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
      const existingIndex = cartItems.findIndex(item => item.id === product.id);
      if (existingIndex !== -1) {
        cartItems[existingIndex].quantity += quantity;
      } else {
        cartItems.push(product);
      }
      localStorage.setItem('cartItems', JSON.stringify(cartItems));
      updateCartDrawer();
    }


    function deleteCartItem(name) {
      let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
      const index = cartItems.findIndex(item => item.name === name);
      if (index !== -1) {
        cartItems.splice(index, 1);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartDrawer();
      }
    }

    function updateCartDrawer() {
      updateCartIcon();

      const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
      const cartList = document.getElementById('cart-items');
      cartList.innerHTML = '';

      cartItems.forEach((item, index) => {
        const li = document.createElement('li');
        const details = document.createElement('p');

        details.textContent = `
            Product ID: ${item.id}, 
            Name: ${item.name}, 
            Color: ${item.color}, 
            Phone Storage: ${item.phone_storage}, 
            Quantity: ${item.quantity}
        `;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', () => {
          deleteCartItem(item.name)
        });
        li.appendChild(details);
        li.appendChild(deleteButton);

        cartList.appendChild(li);
      });
    }


    updateCartDrawer();
  </script>


</body>

</html>