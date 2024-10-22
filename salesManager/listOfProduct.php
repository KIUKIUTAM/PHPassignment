<?php
require_once('../db/connect.php');
$category = $_GET["Category"];
//echo $category;
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

  <!--- favicon-->
  <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
  <!--- custom css link-->
  <link rel="stylesheet" href="./assets/css/style-prefix.css" />
  <!--- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <style>
    #addIcon {
      font-size: 50px;
    }
    #addPart {
      height: 101px;
    }
  </style>
  <?php

  switch ($category) {
    case "ALL":
      $categoryTitle = "All Products:";
      echo '<style>
      .ALL{
        color:var(--salmon-pink) !important;
      } </style>';
      break;
    case "Sheet_Metal":
      $categoryTitle = "Sheet Metal:";
      echo '<style>
      .Sheet-Metal{
        color:var(--salmon-pink) !important;
      }
      </style>';
      break;
    case "Major_Assemblies":
      $categoryTitle = "Major Assemblies:";
      echo '<style>
      .Major-Asssemblies{
        color:var(--salmon-pink) !important;
      }
      </style>';
      break;
    case "Light_Components":
      $categoryTitle = "Light Components: ";
      echo '<style>
      .Light-Components{
        color:var(--salmon-pink) !important;
      }
      </style>';
      break;
    case "Accessories":
      $categoryTitle = "Accessories:";
      echo '<style>
      .Accessories{
        color:var(--salmon-pink) !important;
      }
        </style>';
      break;
  }
  ?>
</head>

<body>
  <header></header>
  <main>
    <div class="product-container">
      <div class="container">

        <nav class="sidebar">
        </nav>

        <div class="product-box">

          <div class="product-minimal">
            <div class="product-showcase">
              <?php
              echo '<h2 class="title">' . $categoryTitle . '</h2>';
              ?>
              <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container">

                  <div class="showcase" onclick="productAdd()" id="addPart">
                    <a href="#" class="showcase-img-box">
                      <ion-icon name="add-outline" id="addIcon"></ion-icon>
                    </a>
                    <div class="showcase-content">
                      <a href="#">
                        <h4 class="showcase-title">Add new Spare Part</h4>
                      </a>
                    </div>
                  </div>
                  <?php
                  $categoryID = 0;
                  switch ($category) {
                    case "ALL":
                      $categoryID = 0;
                      break;
                    case "Sheet_Metal":
                      $categoryID = 1;
                      break;
                    case "Major_Assemblies":
                      $categoryID = 2;
                      break;
                    case "Light_Components":
                      $categoryID = 3;
                      break;
                    case "Accessories":
                      $categoryID = 4;
                      break;
                  };
                  if ($categoryID == 0) {
                    $sql = "SELECT * FROM sparePart";
                    if (isset($_GET['orderByOrder']) && ($_GET['orderByOrder'] == "ASC" || $_GET['orderByOrder'] == "DESC")) {
                      $orderByOrder = $_GET['orderByOrder'];
                      $sql = "SELECT * FROM sparePart ORDER BY sparePartName " . $orderByOrder;
                    }
                  } else {
                    $sql = "SELECT * FROM sparePart WHERE  sparePartNum like '" . $categoryID . "%'";
                  }
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $category = "";
                      $categoryName = "";
                      switch (substr($row["sparePartNum"], 0, 1)) {
                        case "1":
                          $category = "./listOfProduct?Category=Sheet_Metal";
                          $categoryName = "Sheet Metal";
                          break;
                        case "2":
                          $category = "./listOfProduct?Category=Major_Assemblies";
                          $categoryName = "Major Assemblies";
                          break;
                        case "3":
                          $category = "./listOfProduct?Category=Light_Components";
                          $categoryName = "Light Components";
                          break;
                        case "4":
                          $category = "./listOfProduct?Category=Accessories";
                          $categoryName = "Accessories";
                          break;
                      };
                      echo ' <div class="showcase" onclick="ProductDetail(' . $row["sparePartNum"] . ')">
                        <a href="#" class="showcase-img-box">
                          <img
                            src="' . $row["sparePartImage"] . '"
                            width="70"
                            class="showcase-img"
                          />
                        </a>
                        <div class="showcase-content">
                          <a href="#"><h4 class="showcase-title">' . $row["sparePartName"] . '</h4></a>
                          <a class="showcase-category">' . $categoryName . '</a>';
                      if ($row["discountPrice"] == null) {
                        $price = $row["price"];
                        echo '<div class="price-box">
                          <p class="price">$' . $price . '</p>
                        </div>';
                      } else {
                        $price = $row["discountPrice"];
                        $delPrice = $row["price"];
                        echo '<div class="price-box">
                          <p class="price">$' . $price . '</p>
                          <del>$' . $delPrice . '</del>
                        </div>';
                      }
                      echo '
                        </div>
                      </div>';
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer></footer>
  <script>
    function ProductDetail(sparePartNum) {
      window.location.href = ("./product_Detail?sparePartNum=" + sparePartNum);
    }
    function productAdd() {
      window.location.href = ("./product_Add");
    }
    var currentUrl = window.location.href;
    var urlForOrderBY = new URL(currentUrl);

    function orderBy(AorD) {
      switch (AorD) {
        case 0:
          urlForOrderBY.searchParams.set('orderByOrder', 'ASC');
          document.getElementById('NameASC').href = urlForOrderBY.toString();
          break;
        case 1:
          urlForOrderBY.searchParams.set('orderByOrder', 'DESC');
          document.getElementById('NameDESC').href = urlForOrderBY.toString();
          break;
      }
    }
  </script>
  <script src="./assets/js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script>
    $(function() {
      $("header").load("./assets/subphp/header.php");
      $("footer").load("./assets/subphp/footer.php");
      $(".sidebar").load("./assets/subphp/sidebar.php");
    });
  </script>
</body>
</html>