<?php
require_once ('../db/connet.php');
?>


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
  <link rel="shortcut icon" href="./assets/images/200005.jpg" type="image/x-icon" />

  <!--
    - custom css link
  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style-prefix.css" />
  <link rel="stylesheet" href="./assets/css/style-shoppingCart.css" />
  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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

    <div class="product-container">
      <div class="container">
        <div class="product-box">
          <div class="product-minimal">
            <div class="product-showcase">
              <h2 class="title">Shopping Cart</h2>

              <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container">
                  <?php
                  session_start();

                  // Check if the session variable exists
                  if (isset($_SESSION['cart'])) {
                      $retrievedArray = $_SESSION['cart'];
                      $IDStr = "";
                      // Display the retrieved 2D array
                      foreach ($retrievedArray as $row) {
                       // echo $row["spareID"];
                        //echo $row["spareQty"];
                        $IDStr .= $row["spareID"] . ",";
                      }
                      $sql = "SELECT * FROM sparePart Where sparePartNum IN (" . substr($IDStr, 0, -1) . ")";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0){
                      while($row = $result->fetch_assoc()) {
                        echo $row["sparePartNum"];



                      }}
                  } else {
                      echo "No 2D array found in session.";
                  }


                  ?>
                  <div class="showcase">
                    <input type="checkbox" class="checkbox">
                    <a href="#" class="showcase-img-box">
                      <img src="./assets/imageS/400001.jpg" width="70" class="showcase-img" />
                    </a>

                    <div class="showcase-content">
                      <i class="bx bx-x red zoom"></i>
                      <a href="#">
                        <h4 class="showcase-title">Accessories No.1</h4>
                      </a>

                      <a href="#" class="showcase-category">Accessories</a>

                      <div class="price-box">
                        <p class="price">$45.00</p>

                      </div>
                    </div>
                  </div>

                  <div class="showcase">
                    <input type="checkbox" class="checkbox">
                    <a href="#" class="showcase-img-box">
                      <img src="./assets/images/400002.jpg" width="70" class="showcase-img" />
                    </a>

                    <div class="showcase-content">
                      <i class="bx bx-x red zoom"></i>
                      <a href="#">
                        <h4 class="showcase-title">Asssemblies No.2</h4>
                      </a>

                      <a href="#" class="showcase-category">Accessories</a>

                      <div class="price-box">
                        <p class="price">$45.00</p>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-50">
          <h4 class="d-none d-lg-block">
            <span class="text-primary">Your cart</span>
            <span class="badge bg-primary rounded-pill">3</span>
          </h4>
          <ul class="list-group ">
            <li class="list-group-item d-none d-lg-block">
              <span class="text-body-secondary float-end">$12</span>
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-body-secondary">Brief description</small>
              </div>
            </li>
            <li class="list-group-item">
              <span class="text-body-secondary float-end">$8</span>
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-body-secondary">Brief description</small>
              </div>
            </li>
            <li class="list-group-item">
              <span class="text-body-secondary float-end">$8</span>
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-body-secondary">Brief description</small>
              </div>
            </li>
            <li class="list-group-item">
              <span class="text-body-secondary float-end">$8</span>
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-body-secondary">Brief description</small>
              </div>
            </li>
            <li class="list-group-item">
              <span class="text-body-secondary float-end">$5</span>
              <div>
                <h6 class="my-0">Third item</h6>
                <small class="text-body-secondary">Brief description</small>
              </div>

            </li>
            <li class="list-group-item list-group-total">
              <span>Total (USD)</span>
              <strong>$25</strong>
            </li>
          </ul>
          
          <button  class="button_V" onclick="location.href=\'./Checkout.php\'"
            style="margin-top: 30px;"><span class="button_top"> Make Order
            </span>
          </button>
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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script>
      $(function(){
          $("header").load("./header.php");
          $("footer").load("./footer.php");

      });
    </script>
</body>

</html>