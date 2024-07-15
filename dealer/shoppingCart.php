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
  <link rel="shortcut icon" href="../asserts/img/catHead.jpg" type="image/x-icon" />
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
                  $index= 0;
                  // Check if the session variable exists
                  if (isset($_SESSION['cart'])&& !empty($_SESSION['cart'])) {
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
                        $spareQty = 0;
                            foreach ($retrievedArray as $SessionRow) {
                                 if($SessionRow["spareID"]== $row["sparePartNum"]){
                                  $spareQty = $SessionRow["spareQty"];
                             }
                            }
                            ?>
                        <div class="showcase">
                        <input type="checkbox" class="checkbox" id="SelectedItem<?php echo $index?>" onchange="handleCheckboxChange(this,'<?php echo $row['sparePartName']; ?>',<?php echo $row['sparePartNum']; ?>,'quantityNumber<?php echo $index?>',<?php echo $row['price'] ?>)">
                        
                        <a href="#" class="showcase-img-box">
                          <img src="<?php echo $row['sparePartImage']; ?>" width="70" class="showcase-img" />
                        </a>
    
                        <div class="showcase-content">
                          <i class="bx bx-x red zoom" onclick="removeFromSession(<?php echo $row['sparePartNum']; ?>)"></i>
                          <a href="#">
                            <h4 class="showcase-title">Spare ID: <?php echo $row["sparePartNum"]?></h4>
                          </a>
                          <a href="#">
                            <h4 class="showcase-title">Spare Name: <?php echo $row["sparePartName"]?></h4>
                          </a>
    
                          <a href="#" class="showcase-category"><?php echo $categoryName?></a>
    
                          <div class="price-box">
                            <p class="price">$<?php echo$row["price"]?></p>
                          </div>
                          <div class="quantity">
                            <button onclick="quantityDecrement(<?php echo $index?>,<?php echo $row['sparePartNum']; ?>)">
                                <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M20 12L4 12"></path>
                                </svg>
                            </button>
                          
                            <input type="number" id="quantityNumber<?php echo $index?>" name="quantity" value="<?php echo $spareQty; ?>" readonly>
                            <button onclick="quantityIncrement(<?php echo $index?>,<?php echo $row['stockItemQty']; ?>)">
                                <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M12 4V20M20 12H4"></path>
                                </svg>
                            </button>
                          </div>
                        </div>
                         
                      </div>
                      <?php 
                      $index++;
                      }}
                  } else {
                      echo "No items in the cart";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-50">
          <h4 class="d-none d-lg-block">
            <span class="text-primary">Your cart</span>
          </h4>
          <ul class="list-group" id="showPrice">
          </ul>
          <ul class="list-group">
            <li class="list-group-item list-group-total">
              <span>Total (USD) : $</span>
              <strong id="TotalPrice">0</strong>
            </li>
          </ul>


          <button  class="button_V" style="margin-top: 30px;" onclick="CreateOrder()">
            <span class="button_top"> Make Order</span>
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
  <script>
function CreateOrder() {
    let list = document.getElementById('showPrice');
    if (list) {
        const childList = list.getElementsByTagName('li');
        let arr = new Array(childList.length);

        for (let i = 0; i < childList.length; i++) {
            arr[i] = new Array(2); 
            arr[i][0] = childList[i].querySelector('#spareID').textContent; 
            arr[i][1] = childList[i].querySelector('#spareQty').textContent.substring(5);
        }

        alert(JSON.stringify(arr));
    } else {
        console.error('Element with ID "showPrice" not found.');
    }
}
  
  function quantityDecrement(index,sparePartNum) {
    var quantityInput = document.getElementById('quantityNumber' + index);
    if ((quantityInput.value-1) == 0) {
      if (confirm('Are you Delete the item from shoppingCart?')) {
        removeFromSession(sparePartNum);
        } else {
            return;
        }
    }else if(quantityInput.value > 0) {
        quantityInput.value--;
    }
    const checkbox = document.getElementById('SelectedItem'+index);
    if (checkbox.checked) {
      checkbox.checked = false;
    }
  }

function quantityIncrement(index,max) {
    var quantityInput = document.getElementById('quantityNumber' + index);
    if (quantityInput.value < max) {
        quantityInput.value++;
    }else{
      alert("The quantity is more than the stock quantity");
    }
    const checkbox = document.getElementById('SelectedItem'+index);
    if (checkbox.checked) {
      checkbox.checked = false;
    }
}

function removeFromSession(sparePartNum) {
  if(confirm('Are you sure you want to delete this item?')) {
    const data = {
        spareID: sparePartNum
    };
    fetch("removeFromSession.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.status === 'success') {
            location.reload();
        } else {
            console.error('Error:', responseData.message);
        }
    })
    .catch(error => console.error('Fetch error:', error));
  } else {
    return;
  }
    
}
function handleCheckboxChange(checkbox,spareName,spareID,numID,price) {
    const spareQty = document.getElementById(numID).value;
    let TotalPrice = document.getElementById('TotalPrice').textContent;
    if (checkbox.checked) {
      addItem(spareName,spareID,spareQty,price);
      TotalPrice = parseFloat(TotalPrice) + (price * spareQty);
    } else {
      removeItem(('item-' + spareName.replace(/\s+/g, '-').toLowerCase()));
      TotalPrice = parseFloat(TotalPrice) - (price * spareQty);
    }
    document.getElementById('TotalPrice').textContent = TotalPrice.toFixed(2);
}
function addItem(spareName,spareID, spareQty, price) {
    const list = document.getElementById('showPrice');

    const li = document.createElement('li');
    li.className = 'list-group-item d-none d-lg-block';
    li.id = ('item-' + spareName.replace(/\s+/g, '-').toLowerCase());

    const span = document.createElement('span');
    span.className = 'text-body-secondary float-end';
    span.textContent = '$' + (price * spareQty).toFixed(2);

    const div = document.createElement('div');

    const h6_1 = document.createElement('h6');
    h6_1.className = 'my-0';
    h6_1.id = 'spareID';
    h6_1.textContent = spareID;
    const h6_2 = document.createElement('h6');
    h6_2.className = 'my-0';
    h6_2.id = 'spareName';
    h6_2.textContent = spareName;

    const small = document.createElement('small');
    small.className = 'text-body-secondary';
    small.id = 'spareQty';
    small.textContent = 'Qty: ' + spareQty;

    div.appendChild(h6_1);
    div.appendChild(h6_2);
    div.appendChild(small);
    li.appendChild(span);
    li.appendChild(div);
    list.appendChild(li);
    
}
function removeItem(id) {
    const item = document.getElementById(id);
    if (item) {
        item.remove();
    }
}
function addToCart() {
        const url = "../dealer/addtocart.php";
        const spareID = document.getElementById("sparePartNum").innerText;
        const spareQty = document.getElementById("quantityNumber").value;

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
                    showToast(`Added ${spareQty} of item ${spareID} to cart`);
                } else {
                    console.error('Error:', responseData.message);
                }
            }).catch(error => {
                console.error('Error:', error);
            });
            fetchCartCount();
    }
  </script>
  
  <script>
    function fetchCartCount() {
        fetch("cart_count.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.cart_count !== undefined) {
                document.getElementById("shoppingCartCount1").innerText = responseData.cart_count;
                document.getElementById("shoppingCartCount2").innerText = responseData.cart_count;
            } else {
                console.error('Error:', responseData.message);
            }
        })
        .catch(error => console.error('Fetch error:', error));
    }
    // 每5秒执行一次fetchCartCount函数
    setInterval(fetchCartCount, 5000);
  </script>
  <script>
    function showToast(message) {
        const toast = document.createElement('div');


}
    </script>
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