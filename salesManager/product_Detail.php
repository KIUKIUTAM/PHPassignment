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

  <link rel="stylesheet" href="./assets/css/style-prefix.css" />
  <link rel="stylesheet" href="./assets/css/style-productDetail.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

</head>
<style>
  a {
    text-decoration: none !important;
  }

  del {
    color: red;
  }
</style>

<body>
  <header></header>
  <main>

    <div class="productDetail-container">

      <?php
      $sparePartNum = $_GET["sparePartNum"];
      $sql = "SELECT sparePart.sparePartNum As sparePartNum,sparePart.sparePartImage,sparePart.stockItemQty,sparePart.sparePartName,sparePart.weight,sparePart.sparePartDescription, sparePart.price, sparePart.discountPrice,disabledsparepart.disable FROM sparePart LEFT JOIN disabledsparepart ON sparePart.sparePartNum = disabledsparepart.sparePartNum WHERE sparePart.sparePartNum = " . $sparePartNum;
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
          <label class="switch ">
              <input type="checkbox" id="disableSwitch" <?php if ($row["disable"] != 1) {
                                                          echo "checked='checked'";
                                                        } ?> onclick="disableSparePart(<?php echo $row['sparePartNum'] ?>)">
              <div class="button">
                <div class="light"></div>
                <div class="dots"></div>
                <div class="characters"></div>
                <div class="shine"></div>
                <div class="shadow"></div>
              </div>
            </label>
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
                <label id="bold">Spare ID: </label><span class="product-title" id="sparePartNumShow"><?php echo $row["sparePartNum"] ?></span><br>
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
                    echo "<div class='price-box'><label id='bold'>Price:</label><p class='price' id='price'>$ $price</p>";
                  } else {
                    $price = $row["discountPrice"];
                    $delPrice = $row["price"];
                    echo "<div class='price-box'><label id='bold'>Price:</label>
                    <p class='price' id='price'>$ $price</p>
                    <del>$ $delPrice</del>";
                  } ?>
                </div>
              </div>
              <button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#Modal-Detail' onclick="detailAddId()">Edit Item</button>
              <button type='button' class='btn btn-outline-danger' onclick="DeleteItem()">Delete</button>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
    <div class="modal fade" id="Modal-Detail" tabindex="-1" role="" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalLabel">Edit Item</h1>
          </div>
          <div class="modal-body">
            <form method="POST" action="./assets/subphp/editItem.php" enctype="multipart/form-data">
              <div class="form-group row mb-3">
                <label for="" class="col-sm-3 col-form-label">Spare Part Num:</label>
                <div class="col-sm-7">
                  <input type="number" class="form-control" name="sparePartNumDisplay" value="" disabled>
                  <input type="hidden" name="sparePartNum" value="">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="" class="col-sm-3 col-form-label">Spare Part Description:</label>
                <div class="col-sm-7">
                  <textarea class="form-control" aria-label="With textarea" name="sparePartDescription"></textarea>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="" class="col-sm-3 col-form-label">Stock Item Quantity:</label>
                <div class="col-sm-7">
                  <input type="number" class="form-control" name="stockItemQty">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="" class="col-sm-3 col-form-label">Price:</label>
                <div class="col-sm-7">
                  <input type="number" step="0.01" class="form-control" name="price" min="0">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="" class="col-sm-3 col-form-label">Discount Price:</label>
                <div class="col-sm-7">
                  <input type="number" step="0.01" class="form-control" name="discountPrice" min="0">
                </div>
              </div>
              <div class="form-group row mb-3">
                <div class="input-group mb-3">
                  <label for="" class="col-sm-3 col-form-label">Spare Part Image:</label>
                  <div class="col-sm-7">
                    <input type="file" class="form-control" name="sparePartImage" accept="image/*">
                  </div>
                </div>
              </div>
              <div class="form-group row mb-3 justify-content-center">
                <div class="col-sm-6">
                  <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer no-print">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
  function detailAddId() {
    let id = document.getElementById('sparePartNumShow').innerText;
    document.querySelector('input[name="sparePartNum"]').value = id;
    document.querySelector('input[name="sparePartNumDisplay"]').value = id;
  }

  function showToast(message) {
    toastNotif({
      text: message,
      color: '#5bc83f',
      timeout: 5000,
      icon: 'valid'
    });
  }

  function disableSparePart(sparePartNum) {
    let disableSwitch = document.getElementById('disableSwitch');
    let disable = disableSwitch.checked ? 0 : 1; // 0 = enable, 1 = disable

    fetch('./assets/subphp/disableSparePart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          sparePartNum: sparePartNum,
          disable: disable
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          console.log('Operation successful:', data);
        } else {
          console.log('Operation failed:', data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
  function DeleteItem() {
    if(!confirm("Are you sure you want to delete this item?")){
      return;
    };
    let sparePartNum = document.getElementById('sparePartNumShow').innerText;
    fetch('./assets/subphp/deleteItem.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          sparePartNum: sparePartNum
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          console.log('Operation successful:', data);
          showToast('Item deleted successfully');
          setTimeout(() => {
            window.location.href = './listOfProduct?Category=ALL';
          }, 1000);
        }if(data.status ==="ItemUsing"){

          showToast('Item is using in order');
        } else {
          console.log('Operation failed:', data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
</script>

</html>


<?php

$conn->close();

?>