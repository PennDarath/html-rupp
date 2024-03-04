class NavBar extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
       <section
      class="flex border-b justify-between min-w-screen z-50  2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 sticky top-0 bg-white"
    >
      <div class="flex items-center gap-x-10 justify-between w-full">
        <div class="flex items-center gap-x-1">
          <img
            src="https://media.istockphoto.com/id/1162451364/vector/valknut-symbol-icon.jpg?s=612x612&w=0&k=20&c=h6Svj7Ddads1DVDf8wh_G2PJFhV4IJvO-ZSdpRDFrac="
            alt="Logo"
            width="50px"
            height="50px"
            id="logo"
            class="border-none pb-3 rounded-full"
          />
          <p class="text-2xl text-black font-medium">Korng Jak</p>
        </div>
        <div class="flex-1 max-sm:hidden relative">
          <input
            placeholder="Search"
            class="input w-full pl-11 bg-gray-100 text-black"
          />

          <span class="text-gray-400 absolute top-3 left-5 text-base"
            ><i class="fa fa-search"></i
          ></span>
        </div>
        <ul class="flex items-center gap-x-5 max-lg:hidden">
          <nav>
            <ul class="flex gap-x-10">
              <li>
                <a id="home" href="./index.php" class="">Homee</a>
              </li>
              <li>
                <a id="products" href="./products.php" class=""
                  >Product</a
                >
              </li>
              <a id="contact" href="./contact.php" class=""
                >Contact Us</a
              >
              <li></li>
            </ul>
          </nav>
          <div class="flex items-center gap-x-5">
            <li>
              <a href="#"
                ><span class="text-black fill"
                  ><i id="icon-fill" class="fa fa-heart"></i></span
              ></a>
            </li>
            <li>
              <a href="#"
                ><span class="text-black"
                  ><i
                    id="icon-fill"
                    class="fa fa-shopping-cart"
                    aria-hidden="true"
                  ></i></span
              ></a>
            </li>
            <li>
              <a href="login.php"
                ><span class="text-black"
                  ><i
                    id="icon-fill"
                    class="fa fa-user"
                    aria-hidden="true"
                  ></i></span
              ></a>
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
        `;
  }
}
class Footer extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
        <footer
      class="footer py-16 2xl:px-32 xl:px-28 lg:px-20 md:px-12 sm:px-5 px-5 py-15 bg-black text-base-content"
    >
      <nav>
        <header class="footer-title text-xl text-gray-400">Korng Jak</header>
        <p class="md:w-[30vw] text-gray-400">
        Best Shopping Experience Guaranteed at Korng Jak Cambodia 
        Korng Jak: Redefining “Effortless Shopping”

        With Korng Jak Cambodia, you won’t run out of options as we collaborated with hundreds of top brands worldwide.
        <br/>
        Korng Jak is a top electronics store in Kingdom of Cambodia.

        </p>


      </nav>
      <nav>
        <header class="footer-title text-gray-400">Services</header>
        <a class="link link-hover text-gray-400">Korng Jak Member</a>
        <a class="link link-hover text-gray-400">Special Promotions</a>
        <a class="link link-hover text-gray-400">Credit and payment</a>
        <a class="link link-hover text-gray-400">Service contacts</a>
        <a class="link link-hover text-gray-400">Payment</a>
      </nav>
      <nav class="text-gray-400">
        <header class="footer-title">Address</header>
        <a class="link link-hover">
        <div class="flex items-center gap-x-2 mt-2 text-gray-400">

                <i class="fas fa-map-marker-alt text-md"></i>
                <div >Address: #29, Street 217, Sangkat Veal Vong,
                </div>
             
              </div></a>

                 <a class="link link-hover">

        <div class="flex items-center gap-x-1 mt-2">

                <i class="fas fa-phone-alt text-md"></i>
                <div>Tel: +855 (0)111 777 / 777 4449</div>
              </div></a>
                 <a class="link link-hover">
        <div class="flex items-center gap-x-2 mt-2">

                <i class="fas fa-envelope text-md"></i>
                <div>KorngJakCambodia@gmail.com</div>
              </div></a>
      </nav>
      <nav class="text-gray-400">
        <header class="footer-title">Social</header>
        <div class="grid grid-flow-col gap-4">
          <a
            ><svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              class="fill-current"
            >
              <path
                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"
              ></path></svg
          ></a>
          <a
            ><svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              class="fill-current"
            >
              <path
                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"
              ></path></svg
          ></a>
          <a
            ><svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              class="fill-current"
            >
              <path
                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"
              ></path></svg
          ></a>
        </div>
      </nav>
    </footer>
        `;
  }
}
customElements.define("my-navbar", NavBar);
customElements.define("my-footer", Footer);
