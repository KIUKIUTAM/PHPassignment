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

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
    <!--
    - custom css link
  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style-prefix.css" />
    <link rel="stylesheet" href="./assets/css/style-shoppingCart.css" />
    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
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
                                    $index = 0;
                                    // Check if the session variable exists
                                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
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
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
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
                                                $spareQty = 0;
                                                foreach ($retrievedArray as $SessionRow) {
                                                    if ($SessionRow["spareID"] == $row["sparePartNum"]) {
                                                        $spareQty = $SessionRow["spareQty"];
                                                    }
                                                }
                                    ?>
                                                <div class="showcase">
                                                    <input type="checkbox" class="checkbox" id="SelectedItem<?php echo $index ?>" onchange="handleCheckboxChange(this,'<?php echo $row['sparePartName']; ?>',<?php echo $row['sparePartNum']; ?>,<?php echo $row['weight']; ?>,'quantityNumber<?php echo $index ?>',<?php echo $row['price'] ?>)">

                                                    <a href="#" class="showcase-img-box">
                                                        <img src="<?php echo $row['sparePartImage']; ?>" width="70" class="showcase-img" />
                                                    </a>

                                                    <div class="showcase-content">
                                                        <i class="bx bx-x red zoom" onclick="removeFromSession(<?php echo $row['sparePartNum']; ?>)"></i>
                                                        <a href="#">
                                                            <h4 class="showcase-title">Spare ID: <?php echo $row["sparePartNum"] ?>
                                                            </h4>
                                                        </a>
                                                        <a href="#">
                                                            <h4 class="showcase-title">Spare Name:
                                                                <?php echo $row["sparePartName"] ?></h4>
                                                        </a>

                                                        <a href="#" class="showcase-category"><?php echo $categoryName ?></a>

                                                        <div class="price-box">
                                                            <p class="price">$<?php echo $row["price"] ?></p>
                                                        </div>
                                                        <div class="quantity" id="quantityForitemNum">
                                                            <button onclick="quantityDecrement(<?php echo $index ?>,<?php echo $row['sparePartNum']; ?>)">
                                                                <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M20 12L4 12"></path>
                                                                </svg>
                                                            </button>

                                                            <input type="number" id="quantityNumber<?php echo $index ?>" name="quantity" value="<?php echo $spareQty; ?>" readonly>
                                                            <button onclick="quantityIncrement(<?php echo $index ?>,<?php echo $row['stockItemQty']; ?>)">
                                                                <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M12 4V20M20 12H4">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                    <?php
                                                $index++;
                                            }
                                        }
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
                            <span>Item total (USD) : $</span>
                            <strong id="ItemtotalPrice">0</strong>
                        </li>
                    </ul>

                    <div class="checkbox-wrapper-16">
                        <label class="checkbox-wrapper" style="margin-right: 30px;">
                            <input class="checkbox-input" type="radio" value="weight" name="deliveryMode" onchange="calDeliveryCost(this)">
                            <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bx-package'></i>
                                </span>
                                <span class="checkbox-label">Weight Mode</span>
                            </span>
                        </label>
                        <label class="checkbox-wrapper" >
                            <input class="checkbox-input" type="radio" value="quantity" name="deliveryMode" onchange="calDeliveryCost(this)">
                            <span class="checkbox-tile">
                                <span class="checkbox-icon">
                                    <i class='bx bxl-docker'></i>
                                </span>
                                <span class="checkbox-label">Quantity Mode</span>
                            </span>
                        </label>
                    </div>




                    <div class="accordion" id="accordionExample" style="margin-top: 30px;">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Delivery Description
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h5 class="accordion-title">Weight Mode:</h5>
                                    <strong>Initial cost (first 1 kg):</strong><br>
                                    <span>$300</span><br>
                                    <strong>Additional cost per kg:</strong><br>
                                    <span>(from 2nd kg): $50</span><br>
                                    <strong>Maximum weight:</strong><br>
                                    <span> 70 kg per package</span>
                                    <br><br>
                                    <h5 class="accordion-title">Quantity Mode:</h5>
                                    <strong>Initial cost (first unit):</strong><br>
                                    <span>$300</span><br>
                                    <strong>Additional cost per unit:</strong><br>
                                    <span>(from 2nd kg): $60</span><br>
                                    <strong>Max quantity:</strong><br>
                                    <span>30 units/package</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group" style="margin-top: 30px;">
                        <li class="list-group-item list-group-total">
                            <span>Delivery Cost (USD) : $</span>
                            <strong id="DeliveryCost">0</strong>
                        </li>
                        <li class="list-group-item list-group-total">
                            <span>Total (USD) : $</span>
                            <strong id="TotalPrice">0</strong>
                        </li>
                    </ul>


                    <button class="button_V" style="margin-top: 30px;" onclick="CreateOrder()">
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
        function calDeliveryCost(radioButton) {
            let totalWeight = 0;
            let totalQuantity = 0;

            // Check if the radio button is null or unchecked
            if (radioButton == null || radioButton.checked == false) {
                return;
            }

            // Get the item total price from the DOM
            ItemtotalPrice = document.getElementById('ItemtotalPrice').textContent;

            // Get the list of items and initialize an array to store them
            let list = document.getElementById('showPrice');
            let arr = [];

            // Reset the delivery cost and total price in the DOM
            document.getElementById('DeliveryCost').textContent = 0;
            document.getElementById('TotalPrice').textContent = 0;

            // If the list exists, calculate the total weight and quantity
            if (list) {
                const childList = list.getElementsByTagName('li');
                for (let i = 0; i < childList.length; i++) {
                    totalWeight += (childList[i].querySelector('#spareQty').textContent.substring(5) * childList[i]
                        .querySelector('#spareWeight').textContent.substring(12));
                    totalQuantity += (childList[i].querySelector('#spareQty').textContent.substring(5) * 1);
                }
            }

            // Determine the shipping method and value based on the selected radio button
            if (radioButton.value == "weight") {
                var shippingMethod = 'weight';
                var value = totalWeight;
            } else {
                var shippingMethod = 'quantity';
                var value = totalQuantity;
            }

            // Define the URL for the shipping cost API
            const url = `http://127.0.0.1:8080/ship_cost_api/${shippingMethod}/${value}`;

            // Make a GET request to the shipping cost API
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Check if the API response is accepted
                    if (data.result === 'accepted') {
                        // Update the delivery cost and total price in the DOM
                        document.getElementById('DeliveryCost').textContent = data.cost;
                        document.getElementById('TotalPrice').textContent = parseFloat(ItemtotalPrice) + parseFloat(data.cost);
                    } else {
                        // Alert the user if the API response is not accepted and uncheck the radio button
                        alert(data.reason);
                        radioButton.checked = false;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function CreateOrder() {
            // Get the list of items, total price, and delivery cost from the DOM
            let list = document.getElementById('showPrice');
            let TotalPrice = document.getElementById('TotalPrice').textContent;
            let deliveryCost = document.getElementById('DeliveryCost').textContent;

            // Check if the list exists
            if (list) {
                const childList = list.getElementsByTagName('li');
                let arr = new Array(childList.length);

                // Iterate through the list items and populate the array with item IDs and quantities
                for (let i = 0; i < childList.length; i++) {
                    arr[i] = new Array(2);
                    arr[i][0] = childList[i].querySelector('#spareID').textContent;
                    arr[i][1] = childList[i].querySelector('#spareQty').textContent.substring(5);
                }

                // Check if the array is empty and alert the user if no items are selected
                if (arr.length == 0) {
                    alert("Please select the item to make order");
                    return;
                }

                // Check if the total price is zero and alert the user if no delivery mode is selected
                if (TotalPrice == 0) {
                    alert("Please select the delivery mode to make order");
                    return;
                }

                // Create the data object to be sent in the POST request
                const data = {
                    order: arr,
                    TotalPrice: TotalPrice,
                    deliveryCost: deliveryCost
                };

                // Make a POST request to create the order
                fetch("./assets/subphp/createOrder.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        // Check if the response is not OK and throw an error if so
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(responseData => {
                        // Check if the order creation was successful
                        if (responseData.status === 'success') {
                            // Alert the user with the order details and reload the page
                            alert('Order created successfully\nOrderID:' + responseData.orderID.toString().padStart(6, '0') + '\nTotal Price:' + TotalPrice);
                            location.reload();
                        } else {
                            // Log an error message if the order creation failed
                            console.error('Error:', responseData.message);
                        }
                    })
                    .catch(error => {
                        // Log any errors that occur during the fetch operation
                        console.error('Error:', error);
                    });
            } else {
                // Log an error message if the element with ID "showPrice" is not found
                console.error('Element with ID "showPrice" not found.');
            }
        }

        function quantityDecrement(index, sparePartNum) {
            // Get the quantity input element based on the index
            var quantityInput = document.getElementById('quantityNumber' + index);

            // Check if decrementing the quantity will result in zero
            if ((quantityInput.value - 1) == 0) {
                // Confirm with the user if they want to delete the item from the shopping cart
                if (confirm('Are you sure you want to delete the item from the shopping cart?')) {
                    // Call the removeFromSession function to remove the item from the session
                    removeFromSession(sparePartNum);
                } else {
                    // If the user cancels the confirmation, do nothing and return
                    return;
                }
            } else if (quantityInput.value > 0) {
                // If the quantity is greater than zero, decrement the quantity by 1
                quantityInput.value--;
            }

            // Get the checkbox element based on the index (not used in this function)
            const checkbox = document.getElementById('SelectedItem' + index);
        }

        function quantityIncrement(index, max) {
            // Get the quantity input element based on the index
            var quantityInput = document.getElementById('quantityNumber' + index);

            // Check if the current quantity is less than the maximum allowed quantity
            if (quantityInput.value < max) {
                // If true, increment the quantity by 1
                quantityInput.value++;
            } else {
                // If false, alert the user that the quantity exceeds the stock quantity
                alert("The quantity is more than the stock quantity");
            }

            // Get the checkbox element based on the index (not used in this function)
            const checkbox = document.getElementById('SelectedItem' + index);
        }

        function removeFromSession(sparePartNum) {
            // Confirm with the user if they want to delete the item
            if (confirm('Are you sure you want to delete this item?')) {
                // Prepare the data object with the spare part number
                const data = {
                    spareID: sparePartNum
                };

                // Send a POST request to the server to remove the item from the session
                fetch("./assets/subphp/removeFromSession.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(responseData => {
                        // Check if the response status is 'success'
                        if (responseData.status === 'success') {
                            // If successful, reload the page
                            location.reload();
                        } else {
                            // If an error occurs, log the error message to the console
                            console.error('Error:', responseData.message);
                        }
                    })
                    .catch(error => console.error('Fetch error:', error)); // Handle any fetch errors
            } else {
                // If the user cancels the confirmation, do nothing and return
                return;
            }
        }

        function handleCheckboxChange(checkbox, spareName, spareID, spareWeight, numID, price) {
            // Get the selected delivery mode radio button
            let radioButton = document.querySelector('input[name="deliveryMode"]:checked');

            // Get the quantity of the spare part from the input field
            const spareQty = document.getElementById(numID).value;

            // Get the current total price from the DOM
            let TotalPrice = document.getElementById('ItemtotalPrice').textContent;

            // Find the closest '.showcase' element to the checkbox
            var showcase = checkbox.closest('.showcase');

            // If the '.showcase' element is found
            if (showcase) {
                // Find the quantity element within the '.showcase' element
                var quantityElement = showcase.querySelector('#quantityForitemNum');

                // If the quantity element is found
                if (quantityElement) {
                    // Get all button elements within the quantity element
                    var buttons = quantityElement.getElementsByTagName('button');

                    // Disable or enable the buttons based on the checkbox state
                    Array.prototype.forEach.call(buttons, function(button) {
                        button.disabled = checkbox.checked;
                    });
                }
            }

            // If the checkbox is checked
            if (checkbox.checked) {
                // Add the item to the cart
                addItem(spareName, spareID, spareWeight, spareQty, price);

                // Update the total price by adding the price of the selected item
                TotalPrice = parseFloat(TotalPrice) + (price * spareQty);
            } else {
                // Remove the item from the cart
                removeItem(('item-' + spareName.replace(/\s+/g, '-').toLowerCase()));

                // Update the total price by subtracting the price of the deselected item
                TotalPrice = parseFloat(TotalPrice) - (price * spareQty);
            }

            // Update the total price in the DOM
            document.getElementById('ItemtotalPrice').textContent = TotalPrice.toFixed(2);

            // Recalculate the delivery cost based on the selected delivery mode
            calDeliveryCost(radioButton);
        }

        function addItem(spareName, spareID, spareWeight, spareQty, price) {
            // Get the list element where the item will be appended
            const list = document.getElementById('showPrice');

            // Create a new list item (li) element
            const li = document.createElement('li');
            li.className = 'list-group-item d-none d-lg-block'; // Assign classes to the list item
            li.id = ('item-' + spareName.replace(/\s+/g, '-').toLowerCase()); // Set the id of the list item

            // Create a span element to display the total price of the item
            const span = document.createElement('span');
            span.className = 'text-body-secondary float-end'; // Assign classes to the span
            span.textContent = '$' + (price * spareQty).toFixed(2); // Set the text content to the total price

            // Create a div element to hold the item details
            const div = document.createElement('div');

            // Create an h6 element to display the spare ID
            const h6_1 = document.createElement('h6');
            h6_1.className = 'my-0'; // Assign classes to the h6
            h6_1.id = 'spareID'; // Set the id of the h6
            h6_1.textContent = spareID; // Set the text content to the spare ID

            // Create another h6 element to display the spare name
            const h6_2 = document.createElement('h6');
            h6_2.className = 'my-0'; // Assign classes to the h6
            h6_2.id = 'spareName'; // Set the id of the h6
            h6_2.textContent = spareName; // Set the text content to the spare name

            // Create a small element to display the spare weight
            const weight = document.createElement('small');
            weight.className = 'text-body-secondary'; // Assign classes to the small
            weight.id = 'spareWeight'; // Set the id of the small
            weight.textContent = 'Weight(Kg): ' + spareWeight; // Set the text content to the spare weight

            // Create a break element
            const dr = document.createElement('br');

            // Create another small element to display the spare quantity
            const small = document.createElement('small');
            small.className = 'text-body-secondary'; // Assign classes to the small
            small.id = 'spareQty'; // Set the id of the small
            small.textContent = 'Qty: ' + spareQty; // Set the text content to the spare quantity

            // Append the created elements to the div
            div.appendChild(h6_1);
            div.appendChild(h6_2);
            div.appendChild(weight);
            div.appendChild(dr);
            div.appendChild(small);

            // Append the span and div to the list item (li)
            li.appendChild(span);
            li.appendChild(div);

            // Append the list item (li) to the list
            list.appendChild(li);
        }

        function removeItem(id) {
            // Retrieve the item element by its ID
            const item = document.getElementById(id);

            // Check if the item exists
            if (item) {
                // Remove the item from the DOM
                item.remove();
            }

            // Update the cart count
            fetchCartCount();
        }

        function addToCart() {
            // URL of the server-side script that handles adding items to the cart
            const url = "./assets/subphp/addtocart.php";

            // Retrieve the spare part ID from the DOM
            const spareID = document.getElementById("sparePartNum").innerText;

            // Retrieve the quantity from the input field
            const spareQty = document.getElementById("quantityNumber").value;

            // Create an object to hold the data to be sent to the server
            const data = {
                spareID: spareID, // The ID of the spare part
                spareQty: parseInt(spareQty, 10) // The quantity of the spare part, converted to an integer
            };

            // Use the Fetch API to send a POST request to the server
            fetch(url, {
                    method: 'POST', // HTTP method
                    headers: {
                        'Content-Type': 'application/json' // Content type of the request
                    },
                    body: JSON.stringify(data) // Convert the data object to a JSON string
                })
                .then(response => response.json()) // Parse the JSON response from the server
                .then(responseData => {
                    // Check if the server responded with a success status
                    if (responseData.status === 'success') {
                        // Handle successful addition to the cart (e.g., show a success message)
                    } else {
                        // Log an error message if the server responded with an error
                        console.error('Error:', responseData.message);
                    }
                })
                .catch(error => {
                    // Log any errors that occurred during the fetch operation
                    console.error('Error:', error);
                });

            // Update the cart count
            fetchCartCount();
        }
    </script>
    <script src="./assets/js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(function() {
            $("header").load("./assets/subphp/header.php");
            $("footer").load("./assets/subphp/footer.php");
        });
    </script>
</body>

</html>