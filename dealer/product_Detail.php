<?php
require_once ('../db/connet.php');
?>
<?php
$sparePartNum = $_GET["sparePartNum"];
echo$sparePartNum;
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
    <link rel="stylesheet" href="assets\css\style-productDetail.css" />
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
';
echo'
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

      <div class="productDetail-container">';
      $sql = "SELECT * FROM sparePart WHERE sparePartNum = ".$sparePartNum;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $categoryName="";
        switch(substr($row["sparePartNum"],0,1)){
          case "1":$categoryName="Sheet Metal";
          break;
          case "2":$categoryName="Major Assemblies";
          break;
          case "3":$categoryName="Light Components";
          break;
          case "4":$categoryName="Accessories";
          break;
        };
        echo'<div class="container">
          <div class="product-box">
            <div class="product">
              <a href="#" class="product-img-box">
                <img
                  src="'.$row["sparePartImage"].'"
                  alt="product-img-box"
                  width="300"
                  class="product-img"
                />
              </a>
                ';
                if($row["stockItemQty"]>=100){
                  $stockItemStatus = "In Stock";
                  echo'<style>#stockItemStatus{color:green;
                  ;}
                  </style>';
                }else{
                  $stockItemStatus = "Out of Stock";
                  echo'<style>#stockItemStatus{color:red;
                  ;}
                  </style>';
                };
                echo'
                <div class="product-content">
                <label id="bold" >Spare ID:  </label><span class="product-title" id="sparePartNum">'.$row["sparePartNum"].'</span><br>
                <label id="bold" >Spare Name:  </label><span class="product-title">'.$row["sparePartName"].'</span><br>
                <label id="bold" >Weight:  </label><span class="product-title">'.$row["weight"].'Kg </span><br>
                <label id="bold" >Stock Status:  </label><span class="product-title" id="stockItemStatus">'.$stockItemStatus.'</span><br>
                <br>
                <label id="bold" >Description:</label>
                <p class="product-description">
                  '.$row["sparePartDescription"].'
                <br><br><div class="price-box">';
                if($row["discountPrice"]==null){
                  $price = $row["price"];
                  echo'<div class="price-box">
                  <p class="price">$'.$price.'</p>';
                }else{
                  $price = $row["discountPrice"];
                  $delPrice= $row["price"];
                  echo'<div class="price-box">
                  <p class="price">$'.$price.'</p>
                  <del>$'.$delPrice.'</del>';
                }
                echo'</div>
                  <div class="quantity">
                    <button onclick="quantityDecrement()">
                      <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M20 12L4 12"></path>
                      </svg>
                    </button>
                    <input id="quantityNumber"  type="number" value="1" min="0"/>
                    <button onclick="quantityIncrement()">
                      <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M12 4V20M20 12H4"></path>
                      </svg>
                    </button>
                  </div>
                <button class="product-content-button">Buy Now</button>
                <button class="product-content-button" onclick="addRowToArray()">Add To Cart</button>
              </div>
            </div>  
          </div>
        </div>';
      }
        echo'
      </div>
    </main>

    <!--
    - FOOTER
  -->

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
    function addRowToArray() {
    let sparePartNum = document.getElementById("sparePartNum").textContent;
    let num = parseInt(document.getElementById("quantityNumber").value, 10);
    let storedArray = sessionStorage.getItem("MyCart");
    if (storedArray) {
        let MyCart = JSON.parse(storedArray);
        let found = false;

        MyCart.forEach(row => {
            if (row[0] === sparePartNum) {
                row[1] = row[1] + num;
                found = true;
            }
        });

        if (!found) {
            let newRow = [sparePartNum, num];
            MyCart.push(newRow);
        }

        sessionStorage.setItem("MyCart", JSON.stringify(MyCart));
    } else {
        let my2DArray = [[sparePartNum, num]];
        sessionStorage.setItem("MyCart", JSON.stringify(my2DArray));
    }
        alert("Item "+sparePartNum+"added to cart");
}
    </script>
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
          $(".sidebar").load("./sidebar.php");
      });
    </script>
  </body>
</html>';
?>