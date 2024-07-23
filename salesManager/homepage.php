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

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="../assets/img/catHead.jpg" type="image/x-icon" />

  <link rel="stylesheet" href="./assets/css/style-prefix.css" />

  <!--
    - custom css link
  -->
  <link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/date-1.5.2/datatables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="./assets/css/style-prefix.css" />
  <link rel="stylesheet" href="./assets/css/style-information.css" />
  <link rel="stylesheet" href="./assets/css/home_add.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

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
  <header>
  </header>

  <!--
    - MAIN
  -->

  <main>
    <!--
      - PRODUCT
    -->


    <div class="container">
      <div class="row">
        <div class="col-12 m-4">
          <h1 class="text-center">Welcome to the Sales Manager Homepage</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12 m-2">
          <div class="cards">
            <div class="card red m-4">
              <p class="tip">Total Order</p>
              <p class="second-text" id="totalOrderNumber">-1</p>
            </div>
            <div class="card blue m-4">
              <p class="tip">Total selled Spare Part</p>
              <p class="second-text" id="totalOrderPrice">$-1</p>
            </div>
            <div class="card green m-4">
              <p class="tip">Today selled Spare Part</p>
              <p class="second-text" id="orderPriceCountToday">$-1</p>
            </div>
          </div>
        </div>
        <div class="col-12 p-5 justify-content-center d-flex">
          <div class="row">
            <div class="chart__container">
              <canvas id="chart" width="1000" height="400"></canvas>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="accordion justify-content-center " id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                  Assigned Order:
                </button>
              </h2>
              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
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
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                  Spare Part:
                </button>
              </h2>
              <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                  <table class="table table-striped table-hover" OrderItemList id="sparePartDataTable">
                    <thead>
                      <tr>
                        <th>Img</th>
                        <th>sparePart Number</th>
                        <th>sparePart Name</th>
                        <th>stock Item Qty</th>
                        <th>weight</th>
                        <th>price</th>
                        <th>discountPrice</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
                <div class="form-group row margin-bottom10" id="approveInput">
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
                <h5>Total Order Amount: $<span id="Detail-totalPrice">0</span></h5>
              </form>
            </div>
            <div class="modal-footer no-print">
              <button type="button" class="btn btn-success" onclick="printTheOrderDetail()">Print the Order</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>


  </main>
  <footer>
  </footer>
  <!--- custom js link-->
  <script src="./assets/js/script.js"></script>
  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-2.1.0/date-1.5.2/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    orderCountChart();

    function orderCountChart() {
      fetch("./assets/subphp/OrderChartData.php", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({})
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

            let ctx = document.getElementById("chart").getContext('2d');

            var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke.addColorStop(0, "#ff6c00");
            gradientStroke.addColorStop(1, "#ff3b74");

            var gradientBkgrd = ctx.createLinearGradient(0, 100, 0, 400);
            gradientBkgrd.addColorStop(0, "rgba(244,94,132,0.2)");
            gradientBkgrd.addColorStop(1, "rgba(249,135,94,0)");

            let draw = Chart.controllers.line.prototype.draw;
            Chart.controllers.line = Chart.controllers.line.extend({
              draw: function() {
                draw.apply(this, arguments);
                let ctx = this.chart.chart.ctx;
                let _stroke = ctx.stroke;
                ctx.stroke = function() {
                  ctx.save();
                  //ctx.shadowColor = 'rgba(244,94,132,0.8)';
                  ctx.shadowBlur = 8;
                  ctx.shadowOffsetX = 0;
                  ctx.shadowOffsetY = 6;
                  _stroke.apply(this, arguments)
                  ctx.restore();
                }
              }
            });




            var chart = new Chart(ctx, {
              // The type of chart we want to create
              type: 'line',

              // The data for our dataset
              data: {
                labels: orderData[0],
                datasets: [{
                  label: "Order Count",
                  backgroundColor: gradientBkgrd,
                  borderColor: gradientStroke,
                  data: orderData[1],
                  pointBorderColor: "rgba(255,255,255,0)",
                  pointBackgroundColor: "rgba(255,255,255,0)",
                  pointBorderWidth: 0,
                  pointHoverRadius: 8,
                  pointHoverBackgroundColor: gradientStroke,
                  pointHoverBorderColor: "rgba(220,220,220,1)",
                  pointHoverBorderWidth: 4,
                  pointRadius: 1,
                  borderWidth: 5,
                  pointHitRadius: 16,
                }]
              },

              // Configuration options go here
              options: {
                tooltips: {
                  backgroundColor: '#fff',
                  displayColors: false,
                  titleFontColor: '#000',
                  bodyFontColor: '#000'

                },
                legend: {
                  display: false
                },
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      // Include a dollar sign in the ticks
                      callback: function(value, index, values) {
                        return value;
                      }
                    }
                  }]
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
    };

    getOrderCardData();

    function getOrderCardData() {
      fetch("./assets/subphp/getOrderCardData.php", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({})
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
            document.getElementById("totalOrderNumber").innerText = orderData.orderCount;
            document.getElementById("totalOrderPrice").innerText = "$"+orderData.orderPriceCount.toFixed(2);
            document.getElementById("orderPriceCountToday").innerText = "$"+orderData.orderPriceCountToday.toFixed(2);
          } else {
            console.error('Error:', responseData.message);
          }
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    }


    function ProductDetail(sparePartNum) {
      window.location.href = ("./product_Detail?sparePartNum=" + sparePartNum);
    }

    function refreshOrderView() {
      const url = "./assets/subphp/orderViewDataRefreshForAssignedOrder.php";
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

    function sparePartDataTable() {
      const url = "./assets/subphp/sparePartDataTable.php";
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

            if ($.fn.dataTable.isDataTable('#sparePartDataTable')) {
              // Destroy the existing DataTable
              $('#sparePartDataTable').DataTable().destroy();
            }

            // Initialize DataTable
            $('#sparePartDataTable').DataTable({
              columns: [{
                  title: 'Img',
                  className: 'text-center'
                },
                {
                  title: 'sparePartNum',
                  className: 'text-center'
                },
                {
                  title: 'sparePartName',
                  className: 'text-center'
                },
                {
                  title: 'stockItemQty',
                  className: 'text-center'
                },
                {
                  title: 'weight',
                  className: 'text-center'
                },
                {
                  title: 'price',
                  className: 'text-center'
                },
                {
                  title: 'discountPrice',
                  className: 'text-center'
                }
              ],
              data: orderData,
              order: [
                [2, "desc"]
              ],
              columnDefs: [{
                "targets": 0, // The index of the column containing the image paths
                "render": function(data, type, row, meta) {
                  return '<img src="' + data + '" alt="Image" style="width:50px;height:auto;"/>';
                }
              }]
            });


          } else {
            console.error('Error:', responseData.message);
          }
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    }
    sparePartDataTable();

    function uploadOrderDetail(orderID, orderDateTime, orderStatus, managerName, managerContact, deliveryAddress, deliveryDate, orderPrice) {
      document.getElementById("OrderDetail-OrderID").placeholder = orderID.toString().padStart(6, '0');
      if (orderStatus == 1) {
        document.getElementById('approveInput').style.display = 'inline';
      } else {
        document.getElementById('approveInput').style.display = 'none';
      }

      document.getElementById("OrderDetail-orderDateTime").placeholder = orderDateTime;
      document.getElementById("OrderDetail-SalesManagerName").placeholder = managerName;
      document.getElementById("OrderDetail-SalesManagerContact").placeholder = managerContact;
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
          } else {
            console.error('Error:', responseData.message);
          }
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    }
  </script>
  <script>
    $(function() {
      $("header").load("./assets/subphp/header.php");
      $("footer").load("./assets/subphp/footer.php");
    });
  </script>
</body>

</html>
<?php
$conn->close();
?>