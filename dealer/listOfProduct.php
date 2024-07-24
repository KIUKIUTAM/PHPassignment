<?php
require_once('../db/connect.php');
$category = $_GET["Category"];
//echo $category;
session_start();
if (!isset($_SESSION['dealer'])) {
  header("Location: ../index.php");
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

  <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="./assets/css/style-prefix.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
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
        <nav class="sidebar"></nav>
        <div class="product-box">
          <div class="product-minimal">
            <div class="product-showcase">
              <?php
              echo '<h2 class="title">' . $categoryTitle . '</h2>';
              if ($categoryTitle == "All Products:") {
              ?>
                <a id="NameASC" onclick="orderBy(0)" href="#">Order By Product Name (ASC)</a>
                <a id="NameDESC" onclick="orderBy(1)" href="#">Order By Product Name (DESC)</a>
              <?php
              }
              ?>
              <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container">
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
                    $sql = "SELECT sparePart.sparePartNum,
                                   sparePart.sparePartImage,
                                   sparePart.stockItemQty,
                                   sparePart.sparePartName,
                                   sparePart.weight,
                                   sparePart.sparePartDescription,
                                   sparePart.price,
                                   sparePart.discountPrice,
                                   disabledsparepart.disable
                            FROM sparePart
                            LEFT JOIN disabledsparepart ON sparePart.sparePartNum = disabledsparepart.sparePartNum
                            WHERE disabledsparepart.sparePartNum IS NULL";
                  } else {
                    $sql = "SELECT sparePart.sparePartNum,
                                   sparePart.sparePartImage,
                                   sparePart.stockItemQty,
                                   sparePart.sparePartName,
                                   sparePart.weight,
                                   sparePart.sparePartDescription,
                                   sparePart.price,
                                   sparePart.discountPrice,
                                   disabledsparepart.disable
                            FROM sparePart
                            LEFT JOIN disabledsparepart ON sparePart.sparePartNum = disabledsparepart.sparePartNum
                            WHERE disabledsparepart.sparePartNum IS NULL
                              AND sparePart.sparePartNum LIKE ?";
                  }
                  if (isset($_GET['orderByOrder']) && ($_GET['orderByOrder'] == "ASC" || $_GET['orderByOrder'] == "DESC")) {
                    $orderByOrder = $_GET['orderByOrder'];
                    $sql .= " ORDER BY sparePart.sparePartName " . $orderByOrder;
                  }
                  $stmt = $conn->prepare($sql);
                  if ($categoryID != 0) {
                    $categoryIDParam = $categoryID . '%';
                    $stmt->bind_param("s", $categoryIDParam);
                  }
                  $stmt->execute();
                  $result = $stmt->get_result();
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
                      };?>
                     <div class="showcase" onclick="ProductDetail(<?php echo $row['sparePartNum'] ?>)">
                        <a href="#" class="showcase-img-box">
                          <img
                            src="<?php echo$row["sparePartImage"] ?>"
                            width="70"
                            class="showcase-img"
                          />
                        </a>
                        <div class="showcase-content">
                          <a href="#"><h4 class="showcase-title"><?php echo $row["sparePartName"] ?></h4></a>
                          <a class="showcase-category"><?php echo $categoryName ?></a>
                          <?php
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
                      ?>
                        </div>
                      </div>
                  <?php
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

  <!--
    - FOOTER
  -->

  <footer>

  </footer>
  <script>
    function ProductDetail(sparePartNum) {
      window.location.href = ("./product_Detail?sparePartNum=" + sparePartNum);
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

  <!--- custom js link-->
  <script src="./assets/js/script.js"></script>

  <!--- ionicon link-->
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

';
?>