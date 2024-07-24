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

  <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

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
      <div class="container">
        <h1>Add Item:</h1>
        <div class="product-box">
          <div class="product">

            <a href="#" class="product-img-box">
              <img src="../assets/img/noimg.jpg" alt="product-img-box" width="300" class="product-img" />
            </a>
            <div class="product-content">
              <label id="bold">Spare ID: </label><span class="product-title" id="sparePartNum">null</span><br>
              <label id="bold">Spare Name: </label><span class="product-title" id="sparePartName">null</span><br>
              <label id="bold">Weight: </label><span class="product-title" id="weight">null</span><br>
              <label id="bold">Stock Status: </label><span class="product-title" id="stockItemStatus">null</span><br>
              <br>
              <label id="bold">Description:</label>
              <p class="product-description">
                null
              </p>

              <div class="price-box">
                <label id="bold">discount Price: </label><span class='price' id='price'>null</span><br>
                <label id="bold">Price: </label><del>null</del><br>

              </div>

            </div>
            <form id="addItmeForm" METHOD="POST" ACTION="./assets/subphp/addItem.php" enctype="multipart/form-data">
              <div class="input-group mb-3 mt-5">
                <span class="input-group-text" id="basic-addon1">Category</span>
                <select class="form-select" name="Category" id="CategorySelect" required>
                  <option value="" selected>Choose...</option>
                  <option value="1">Sheet Metal</option>
                  <option value="2">Major Assemblies</option>
                  <option value="3">Light Components</option>
                  <option value="4">Accessories</option>
                </select>
              </div>
              <div class="invalid-feedback" id="selectError" style="display: none;">
                Please select a valid category.
              </div>
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Spare Part Name</span>
                <input type="text" class="form-control" name="sparePartName" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
              </div>
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">SparePart Description</span>
                <textarea class="form-control" name="sparePartDescription" aria-label="With textarea" required></textarea>
              </div>
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Stock Item Qty</span>
                <input type="number" class="form-control" name="stockItemQty" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
              </div>
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Weight</span>
                <input type="number" class="form-control" name="weight" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
              </div>
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Price</span>
                <input type="number" class="form-control" name="price" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
              </div>
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Discount Price</span>
                <input type="number" class="form-control" name="discountPrice" placeholder="" aria-label="" aria-describedby="basic-addon1">
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Spare Part Image</label>
                <input type="file" class="form-control" name="sparePartImage" id="inputGroupFile01">
              </div>
              <button type="submit" class="btn btn-primary">Add Item</button>
            </form>

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

</body>
<!--
    - custom js link
  -->
<script src="./assets/js/script.js"></script>
<script type="text/javascript" src="./assets/js/toast.js"></script>
<!--
    - ionicon link
  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
<script>
   document.getElementById('addItmeForm').addEventListener('submit', function(event) {
            const selectElement = document.getElementById('inputGroupSelect01');
            const selectError = document.getElementById('selectError');

            if (selectElement.value === "") {
                event.preventDefault(); // Prevent form submission
                selectError.style.display = 'block'; // Show error message
            } else {
                selectError.style.display = 'none'; // Hide error message
            }
        });
  function addToCart() {
    if (document.getElementById("stockItemStatus").innerText == "Out of Stock") {
      alert("Out of Stock\nNot allow to add to cart");
      return;
    }
    const url = "./assets/subphp/addtocart.php";
    const spareID = document.getElementById("sparePartNum").innerText;
    const spareQty = document.getElementById("quantityNumber").value;
    const spareName = document.getElementById("sparePartName").innerText;
    const data = {
      spareID: spareID,
      spareQty: parseInt(spareQty, 10)

    };

    fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      }).then(response => response.json())
      .then(responseData => {
        if (responseData.status === 'success') {
          showToast(`Added ${spareQty} of [${spareName}]`);
        } else {
          console.error('Error:', responseData.message);
        }
      }).catch(error => {
        console.error('Error:', error);
      });
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

</html>


<?php

$conn->close();

?>