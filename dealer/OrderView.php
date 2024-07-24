<?php
require_once('../db/connect.php');
session_start();
?>

<?php
// Check if the 'dealer' session variable is not set
if (!isset($_SESSION['dealer'])) {
    // If not set, redirect to the index page
    header("Location: ../index.php");
    exit();
}

// If the 'dealer' session variable is set
if (isset($_SESSION['dealer'])) {
    // Retrieve the dealer email from the session
    $dealer = $_SESSION['dealer'];

    // Prepare a SQL statement to select the dealerID based on the dealer email
    $stmt = $conn->prepare("SELECT dealerID FROM dealer WHERE dealerEmail = ?");
    // Bind the dealer email parameter to the SQL statement
    $stmt->bind_param("s", $dealer);
    // Execute the SQL statement
    $stmt->execute();
    // Get the result set from the executed statement
    $result = $stmt->get_result();
    // Initialize dealerID to an empty string
    $dealerID = "";
    // If there are rows in the result set
    if ($result->num_rows > 0) {
        // Fetch the first row from the result set as an associative array
        $row = $result->fetch_assoc();
        // Retrieve the dealerID from the row
        $dealerID = $row['dealerID'];
    }
    // Close the statement
    $stmt->close();
}

// Check if 'startDateTime' and 'endDateTime' are set in the GET request
if (isset($_GET['startDateTime']) && isset($_GET['endDateTime'])) {
    // Retrieve the start and end date-time values from the GET request
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
    <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/date-1.5.2/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./assets/css/style-prefix.css" />
    <link rel="stylesheet" href="./assets/css/style-information.css" />
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
    <header>
    </header>
    <main>
        <div class="productDetail-container">
            <div class="container" style=" margin-bottom: 30vh; width: 2000px;">
                <h3>All Order:</h3>
                <table class="table table-striped table-hover" OrderItemList id="OrderViewTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date & Time</th>
                            <th>Order Status</th>
                            <th>Delivery Date</th>
                            <th>Detail</th>
                            <th>Cancel Order</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                <span>Start Date:</span><br>
                                <span>End Date:</span>
                            </th>
                            <th>
                                <input type="text" id="minDate" placeholder="From Date">
                                <input type="text" id="maxDate" placeholder="To Date">
                            </th>
                            <th><span>Order Status:</span>
                                <select id="statusFilter">
                                    <option value="">All</option>
                                </select>
                            </th>
                            <th><button type="button" class="btn btn-primary" onclick="clearFilter()">Clear</button></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
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
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="OrderDetail-OrderID" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputOrderDate" class="col-sm-3 col-form-label">Order
                                            Date & Time:</label>
                                        <div class="col-sm-7">
                                            <input type="datetime" class="form-control" id="OrderDetail-orderDateTime" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Delivery Address:</label>
                                        <div class="col-sm-7">
                                            <input type="datetime" class="form-control" id="OrderDetail-deliveryAddress" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Delivery Date:</label>
                                        <div class="col-sm-7">
                                            <input type="datetime" class="form-control" id="OrderDetail-deliveryDate" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10">
                                        <label for="inputDeliveryAddress" class="col-sm-3 col-form-label">Sales Manager:</label>
                                        <div class="col-sm-7">
                                            <div class="input-group ">
                                                <span class="input-group-text">id</span>
                                                <input type="text" aria-label="SalesManagerName" class="form-control" id="OrderDetail-SalesManagerId" placeholder="" disabled>
                                                <span class="input-group-text">Name</span>
                                                <input type="text" aria-label="SalesManagerName" class="form-control" id="OrderDetail-SalesManagerName" placeholder="" disabled>
                                                <span class="input-group-text">Contact</span>
                                                <input type="text" aria-label="SalesManagerContact" class="form-control" id="OrderDetail-SalesManagerContact" placeholder="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 style="margin-top: 50px; margin-bottom: 20px;">Order item:</h5>
                                    <table class="table display" id="DataTableForOrderDetail">
                                    </table>
                                    <h5>Total Order Amount: $<span id="Detail-totalPrice">0</span></h5>
                                </form>
                            </div>
                            <div class="modal-footer no-print">
                                <button type="button" class="btn btn-success" onclick="printTheOrderDetail()">Print the Order</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
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
</body>
<script src="./assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.0/date-1.5.2/datatables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("header").load("./assets/subphp/header.php");
        $("footer").load("./assets/subphp/footer.php");
    });
</script>



<script>
    function refreshOrderView() {
        // Define the URL for the data refresh endpoint
        const url = "./assets/subphp/orderViewDataRefresh.php";
        // Initialize an empty data object
        const data = {};

        // Make a POST request to the specified URL with JSON data
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                // Check if the response is not ok (status code not in the range 200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                // Parse the response as JSON
                return response.json();
            })
            .then(responseData => {
                // Check if the response status is 'success'
                if (responseData.status === 'success') {
                    // Extract order data from the response
                    const orderData = responseData.data;
                    let table; // DataTable instance

                    // Check if the DataTable is already initialized
                    if ($.fn.dataTable.isDataTable('#OrderViewTable')) {
                        // Destroy the existing DataTable
                        $('#OrderViewTable').DataTable().destroy();
                    }

                    // Initialize the DataTable with the new data
                    table = $('#OrderViewTable').DataTable({
                        columns: [{
                                title: 'Order ID',
                                className: 'text-center'
                            },
                            {
                                title: 'Order Date & Time',
                                className: 'text-center'
                            },
                            {
                                title: 'Order Status',
                                className: 'text-center'
                            },
                            {
                                title: 'Delivery Date & Time',
                                className: 'text-center'
                            },
                            {
                                title: 'Detail',
                                className: 'text-center'
                            },
                            {
                                title: 'Cancel Order',
                                className: 'text-center'
                            }
                        ],
                        data: orderData,
                        createdRow: function(row, data, dataIndex) {
                            // Apply custom classes to the status cell based on its value
                            var statusCell = $('td', row).eq(2);
                            if (data[2] === 'Wait for approval' || data[2] === 'Wait for delivery') {
                                statusCell.addClass('ColorYellow');
                            } else if (data[2] === 'Delivered') {
                                statusCell.addClass('ColorGreen');
                            } else if (data[2] === 'Request Cancel') {
                                statusCell.addClass('ColorLightRed');
                            } else if (data[2] === 'Cancelled' || data[2] === 'Rejected') {
                                statusCell.addClass('ColorRed');
                            }
                        },
                        order: [
                            [0, "desc"]
                        ]
                    });

                    // Initialize date pickers for date range filter
                    $("#minDate").datepicker({
                        dateFormat: 'yy-mm-dd'
                    });
                    $("#maxDate").datepicker({
                        dateFormat: 'yy-mm-dd'
                    });

                    // Add event listener for date range filter
                    $('#minDate, #maxDate').change(function() {
                        table.draw();
                    });

                    // Custom filtering function for date range
                    $.fn.dataTable.ext.search.push(
                        function(settings, data, dataIndex) {
                            var min = $('#minDate').val();
                            var max = $('#maxDate').val();
                            var date = new Date(data[1]);

                            if (
                                (min === "" || new Date(min) <= date) &&
                                (max === "" || new Date(max) >= date)
                            ) {
                                return true;
                            }
                            return false;
                        }
                    );

                    // Populate the status filter dropdown with unique statuses
                    const statusFilter = $('#statusFilter');
                    const uniqueStatuses = [...new Set(orderData.map(item => item[2]))];
                    statusFilter.empty();
                    statusFilter.append(new Option("", ""));
                    uniqueStatuses.forEach(status => {
                        statusFilter.append(new Option(status, status));
                    });

                    // Add event listener for status filter
                    statusFilter.on('change', function() {
                        const selectedStatus = $(this).val();
                        table.column(2).search(selectedStatus).draw();
                    });

                    // Define a function to clear all filters
                    window.clearFilter = function() {
                        $('#minDate').val('');
                        $('#maxDate').val('');
                        $('#statusFilter').val('');
                        table.search('').columns().search('').draw();
                    };
                } else {
                    // Log an error message if the response status is not 'success'
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                // Log any fetch errors
                console.error('Fetch error:', error);
            });
    }
    refreshOrderView();



    function uploadOrderDetail(orderID, orderDateTime, managerId, managerName, managerContact, deliveryAddress, deliveryDate, orderPrice) {
        // Set placeholders for the order details in the HTML elements
        document.getElementById("OrderDetail-OrderID").placeholder = orderID.toString().padStart(6, '0');
        document.getElementById("OrderDetail-orderDateTime").placeholder = orderDateTime;
        document.getElementById("OrderDetail-SalesManagerId").placeholder = managerId;
        document.getElementById("OrderDetail-SalesManagerName").placeholder = managerName;
        document.getElementById("OrderDetail-SalesManagerContact").placeholder = managerContact;
        document.getElementById("OrderDetail-deliveryAddress").placeholder = deliveryAddress;
        document.getElementById("OrderDetail-deliveryDate").placeholder = deliveryDate;
        document.getElementById("Detail-totalPrice").innerText = orderPrice;

        // Define the URL for the order detail endpoint
        const url = "./assets/subphp/orderDetail.php";
        // Create a data object with the order ID
        const data = {
            orderID: orderID
        };

        // Make a POST request to the specified URL with JSON data
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                // Check if the response is not ok (status code not in the range 200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                // Parse the response as JSON
                return response.json();
            })
            .then(responseData => {
                // Check if the response status is 'success'
                if (responseData.status === 'success') {
                    // Extract order line data from the response
                    const orderLine = responseData.orderLine;

                    // Check if the DataTable is already initialized
                    if ($.fn.dataTable.isDataTable('#DataTableForOrderDetail')) {
                        // Destroy the existing DataTable
                        $('#DataTableForOrderDetail').DataTable().destroy();
                    }

                    // If there are no order lines, initialize a DataTable for the order view
                    if (orderLine.length === 0) {
                        // Initialize DataTable
                        table = $('#OrderViewTable').DataTable({
                            columns: [{
                                    title: 'Order ID',
                                    className: 'text-center'
                                },
                                {
                                    title: 'Dealer ID',
                                    className: 'text-center'
                                },
                                {
                                    title: 'Order Date & Time',
                                    className: 'text-center'
                                },
                                {
                                    title: 'Order Status',
                                    className: 'text-center'
                                },
                                {
                                    title: 'Delivery Date & Time',
                                    className: 'text-center'
                                },
                                {
                                    title: 'Detail',
                                    className: 'text-center'
                                }
                            ],
                            data: orderLine
                        });
                        return;
                    }

                    // Initialize a new DataTable for the order details
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
                                title: 'Img',
                                className: 'text-center'
                            },
                            {
                                title: 'Quantity',
                                className: 'text-center'
                            },
                            {
                                title: 'Price(USD)',
                                className: 'text-center'
                            }
                        ],
                        data: orderLine,
                        columnDefs: [{
                            "targets": 3, // The index of the column containing the image paths
                            "render": function(data, type, row, meta) {
                                return '<img src="' + data + '" alt="Image" style="width:50px;height:auto;"/>';
                            }
                        }]
                    });
                } else {
                    // Log an error message if the response status is not 'success'
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                // Log any fetch errors
                console.error('Fetch error:', error);
            });
    }


    function printTheOrderDetail() {
        // Get the HTML content of the element with ID 'Modal-Detail'
        var printContents = document.getElementById('Modal-Detail').innerHTML;

        // Store the original HTML content of the entire document body
        var originalContents = document.body.innerHTML;

        // Replace the document body's HTML with the content to be printed
        document.body.innerHTML = printContents;

        // Trigger the print dialog
        window.print();

        // Restore the original HTML content of the document body
        document.body.innerHTML = originalContents;

        // Reload the page to ensure everything is back to its original state
        window.location.reload();
    }

    function cancelOrder(orderID, orderStatus) {
    // Get the current date and time
    let datetime = new Date();
    
    // Retrieve the delivery date from the placeholder of the element with ID 'OrderDetail-deliveryDate'
    let deliveryDateStr = document.getElementById("OrderDetail-deliveryDate").placeholder;

    // Parse the delivery date string into a Date object
    let deliveryDate = new Date(deliveryDateStr);

    // Add 2 days (172800000 milliseconds) to the current date
    let twoDaysLater = new Date(datetime.getTime() + 172800000);

    // Initialize cancelWay to 0 (0 for cancel, 1 for request cancel)
    let cancelWay = 0;

    // Check the order status and handle accordingly
    if (orderStatus == 5) {
        alert("This order has been canceled");
        return;
    } else if (orderStatus == 4) {
        alert("This order has been requested to cancel, please wait for approval");
        return;
    } else if (orderStatus == 3) {
        alert("This order has been delivered, you can't cancel it");
        return;
    } else if (orderStatus == 2 && deliveryDate > twoDaysLater) {
        alert("This order has been over the cancel time, you can't cancel it");
        return;
    } else if (orderStatus == 2 && confirm("Are you sure you want to cancel this order? Need to wait for approval")) {
        cancelWay = 1;
    } else if (orderStatus == 1 && confirm("Are you sure you want to cancel this order?")) {
        cancelWay = 0;
    } else {
        return;
    }

    // Define the URL for the cancel order request
    const url = "./assets/subphp/cancelOrder.php";

    // Create the data object to be sent in the request
    const data = {
        orderID: orderID,
        cancelWay: cancelWay
    };

    // Make a POST request to the server to cancel the order
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
                // Notify the user based on the cancel way
                (cancelWay == 0) ? alert("Order has been canceled"): alert("Please wait for approval ");
                // Refresh the order view
                refreshOrderView();
            } else {
                console.error('Error:', responseData.message);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}
</script>

</html>