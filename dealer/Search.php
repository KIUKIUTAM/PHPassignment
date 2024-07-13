<?php
echo '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SLMS - eCommerce Website</title>

    <!--
    - favicon
  -->
    <link
      rel="shortcut icon"
      href="./assets/images/200005.jpg"
      type="image/x-icon"
    />

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style-prefix.css" />
    <link rel="stylesheet" href="./assets/css/style-listOfPage.css" />
    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <div class="overlay" data-overlay></div>

    <!--
    - HEADER
  -->

    <header>
    </header>

    <!--
    - MAIN
  -->

    <main>
      <!--
      - PRODUCT
    -->

      <div class="product-container">
        <div class="container">
          <!--
          - SIDEBAR
        -->
          <div class="product-box">
            <!--
            - PRODUCT MINIMAL
          -->

            <div class="product-minimal">
              <div class="product-showcase">
                <h2 class="title">Search:</h2>

                <div class="showcase-wrapper has-scrollbar">
                  <div class="showcase-container">
                    <div class="showcase">
                      <a href="#" class="showcase-img-box">
                        <img
                          src="./assets/imageS/400001.jpg"
                          
                          width="70"
                          class="showcase-img"
                        />
                      </a>

                      <div class="showcase-content">
                        <a href="#">
                          <h4 class="showcase-title">Accessories No.1</h4>
                        </a>

                        <a href="#" class="showcase-category"
                          >Accessories</a
                        >

                        <div class="price-box">
                          <p class="price">$45.00</p>
                          <del>$12.00</del>
                        </div>
                      </div>
                    </div>
                    
                    
                    <div class="showcase">
                      <a href="#" class="showcase-img-box">
                        <img
                          src="./assets/images/400002.jpg"
                          
                          width="70"
                          class="showcase-img"
                        />
                      </a>

                      <div class="showcase-content">
                        <a href="#">
                          <h4 class="showcase-title">Asssemblies No.2</h4>
                        </a>

                        <a href="#" class="showcase-category"
                          >Accessories</a
                        >

                        <div class="price-box">
                          <p class="price">$45.00</p>
                          <del>$12.00</del>
                        </div>
                      </div>
                    </div>
                    <div class="showcase">
                      <a href="#" class="showcase-img-box">
                        <img
                          src="./assets/images/400003.jpg"
                          
                          width="70"
                          class="showcase-img"
                        />
                      </a>

                      <div class="showcase-content">
                        <a href="#">
                          <h4 class="showcase-title">Accessories No.3</h4>
                        </a>

                        <a href="#" class="showcase-category"
                          >Accessories</a
                        >

                        <div class="price-box">
                          <p class="price">$45.00</p>
                          <del>$12.00</del>
                        </div>
                      </div>
                    </div>
                    <div class="showcase">
                      <a href="#" class="showcase-img-box">
                        <img
                          src="./assets/images/400004.jpg"
                          
                          width="70"
                          class="showcase-img"
                        />
                      </a>

                      <div class="showcase-content">
                        <a href="#">
                          <h4 class="showcase-title">Accessories No.4</h4>
                        </a>

                        <a href="#" class="showcase-category"
                          >Accessories</a
                        >

                        <div class="price-box">
                          <p class="price">$45.00</p>
                          <del>$12.00</del>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              

              
            </div>
          </div>
        </div>
      </div>
    </main>

    <!--
    - FOOTER
  -->

    <footer>
  
    </footer>

    <!--
    - custom js link
  -->
    <script src="./assets/js/script.js"></script>

    <!--
    - ionicon link
  -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>
      $(function(){
          $("header").load("./header.php");
          $("footer").load("./footer.php");

      });
    </script>
  </body>
</html>

';
?>