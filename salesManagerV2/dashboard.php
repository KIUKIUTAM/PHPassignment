<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>SLMS - Admin Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/SLMS_Logo.png">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="dashboard.php" class="logo">
                    <img src="./assets/img/SLMS_Logo.png" alt="">
                </a>
                <a href="dashboard.php" class="logo-small">
                    <img src="./assets/img/SLMS_Logo.png" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <ul class="nav user-menu">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link userset">
                        <span class="user-img"><img src="assets/img/adminIcon.png" alt="">
                    </a>
                </li>
            </ul>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="active">
                            <a href="dashboard.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                    Dashboard</span> </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                                    Spare Parts</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="./partsList.php">Spare Parts List</a></li>
                                <li><a href="./addproduct.php">Add Spare Part</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="orderList.php"><img src="assets/img/icons/sales1.svg" alt="img"><span> Orders</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-0 col-sm-12 col-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Recently Added Parts</h4>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                        class="dropset">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="partsList.php" class="dropdown-item">Spare Parts List</a>
                                        </li>
                                        <li>
                                            <a href="addproduct.php" class="dropdown-item">Add Spare Part</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive dataview">
                                    <table class="table datatable ">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>100005</td>
                                                <td class="productimgname">
                                                    <a href="partsList.php" class="product-img">
                                                        <img src="assets/img/product/100005.jpg" alt="product">
                                                    </a>
                                                    <a href="partsList.php">Sheet Metal 100005</a>
                                                </td>
                                                <td>$891.2</td>
                                                <td>999</td>
                                            </tr>
                                            <tr>
                                                <td>200005</td>
                                                <td class="productimgname">
                                                    <a href="partsList.php" class="product-img">
                                                        <img src="assets/img/product/200005.jpg" alt="product">
                                                    </a>
                                                    <a href="partsList.php">Major Assemblies 200005</a>
                                                </td>
                                                <td>$668.51</td>
                                                <td>999</td>
                                            </tr>
                                            <tr>
                                                <td>300005</td>
                                                <td class="productimgname">
                                                    <a href="partsList.php" class="product-img">
                                                        <img src="assets/img/product/300005.jpg" alt="product">
                                                    </a>
                                                    <a href="partsList.php">Light Components 300005</a>
                                                </td>
                                                <td>$522.29</td>
                                                <td>999</td>
                                            </tr>
                                            <tr>
                                                <td>400005</td>
                                                <td class="productimgname">
                                                    <a href="partsList.php" class="product-img">
                                                        <img src="assets/img/product/400005.jpg" alt="product">
                                                    </a>
                                                    <a href="partsList.php">Accessories 400005</a>
                                                </td>
                                                <td>$291.01</td>
                                                <td>999</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget">
                            <div class="dash-widgetimg">
                                <span><img src="assets/img/icons/dash1.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5>$307,144.00</h5>
                                <h6>Total Purchase Due</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash1">
                            <div class="dash-widgetimg">
                                <span><img src="assets/img/icons/dash2.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5>$4,385.00</h5>
                                <h6>Total Sales Due</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash2">
                            <div class="dash-widgetimg">
                                <span><img src="assets/img/icons/dash3.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5>$385,656.50</h5>
                                <h6>Total Sale Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash3">
                            <div class="dash-widgetimg">
                                <span><img src="assets/img/icons/dash4.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5>$1,000,000.00</h5>
                                <h6>Total Purchase Amount</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Danger Level Parts</h4>
                        <div class="table-responsive dataview">
                            <table class="table datatable ">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Weight</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>100001</td>
                                        <td><a href="javascript:void(0);">Sheet Metal</a></td>
                                        <td class="productimgname">
                                            <a class="product-img" href="partsList.php">
                                                <img src="assets/img/product/100001.jpg" alt="product">
                                            </a>
                                            <a href="partsList.php">Sheet Metal 100001</a>
                                        </td>
                                        <td>2KG</td>
                                        <td>20</td>
                                        <td>$299.99</td>
                                    </tr>
                                    <tr>
                                        <td>200001</td>
                                        <td><a href="javascript:void(0);">Major Assemblies</a></td>
                                        <td class="productimgname">
                                            <a class="product-img" href="partsList.php">
                                                <img src="assets/img/product/200001.jpg" alt="product">
                                            </a>
                                            <a href="partsList.php">Major Assemblies 200001</a>
                                        </td>
                                        <td>1KG</td>
                                        <td>20</td>
                                        <td>$149.99</td>
                                    </tr>
                                    <tr>
                                        <td>300001</td>
                                        <td><a href="javascript:void(0);">Light Components</a></td>
                                        <td class="productimgname">
                                            <a class="product-img" href="partsList.php">
                                                <img src="assets/img/product/300001.jpg" alt="product">
                                            </a>
                                            <a href="partsList.php">Light Components 300001</a>
                                        </td>
                                        <td>150G</td>
                                        <td>99</td>
                                        <td>$89.99</td>
                                    </tr>
                                    <tr>
                                        <td>400001</td>
                                        <td><a href="javascript:void(0);">Accessories</a></td>
                                        <td class="productimgname">
                                            <a class="product-img" href="partsList.php">
                                                <img src="assets/img/product/400001.jpg" alt="product">
                                            </a>
                                            <a href="partsList.php">Accessories 400001</a>
                                        </td>
                                        <td>450G</td>
                                        <td>20</td>
                                        <td>$129.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="assets/js/jquery-3.6.0.min.js"></script>

        <script src="assets/js/feather.min.js"></script>

        <script src="assets/js/jquery.slimscroll.min.js"></script>

        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap4.min.js"></script>

        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
        <script src="assets/plugins/apexchart/chart-data.js"></script>

        <script src="assets/js/script.js"></script>
</body>

</html>