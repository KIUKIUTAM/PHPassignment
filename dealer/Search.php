<?php
require_once('../db/connect.php');
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
  <link rel="stylesheet" href="./assets/css/style-listOfPage.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
  </header>
  <main>
    <div class="product-container">
      <div class="container">
        <nav class="sidebar"></nav>
        <div class="product-box">
          <div class="product-minimal">
            <div class="product-showcase">
              <h2 class="title">Search:</h2>
              <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container">
                  <?php
                  $sql = "SELECT * FROM sparePart WHERE sparePartName LIKE '%" . $_GET["search"] . "%'";
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
                      ?>
                      <div class="showcase" onclick="ProductDetail(<?php echo $row['sparePartNum'] ?>)">
                        <a href="#" class="showcase-img-box">
                          <img
                            src="<?php echo $row["sparePartImage"] ?>"
                            width="70"
                            class="showcase-img"
                          />
                        </a>
  
                        <div class="showcase-content">
                          <a href="#">
                            <h4 class="showcase-title"><?php echo $row["sparePartName"] ?></h4>
                          </a>
  
                          <a href="<?php echo $category ?>" class="showcase-category"><?php echo $categoryName ?></a>
                          <?php
                      if ($row["discountPrice"] == null) {
                        $price = $row["price"];
                        echo '<div class="price-box">
                          <p class="price">$' . $price . '</p></div>
                        ';
                      } else {
                        $price = $row["discountPrice"];
                        $delPrice = $row["price"];
                        echo '<div class="price-box">
                          <p class="price">$' . $price . '</p>
                          <del>$' . $delPrice . '</del></div>
                        ';
                      }
                      ?>
                        </div>
                      </div>
                  <?php
                    }
                  } else {
                    echo '<p>No Result Found</p>';
                  } ?>
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