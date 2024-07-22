<?php
require_once('../db/connect.php');
session_start();
if (!isset($_SESSION['managerEmail'])) {
  header("Location: ../ManagerLogin.php");
  exit();
}
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
  <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />

  <link rel="stylesheet" href="./assets/css/style-prefix.css" />

  <!--
    - custom css link
  -->

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>
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
        <div class="product-box">



        </div>
      </div>
  </main>
  <footer>

  </footer>
  <script>
    function ProductDetail(sparePartNum) {
      window.location.href = ("./product_Detail?sparePartNum=" + sparePartNum);
    }
  </script>
  <!--- custom js link-->
  <script src="./assets/js/script.js"></script>
  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script>
    $(function() {
      $("header").load("./assets/subphp/header.php");
      $("footer").load("./assets/subphp/footer.php");
    });
  </script>
</body>

</html>
<?php
$conn->close();
?>