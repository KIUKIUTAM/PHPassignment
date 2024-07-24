<?php
require_once('../db/connect.php');
session_start();
if(!isset($_SESSION['dealer'])){
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
  <link rel="stylesheet" href="./assets/css/style-productDetail.css" />
  <link rel="stylesheet" href="./assets/css/toast.css" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>
  <header></header>
  <main>
    <div class="productDetail-container">
      <?php
      $sparePartNum = $_GET["sparePartNum"];
      $sql = "SELECT * FROM sparePart WHERE sparePartNum = " . $sparePartNum;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $categoryName = "";
        switch (substr($row["sparePartNum"], 0, 1)) {
          case "1":
            $categoryName = "Sheet Metal";
            break;
          case "2":
            $categoryName = "Major Assemblies";
            break;
          case "3":
            $categoryName = "Light Components";
            break;
          case "4":
            $categoryName = "Accessories";
            break;
        };
      ?>
        <div class="container">
          <div class="product-box">
            <div class="product">
              <a href="#" class="product-img-box">
                <img src="<?php echo $row["sparePartImage"] ?>" alt="product-img-box" width="300" class="product-img" />
              </a>
              <?php
              if ($row["stockItemQty"] >= 100) {
                $stockItemStatus = "In Stock";
                echo '<style>#stockItemStatus{color:green;}
                      </style>';
              } else {
                $stockItemStatus = "Out of Stock";
                echo '<style>#stockItemStatus{color:red;}
                    </style>';
              };
              ?>
              <div class="product-content">
                <label id="bold">Spare ID: </label><span class="product-title" id="sparePartNum"><?php echo $row["sparePartNum"] ?></span><br>
                <label id="bold">Spare Name: </label><span class="product-title" id="sparePartName"><?php echo $row["sparePartName"] ?></span><br>
                <label id="bold">Weight: </label><span class="product-title" id="weight"><?php echo $row["weight"] ?>Kg</span><br>
                <label id="bold">Stock Status: </label><span class="product-title" id="stockItemStatus"><?php echo $stockItemStatus ?></span><br>
                <br>
                <label id="bold">Description:</label>
                <p class="product-description">
                  <?php echo  $row["sparePartDescription"] ?>
                  <br><br>
                <div class="price-box">
                  <?php
                  if ($row["discountPrice"] == null) {
                    $price = $row["price"];
                    echo "<div class='price-box'><p class='price' id='price'>$ $price</p>";
                  } else {
                    $price = $row["discountPrice"];
                    $delPrice = $row["price"];
                    echo "<div class='price-box'>
                    <p class='price' id='price'>$$price</p>
                    <del>$delPrice</del>";
                  } ?>
                </div>
                <div class="quantity">
                  <button onclick="quantityDecrement()">
                    <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M20 12L4 12"></path>
                    </svg>
                  </button>
                  <input id="quantityNumber" type="number" value="1" min="0" readonly/>
                  <button onclick="quantityIncrement()">
                    <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M12 4V20M20 12H4"></path>
                    </svg>
                  </button>
                </div>
                <button class="product-content-button" onclick="addToCart()">Add To Cart</button>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </main>
  <footer>
  </footer>
  <script>
    function quantityDecrement() {
      let num = parseInt(document.getElementById("quantityNumber").value, 10);
      if (!isNaN(num) && num > 0) {
        document.getElementById("quantityNumber").value = num - 1;
      }
    }
    function quantityIncrement() {
      let num = parseInt(document.getElementById("quantityNumber").value, 10);
      if (!isNaN(num)) {
        document.getElementById("quantityNumber").value = num + 1;
      }
    }
  </script>

  <script>
    function addToCart() {
    // Check if the item is out of stock
    if (document.getElementById("stockItemStatus").innerText == "Out of Stock") {
        alert("Out of Stock\nNot allowed to add to cart");
        return;
    }

    // Define the URL for the add to cart request
    const url = "./assets/subphp/addtocart.php";

    // Retrieve the spare part ID, quantity, and name from the respective elements
    const spareID = document.getElementById("sparePartNum").innerText;
    const spareQty = document.getElementById("quantityNumber").value;
    const spareName = document.getElementById("sparePartName").innerText;

    if(spareQty == 0){
      alert("Please enter quantity");
      return;
    }
    // Create the data object to be sent in the request
    const data = {
        spareID: spareID,
        spareQty: parseInt(spareQty, 10) // Convert the quantity to an integer
    };

    // Make a POST request to the server to add the item to the cart
    fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(responseData => {
            // Check the response status
            if (responseData.status === 'success') {
                // Show a toast notification indicating the item was added to the cart
                showToast(`Added ${spareQty} of [${spareName}]`);
            } else {
                console.error('Error:', responseData.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

    // Update the cart count
    fetchCartCount();
}
    function showToast(message) {
      toastNotif({
        text: message,
        color: '#5bc83f',
        timeout: 500,
        icon: 'valid'
      });
    }
  </script>
  <script src="./assets/js/script.js"></script>
  <script type="text/javascript" src="./assets/js/toast.js"></script>
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
<?php
$conn->close();
?>