<?php
require_once('../db/connect.php');
session_start();
if (!isset($_SESSION['managerEmail'])) {
    header("Location: ../ManagerLogin.php");
    exit();
}
$managerID = $_SESSION['managerID']
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                <h3>All Order:</h3>
                <table class="table table-striped table-hover" OrderItemList id="OrderViewTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date & Time</th>
                            <th>Order Status</th>
                            <th>Delivery Date</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><span>Dealer ID:</span></th>
                            <th>
                                <input type="number" id="DealerIDSearch" placeholder="Enter dealer ID">
                            </th>
                            <th>
                                <span>Start Date:</span><br>
                                <span>End Date:</span>
                            </th>
                            <th>
                                <input type="text" id="minDate" placeholder="From Date">
                                <input type="text" id="maxDate" placeholder="To Date">
                            </th>
                            <th>
                                <span>Order Status:</span>
                                <select id="statusFilter">
                                    <option value="">All</option>
                                </select>
                            </th>
                            <th><button type="button" class="btn btn-primary" onclick="clearFilter()">Clear</button></th>
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
                                                <span class="input-group-text">Name</span>
                                                <input type="text" aria-label="SalesManagerName" class="form-control" id="OrderDetail-SalesManagerName" placeholder="" disabled>
                                                <span class="input-group-text">Contact</span>
                                                <input type="text" aria-label="SalesManagerContact" class="form-control" id="OrderDetail-SalesManagerContact" placeholder="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row margin-bottom10 no-print" id="approveInput">
                                        <div class="col-sm-6">
                                            <div class="input-group ">
                                                <button type="button" class="btn btn-success no-print" id="ApproveOrder">Approve</button>
                                                <button type="button" class="btn btn-danger no-print" id="RejectOrder">Reject</button>
                                                <select class="form-select" id="ApproveOrderAssign" aria-label="">
                                                    <option selected>Choose...</option>
                                                </select>
                                            </div>
                                            <span id="approveVaildate" class="">Allow to approve</span>
                                        </div>
                                    </div>


                                    <h5 style="margin-top: 50px; margin-bottom: 20px;">Order item:</h5>

                                    <table class="table display" id="DataTableForOrderDetail">

                                    </table>
                                    <h5>Delivery Cost: $<span id="Detail-DeliveryCost">0</span></h5>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("header").load("./assets/subphp/header.php");
        $("footer").load("./assets/subphp/footer.php");
    });
</script>



<script>
    var validatequantity = false;
    var orderIDForClick = 0;
    var cancelWay = 0;


    function AssignManager() {
        // URL to fetch manager data
        const url = "./assets/subphp/assignManager.php";
        // Data to send with the request
        const data = {};

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(responseData => {
                if (responseData.status === 'success') {
                    const managerData = responseData.data;
                    const select = document.getElementById('ApproveOrderAssign');

                    // Clear existing options (if needed)
                    while (select.firstChild) {
                        select.removeChild(select.firstChild);
                    }

                    // Add new options
                    managerData.forEach(manager => {
                        const opt = document.createElement('option');
                        opt.value = manager.salesManagerID;
                        opt.textContent = manager.managerName;
                        select.appendChild(opt);
                    });
                } else {
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }
    AssignManager();


    function refreshOrderView() {
        const url = "./assets/subphp/orderViewDataRefresh.php";
        const data = {};
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

                    const orderData = responseData.data;
                    let table; // DataTable instance

                    if ($.fn.dataTable.isDataTable('#OrderViewTable')) {
                        // Destroy the existing DataTable
                        $('#OrderViewTable').DataTable().destroy();
                    }

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
                        data: orderData,
                        createdRow: function(row, data, dataIndex) {
                            var statusCell = $('td', row).eq(3);
                            if (data[3] === 'Wait for delivery') {
                                statusCell.addClass('ColorYellow');
                            } else if (data[3] === 'Delivered') {
                                statusCell.addClass('ColorGreen');
                            } else if (data[3] === 'Request Cancel') {
                                statusCell.addClass('ColorLightRed');
                            } else if (data[3] === 'Cancelled') {
                                statusCell.addClass('ColorRed');
                            } else if (data[3] === 'Rejected') {
                                statusCell.addClass('ColorRed');
                            }
                        },
                        order: [
                            [0, "desc"]
                        ]
                    });
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
                            var date = new Date(data[2]);

                            if (
                                (min === "" || new Date(min) <= date) &&
                                (max === "" || new Date(max) >= date)
                            ) {
                                return true;
                            }
                            return false;
                        }
                    );
                    // Populate the status filter dropdown
                    const statusFilter = $('#statusFilter');
                    const uniqueStatuses = [...new Set(orderData.map(item => item[3]))];
                    statusFilter.empty();
                    statusFilter.append(new Option("", ""));
                    uniqueStatuses.forEach(status => {
                        statusFilter.append(new Option(status, status));
                    });

                    // Add event listener for status filter
                    statusFilter.on('change', function() {
                        const selectedStatus = $(this).val();
                        table.column(3).search(selectedStatus).draw();
                    });

                    // Add event listener for dealer ID search
                    const dealerIDSearch = $('#DealerIDSearch');
                    dealerIDSearch.on('input', function() {
                        table.column(1).search(this.value).draw();
                    });


                    //clear all filter
                    window.clearFilter = function() {
                        $('#minDate').val('');
                        $('#maxDate').val('');
                        $('#statusFilter').val('');
                        table.search('').columns().search('').draw();
                    };
                } else {
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }
    refreshOrderView();

    function closeModal() {
        var modalElement = document.getElementById('Modal-Detail');
        var modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }
    }

    function handleApproveClick() {
        approveOrder(orderIDForClick, 1);
    }

    function handleRejectClick() {
        approveOrder(orderIDForClick, 2);
    }

    function uploadOrderDetail(orderID, orderDateTime, orderStatus, managerName, managerContact, deliveryAddress, deliveryDate, deliveryCost, orderPrice) {
        document.getElementById("OrderDetail-OrderID").placeholder = orderID.toString().padStart(6, '0');
        if (orderStatus == 1) {
            orderIDForClick = orderID;
            // Ensure the DOM is fully loaded before accessing the element
            let approveButton = document.getElementById('ApproveOrder');
            let rejectButton = document.getElementById('RejectOrder');

            approveButton.removeEventListener('click', handleApproveClick);
            rejectButton.removeEventListener('click', handleRejectClick);
            approveButton.addEventListener('click', handleApproveClick);
            rejectButton.addEventListener('click', handleRejectClick);

            document.getElementById('approveInput').style.display = 'inline';
        } else {
            document.getElementById('approveInput').style.display = 'none';
        }

        document.getElementById("OrderDetail-orderDateTime").placeholder = orderDateTime;
        document.getElementById("OrderDetail-SalesManagerName").placeholder = managerName;
        document.getElementById("OrderDetail-SalesManagerContact").placeholder = managerContact;
        document.getElementById("OrderDetail-deliveryAddress").placeholder = deliveryAddress;
        document.getElementById("OrderDetail-deliveryDate").placeholder = deliveryDate;
        document.getElementById("Detail-DeliveryCost").innerText = deliveryCost;
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
                    orderLine = responseData.orderLine;


                    if ($.fn.dataTable.isDataTable('#DataTableForOrderDetail')) {
                        // Destroy the existing DataTable
                        $('#DataTableForOrderDetail').DataTable().destroy();
                    }
                    if (orderLine.length === 0) {
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
                                    title: 'inventory Quantity',
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
                            data: orderLine
                        });
                        return;
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
                                title: 'inventory Quantity',
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
                        data: orderLine
                    });
                    validatequantity = validateData(orderLine);
                } else {
                    console.error('Error:', responseData.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }

    function validateData(data) {
        for (var i = 0; i < data.length; i++) {
            var inventoryQuantity = data[i][3]; // Assuming the 4th column is Inventory Quantity
            var quantity = data[i][4]; // Assuming the 5th column is Quantity
            if (inventoryQuantity < quantity) {
                document.getElementById('approveVaildate').innerText = "Order can't be approved";
                return false;
            }
        }
        document.getElementById('approveVaildate').innerText = "Order can be approved";
        return true;
    }

    function approveOrder(orderID, approveOrReject) { //1 for approve, 2 for reject
        if (<?php echo isset($_SESSION['headPermission']) ? 'false' : 'true'; ?>) {
            alert("You don't have permission to approve or reject the order");
            return;
        }
        if (!validatequantity) {
            alert("Order can't be approved due to insufficient inventory quantity");
            return;
        }
        if (approveOrReject == 1 && document.getElementById('ApproveOrderAssign').value == "Choose...") {
            alert("Please assign a sales manager to approve the order");
            return;
        }
        const url = "./assets/subphp/approveOrder.php";
        const data = {
            orderID: orderID,
            approveOrReject: approveOrReject,
            orderLine: orderLine,
            salesManagerID: document.getElementById('ApproveOrderAssign').value
        };
        console.log(data);
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === 'success') {
                    if (approveOrReject == 1) {
                        alert("Order has been approved");
                    } else {
                        alert("Order has been rejected");
                    }
                    closeModal();
                    refreshOrderView();
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
</script>

</html>