<?php
require_once('../db/connect.php');
session_start();
?>

<?php
if (!isset($_SESSION['dealer'])) {
    header("Location: ../login.php");
    exit();
}
if (isset($_SESSION['dealer'])) {
    $dealer = $_SESSION['dealer'];

    $stmt = $conn->prepare("SELECT dealerID FROM dealer WHERE dealerEmail = ?");
    $stmt->bind_param("s", $dealer);
    $stmt->execute();
    $result = $stmt->get_result();
    $dealerID = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dealerID = $row['dealerID'];
    }
    $stmt->close();
}
if (isset($_GET['startDateTime']) && isset($_GET['endDateTime'])) {
    $startDateTime = $_GET['startDateTime'];
    $endDateTime = $_GET['endDateTime'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SLMS - eCommerce Website</title>
    <!--- favicon -->
    <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
    <!--- custom css link -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/date-1.5.2/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/style-prefix.css" />
    <link rel="stylesheet" href="./assets/css/style-information.css" />
    <!--- google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <style>
        .text-center {
            text-align: center;
        }


        td.ColorGreen {
            color: #198754 !important;
        }

        td.ColorLightRed {
            color: #986F4D !important;
        }

        td.ColorRed {
            color: #DC3545 !important;
        }
    </style>
</head>

<body>
    <!--- HEADER-->
    <header>
    </header>
    <!-- MAIN-->
    <main>
        <!-- PRODUCT-->
        <div class="productDetail-container">
            <div class="container" style=" margin-bottom: 30vh; width: 2000px;">

                <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="row w-100">
                                <!-- First Row: Search Form -->
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="./OrderView.php">Show All</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Order Status
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" id="orderStatusWaitForApproval" href="#" onclick="orderStatus(1)">Wait for approval</a></li>
                                                <li><a class="dropdown-item" id="orderStatusWaitForDelivery" href="#" onclick="orderStatus(2)">Wait for delivery</a></li>
                                                <li><a class="dropdown-item" id="orderStatusDelivered" href="#" onclick="orderStatus(3)">Delivered</a></li>
                                                <li><a class="dropdown-item" id="orderStatusRequestCancelled" href="#" onclick="orderStatus(4)">Request Cancel</a></li>
                                                <li><a class="dropdown-item" id="orderStatusCancelled" href="#" onclick="orderStatus(5)">Cancelled</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Second Row: Date Picker -->
                                <div class="col-12">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <div class="input-group">
                                            <span class="input-group-text">Order Create Date:</span>
                                            <input type="datetime-local" aria-label="Start Date" class="form-control" id="startDateTime" <?php if (isset($_GET['startDateTime'])) echo "value=\"$_GET[startDateTime]\""; ?>>
                                            <input type="datetime-local" aria-label="End Date" class="form-control" id="endDateTime" <?php if (isset($_GET['endDateTime'])) echo "value=\"$_GET[endDateTime]\""; ?>>
                                            <button class="btn btn-outline-success form-control" type="button"><a onclick="searchDate()" id="datePicker" href="#">Search</a></button>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <table class="table table-striped table-hover" OrderItemList id="OrderViewTable"></table>
                <div class="modal fade" id="Modal-Detail" tabindex="-1" role="" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                            <input type="text" class="form-control" id="OrderDetail-OrderID" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputOrderDate" class="col-sm-3 col-form-label">Order
                                            Date & Time:</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" id="OrderDetail-orderDateTime" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Delivery Address:</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" id="OrderDetail-deliveryAddress" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Delivery Date:</label>
                                        <div class="col-sm-8">
                                            <input type="datetime" class="form-control" id="OrderDetail-deliveryDate" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <h5 style="margin-top: 50px; margin-bottom: 20px;">Order item:</h5>

                                    <table class="table display" id="DataTableForOrderDetail">

                                    </table>
                                    <h5>Total Order Amount: $<span id="Detail-totalPrice">0</span></h5>

                                </form>


                            </div>
                            <div class="modal-footer no-print">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="printTheOrderDetail()">Print the Order</button>
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

</body>
<script src="./assets/js/script.js"></script>

<!--
- ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.0/date-1.5.2/datatables.min.js"></script>
<script>
    $(function() {
        $("header").load("./assets/subphp/header.php");
        $("footer").load("./assets/subphp/footer.php");
    });
</script>



<script>
    var currentUrl = window.location.href;
    var urlForOrderBY = new URL(currentUrl);


    //date time picker
    function searchDate() {

        var startDateTime = document.getElementById('startDateTime').value;
        var endDateTime = document.getElementById('endDateTime').value;


        if (!startDateTime || !endDateTime) {
            alert('Choose the start and end date time.');
            return;
        }


        var start = new Date(startDateTime);
        var end = new Date(endDateTime);


        if (end <= start) {
            alert('the end date time must be later than the start date time.');
            return;
        }
        urlForOrderBY.searchParams.set('startDateTime', startDateTime);
        urlForOrderBY.searchParams.set('endDateTime', endDateTime);
        document.getElementById('datePicker').href = urlForOrderBY.toString();

    }


    // Order Status
    function orderStatus(orderStatus) {
        switch (orderStatus) {
            case 1:
                urlForOrderBY.searchParams.set('orderStatus', 'WaitForApproval');
                document.getElementById('orderStatusWaitForApproval').href = urlForOrderBY.toString();
                break;
            case 2:
                urlForOrderBY.searchParams.set('orderStatus', 'WaitForDelivery');
                document.getElementById('orderStatusWaitForDelivery').href = urlForOrderBY.toString();
                break;
            case 3:
                urlForOrderBY.searchParams.set('orderStatus', 'Delivered');
                document.getElementById('orderStatusDelivered').href = urlForOrderBY.toString();
                break;
            case 4:
                urlForOrderBY.searchParams.set('orderStatus', 'RequestCancel');
                document.getElementById('orderStatusRequestCancelled').href = urlForOrderBY.toString();
                break;
            case 5:
                urlForOrderBY.searchParams.set('orderStatus', 'Cancelled');
                document.getElementById('orderStatusCancelled').href = urlForOrderBY.toString();
                break;
        }

    }


    function refreshOrderView() {
        const url2 = "./assets/subphp/orderViewDataRefresh.php";
        const data = {
            dealer: "<?php echo $dealer; ?>",
            orderStatus: "<?php echo $orderStatus; ?>",
            startDateTime: "<?php echo $startDateTime; ?>",
            endDateTime: "<?php echo $endDateTime; ?>"
        };

        fetch(url2, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(responseData => {
                if (responseData.status === 'success') {
                    console.log(responseData.data);
                    const orderData = responseData.data;
                    if ($.fn.dataTable.isDataTable('#OrderViewTable')) {
                        // Destroy the existing DataTable
                        $('#OrderViewTable').DataTable().destroy();
                    }
                    // Initialize DataTable
                    new DataTable('#OrderViewTable', {
                        columns: [{
                                title: 'Order ID',
                                className: 'text-center'
                            },
                            {
                                title: 'Order Date & Time',
                                className: 'text-center'
                            },
                            {
                                title: 'Delivery Address',
                                className: 'text-center'
                            },
                            {
                                title: 'Delivery Date',
                                className: 'text-center'
                            },
                            {
                                title: 'Total Price',
                                className: 'text-center'
                            },
                            {
                                title: 'Order Status',
                                className: 'text-center'
                            }
                        ],
                        data: orderData,
                        createdRow: function(row, data, dataIndex) {
                            var statusCell = $('td', row).eq(2);
                            if (data[2] === 'Wait for approval') {
                                statusCell.addClass('ColorYellow');
                            } else if (data[2] === 'Wait for delivery') {
                                statusCell.addClass('ColorYellow');
                            } else if (data[2] === 'Delivered') {
                                statusCell.addClass('ColorGreen');
                            } else if (data[2] === 'Request Cancel') {
                                statusCell.addClass('ColorLightRed');
                            } else if (data[2] === 'Cancelled') {
                                statusCell.addClass('ColorRed');
                            }
                        }
                    });
                } else {
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }
    refreshOrderView();



    function uploadOrderDetail(orderID, orderDateTime, deliveryAddress, deliveryDate, orderPrice) {
        document.getElementById("OrderDetail-OrderID").placeholder = orderID.toString().padStart(6, '0');
        document.getElementById("OrderDetail-orderDateTime").placeholder = orderDateTime;
        document.getElementById("OrderDetail-deliveryAddress").placeholder = deliveryAddress;
        document.getElementById("OrderDetail-deliveryDate").placeholder = deliveryDate;
        document.getElementById("Detail-totalPrice").innerText = orderPrice;
        const url = "./assets/subphp/orderDetail.php";
        const data = {
            orderID: orderID
        };
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(responseData => {
                if (responseData.status === 'success') {
                    const orderLine = responseData.orderLine;

                    if ($.fn.dataTable.isDataTable('#DataTableForOrderDetail')) {
                        // Destroy the existing DataTable
                        $('#DataTableForOrderDetail').DataTable().destroy();
                    }
                    // Initialize DataTable
                    new DataTable('#DataTableForOrderDetail', {
                        columns: [{
                                title: '#'
                            },
                            {
                                title: 'Spare Part number',
                                className: 'text-center'
                            },
                            {
                                title: 'Spare Part Name',
                                className: 'text-center'
                            },
                            {
                                title: 'Quantity',
                                className: 'text-center'
                            },
                            {
                                title: 'Price',
                                className: 'text-center'
                            }
                        ],
                        data: orderLine
                    });
                } else {
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }


    function printTheOrderDetail() {
        var printContents = document.getElementById('Modal-Detail').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();

    }

    function cancelOrder(orderID, orderStatus) {
        cancelWay = 0; //0 for cancel, 1 for request cancel
        if (orderStatus == 5) {
            alert("This order has been canceled");
            return;
        } else if (orderStatus == 4) {
            alert("This order has been requested to cancel, please wait for approval");
            return;
        } else if (orderStatus == 3) {
            alert("This order has been devlivered, you can't cancel it");
            return;
        } else if (orderStatus == 2 && confirm("Are you sure you want to cancel this order? Need to wait for approval")) {
            cancelWay = 1;
        } else if (orderStatus == 1 && confirm("Are you sure you want to cancel this order?")) {
            cancelWay = 0;
        }
        const url = "./assets/subphp/cancelOrder.php";
        const data = {
            orderID: orderID,
            cancelWay: cancelWay
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
                    cancelButton = document.getElementById("cancelButton" + orderID);
                    cancelButton.innerText = "Wait For approval";
                    cancelButton.disabled = true;
                    (cancelWay == 0) ? alert("Order has been canceled"): alert("Please wait for approval ");
                } else {
                    console.error('Error:', responseData.message);
                }
            }).catch(error => {
                console.error('Fetch error:', error);
            });

        window.location.reload();
    }
</script>

</html>