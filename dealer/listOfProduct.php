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
<style>
  #NameASC:hover {
    color: var(--salmon-pink);
  }

  #NameDESC:hover {
    color: var(--salmon-pink);
  }
</style>

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
                  // Initialize categoryID to 0
                  $categoryID = 0;

                  // Determine the categoryID based on the category string
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
                  }

                  // Build SQL query based on categoryID
                  if ($categoryID == 0) {
                    // Query for all categories
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
                    // Query for specific category
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

                  // Check if orderByOrder is set and valid, append to SQL query
                  if (isset($_GET['orderByOrder']) && ($_GET['orderByOrder'] == "ASC" || $_GET['orderByOrder'] == "DESC")) {
                    $orderByOrder = $_GET['orderByOrder'];
                    $sql .= " ORDER BY sparePart.sparePartName " . $orderByOrder;
                  }

                  // Prepare the SQL statement
                  $stmt = $conn->prepare($sql);

                  // Bind parameters if categoryID is not 0
                  if ($categoryID != 0) {
                    $categoryIDParam = $categoryID . '%';
                    $stmt->bind_param("s", $categoryIDParam);
                  }

                  // Execute the statement
                  $stmt->execute();

                  // Get the result set
                  $result = $stmt->get_result();

                  // Check if any rows were returned
                  if ($result->num_rows > 0) {
                    // Loop through each row in the result set
                    while ($row = $result->fetch_assoc()) {
                      $category = "";
                      $categoryName = "";

                      // Determine category and category name based on sparePartNum prefix
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
                      }
                  ?>
                      <!-- Display the product showcase -->
                      <div class="showcase" onclick="ProductDetail(<?php echo $row['sparePartNum'] ?>)">
                        <a href="#" class="showcase-img-box">
                          <img src="<?php echo $row["sparePartImage"] ?>" width="70" class="showcase-img" />
                        </a>
                        <div class="showcase-content">
                          <a href="#">
                            <h4 class="showcase-title"><?php echo $row["sparePartName"] ?></h4>
                          </a>
                          <a class="showcase-category"><?php echo $categoryName ?></a>
                          <?php
                          // Display price or discount price
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

  <footer>
  </footer>
  <script>
    // Function to redirect to product detail page with a specific spare part number
    function ProductDetail(sparePartNum) {
      window.location.href = "./product_Detail?sparePartNum=" + sparePartNum;
    }



    // Function to set order by ascending or descending
    function orderBy(AorD) {
      // Get the current URL
      var currentUrl = window.location.href;
      var urlForOrderBY = new URL(currentUrl);
      switch (AorD) {
        case 0:
          // Set the order to ascending (ASC)
          urlForOrderBY.searchParams.set('orderByOrder', 'ASC');
          // Update the href attribute of the NameASC element
          document.getElementById('NameASC').href = urlForOrderBY.toString();
          break;
        case 1:
          // Set the order to descending (DESC)
          urlForOrderBY.searchParams.set('orderByOrder', 'DESC');
          // Update the href attribute of the NameDESC element
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