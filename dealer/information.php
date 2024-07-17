<?php
require_once('../db/connet.php');
session_start();
?>

<?php
$dealer_name = "";
$dealer_email = "";
$contact_areaCode = "";
$dealer_contact = "";
$fax_areaCode = "";
$dealer_fax = "";
$dealer_address = "";

if (isset($_SESSION['dealer'])) {
    $dealer = $_SESSION['dealer'];

    $stmt = $conn->prepare("SELECT dealerID,dealerName,dealerEmail, contactNumber, faxNumber, deliveryAddress FROM dealer WHERE dealerEmail = ?");
    $stmt->bind_param("s", $dealer);
    $stmt->execute();
    $result = $stmt->get_result();
    $dealerID ="";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dealer_email = $row['dealerEmail'];
        $dealerID = $row['dealerID'];
        if($row['dealerName'] ==null){$dealer_name = "Not Set";}
          else{$dealer_name = $row['dealerName'];}

        if($row['contactNumber'] == null){$dealer_contact = "Not Set";}
          else{
            $partForContact = explode('-', $row['contactNumber']);
            if (count($partForContact) === 2) {
                $contact_areaCode = $partForContact[0];
                $dealer_contact = $partForContact[1];
            }}

        if($row['faxNumber'] == null){$dealer_fax = "Not Set";}
          else{$partForFax = explode('-', $row['faxNumber']);
            if (count($partForFax) === 2) {
                $fax_areaCode = $partForFax[0];
                $dealer_fax = $partForFax[1];
            }}
        
        if($row['deliveryAddress'] == null){$dealer_address = "Not Set";}
        else{$dealer_address = $row['deliveryAddress'];}
    }
    $stmt->close();
    
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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/style-prefix.css" />
    <link rel="stylesheet" href="./assets/css/style-information.css" />

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
</head>

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
        <!-- informations-->
        <div class="productDetail-container">
            <div class="container" style=" margin-bottom: 30vh; width: 2000px;">
                <div class="d-lg-flex justify-content-between">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-information-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-information" type="button" role="tab"
                            aria-controls="v-pills-information" aria-selected="true">Information</button>
                        <button class="nav-link" id="v-pills-update-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-update" type="button" role="tab" aria-controls="v-pills-update"
                            aria-selected="false">Information Update</button>
                        <button class="nav-link" id="v-pills-Order-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-Order" type="button" role="tab" aria-controls="v-pills-Order"
                            aria-selected="false">Order Record</button>

                    </div>
                    <div class="flex-grow-1 tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-information" role="tabpanel"
                            aria-labelledby="v-pills-information-tab">
                            <div class="information-title">information</div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="<?php echo $dealer_name ?>"
                                            disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="<?php echo $dealer_email ?>"
                                            disabled />
                                        <div id="emailHelp" class="form-text">
                                            We'll never share your email with anyone else.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Contact Number</label>
                                        <div class="input-group">
                                            <select class="form-select" id="inputGroupSelect01" disabled>
                                                <option selected>+<?php echo $contact_areaCode?></option>
                                            </select>
                                            <input type="number" class="form-control w-75 p-2" id="basic-url"
                                                aria-describedby="basic-addon3 basic-addon4"
                                                placeholder="<?php echo $dealer_contact ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Fax Number</label>
                                        <div class="input-group">
                                            <select class="form-select" id="inputGroupSelect01" disabled>
                                                <option selected>+<?php echo $fax_areaCode ?></option>
                                            </select>
                                            <input type="number" class="form-control w-75 p-2" id="basic-url"
                                                aria-describedby="basic-addon3 basic-addon4"
                                                placeholder="<?php echo $dealer_fax ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Delivery Address</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="basic-url"
                                                aria-describedby="basic-addon3 basic-addon4"
                                                placeholder="<?php echo $dealer_address ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- information update-->

                        <div class="tab-pane fade" id="v-pills-update" role="tabpanel"
                            aria-labelledby="v-pills-update-tab">
                            <form action="./UpdateInformation.php" method="POST">
                                <div class="information-title">Information Update</div>
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="nameForUpdate" pattern="^[A-Za-z\s]{1,}$" title="Only letters and space allowed"
                                            id="nameForUpdate" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="passwordForUpdate" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            name="passwordForUpdate" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Contact Number</label>
                                        <div class="input-group">

                                            <select class="form-select" id="areaCodeForUpdate" name="areaCodeForUpdate">
                                                <option value="852" selected>+852</option>
                                                <option value="886">+886</option>
                                                <option value="86">+86</option>
                                                <option value="853">+853</option>
                                            </select>
                                            <input type="text" class="form-control w-75 p-2"
                                                id="contactNumberForUpdate" name="contactNumberForUpdate" pattern="^[0-9]{8,}$" title="Please enter a valid fax number with at least 8 digits"
                                                aria-describedby="basic-addon3 basic-addon4" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Fax Number</label>
                                        <div class="input-group">
                                            <select class="form-select" id="faxAreaCodeForUpdate"
                                                name="faxAreaCodeForUpdate">
                                                <option value="852" selected>+852</option>
                                                <option value="886">+886</option>
                                                <option value="86">+86</option>
                                                <option value="853">+853</option>
                                            </select>
                                            <input type="text" class="form-control w-75 p-2" id="faxNumberForUpdate" name="faxNumberForUpdate"
                                                   pattern="^[0-9]{8,}$" title="Please enter a valid fax number with at least 8 digits"
                                                   aria-describedby="basic-addon3 basic-addon4">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">Delivery Address</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="deliveryAddressForUpdate"
                                                name="deliveryAddressForUpdate"
                                                aria-describedby="basic-addon3 basic-addon4" />
                                        </div>
                                    </div>

                                    <button id="submit-button" type="submit" name="submit">
                                        <span class="circle1"></span>
                                        <span class="circle2"></span>
                                        <span class="circle3"></span>
                                        <span class="circle4"></span>
                                        <span class="circle5"></span>
                                        <span class="text">Submit</span>
                                    </button>

                                </div>

                            </form>
                        </div>






                        <!-- Order View-->
  
                        <div class="tab-pane fade" id="v-pills-Order" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Date & Time</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Delivery Date</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Cancel Order</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                      $stmt = $conn->prepare("SELECT * FROM `orders` WHERE dealerID = ?");
                                      $stmt->bind_param("s", $dealerID);
                                      $stmt->execute();
                                      $result = $stmt->get_result();

                                      if ($result->num_rows > 0) {
                                          while ($row = $result->fetch_assoc()) {
                                              $deliveryDate = $row['deliveryDate'] == null ? "Not yet delivered" : $row['deliveryDate'];
                                              $OrderStatus = "";
                                                switch ($row['orderStatus']) {
                                                    case 1:
                                                        $OrderStatus = "Wait for approval";
                                                        break;
                                                    case 2:
                                                        $OrderStatus = "Wait for delivery";
                                                        break;
                                                    case 3:
                                                        $OrderStatus = "Delivered";
                                                        break;
                                                    case 4:
                                                        $OrderStatus = "Cancelled";
                                                        break;
                                                }
                                     ?><tr>
                                       <th scope="row"><?php echo sprintf('%06d', $row['orderID']);?></th>
                                       <td><?php echo $row['orderDateTime'] ?></td>
                                       <td><?php echo $OrderStatus ?></td>
                                       <td><?php echo $deliveryDate ?></td>
                                       <td>
                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                           data-bs-target="#Modal-Detail" onclick="uploadOrderDetail(<?php echo $row['orderID'];?>,'<?php echo $row['orderDateTime'] ?>','<?php echo $row['deliveryAddress'] ?>','<?php echo $deliveryDate ?>','<?php echo $row['orderPrice'] ?>')">Details</button></td>
                                            <?php if ($row['requestCancelStatus']) { ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" disabled>Wait For approval</button>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" onclick="cancelOrder('<?php echo $row['orderID']; ?>')">Cancel Order</button>
                                                </td>
                                            <?php } ?>
                                     </tr>
                                      <?php
                                          }
                                         }
                                     ?>
                                </tbody>
                            </table>

                            <div class="modal fade" id="Modal-Detail" tabindex="-1" role=""
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="ModalLabel">Details</h1>
                                        </div>
                                        <div class="modal-body">
                                            <br>
                                            <form>
                                                <div class="form-group row margin-bottom10">
                                                    <label for="inputOrderID" class="col-sm-3 col-form-label ">Order
                                                        ID:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="OrderDetail-OrderID"
                                                            placeholder="" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row margin-bottom10">
                                                    <label for="inputOrderDate" class="col-sm-3 col-form-label">Order
                                                        Date & Time:</label>
                                                    <div class="col-sm-8">
                                                        <input type="datetime" class="form-control" id="OrderDetail-orderDateTime"
                                                            placeholder="" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row margin-bottom10">
                                                    <label for="inputDeliveryAddress"
                                                        class="col-sm-3 col-form-label">Delivery Address:</label>
                                                    <div class="col-sm-8">
                                                        <input type="datetime" class="form-control"
                                                            id="OrderDetail-deliveryAddress"
                                                            placeholder=""
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group row margin-bottom10">
                                                    <label for="inputDeliveryAddress"
                                                        class="col-sm-3 col-form-label">Delivery Date:</label>
                                                    <div class="col-sm-8">
                                                        <input type="datetime" class="form-control" id="OrderDetail-deliveryDate"
                                                            placeholder="" disabled>
                                                    </div>
                                                </div>
                                                <h5 style="margin-top: 50px; margin-bottom: 20px;">Order item:</h5>

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Spare Part number</th>
                                                            <th scope="col">Spare Part Name</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="OrderItemList">
                                                    </tbody>
                                                </table>
                                                <h5>Total Order Amount: $<span id="Detail-totalPrice">0</span></h5>

                                            </form>


                                        </div>
                                        <div class="modal-footer no-print">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal" >Close</button>
                                            <button type="button" class="btn btn-success"  onclick="printTheOrderDetail()">Print the Order</button>
                                        </div>
                                    </div>
                                </div>
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
    function uploadOrderDetail(orderID,orderDateTime,deliveryAddress,deliveryDate,orderPrice) {
        document.getElementById("OrderDetail-OrderID").placeholder  = orderID.toString().padStart(6, '0');
        document.getElementById("OrderDetail-orderDateTime").placeholder  = orderDateTime;
        document.getElementById("OrderDetail-deliveryAddress").placeholder  = deliveryAddress;
        document.getElementById("OrderDetail-deliveryDate").placeholder  = deliveryDate;
        document.getElementById("Detail-totalPrice").innerText = orderPrice;
        const url = "./orderDetail.php";
        const data = {
            orderID: orderID
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
                const orderLine = responseData.orderLine;

                const orderItemList = document.getElementById("OrderItemList");
                orderItemList.innerHTML = "";

                orderLine.forEach((item, index) => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                        <th scope="row">${index + 1}</th>
                        <td>${item.sparePartNum}</td>
                        <td>${item.sparePartName}</td>
                        <td>${item.orderQty}</td>
                        <td>$${item.price}</td>
                    `;
                    orderItemList.appendChild(tr);
                });
            } else {
                console.error('Error:', responseData.message);
            }
        }).catch(error => {
            console.error('Fetch error:', error);
        });
    }


    function printTheOrderDetail(){
        var printContents = document.getElementById('Modal-Detail').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
        
    }
    function cancelOrder(orderID){
        if(!confirm("Are you sure you want to cancel this order?")){
            return;
        };
        const url = "./cancelOrder.php";
        const data = {
            orderID: orderID
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
                alert("Order has been cancelled");
                window.location.reload();
            } else {
                console.error('Error:', responseData.message);
            }
        }).catch(error => {
            console.error('Fetch error:', error);
        });
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>
    $(function() {
        $("header").load("./header.php");
        $("footer").load("./footer.php");
    });
    </script>
</body>

</html>