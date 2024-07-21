<!DOCTYPE html>
<php lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>SLMS - Orders</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/SLMS_Logo.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="dashboard.php" class="logo">
                    <img src="assets/img/SLMS_Logo.png" alt="">
                </a>
                <a href="dashboard.php" class="logo-small">
                    <img src="assets/img/SLMS_Logo.png" alt="">
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
                        <li>
                            <a href="dashboard.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                    Dashboard</span> </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                                    Spare Parts</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="partsList.php">Spare Parts List</a></li>
                                <li><a href="addPart.php">Add Spare Part</a></li>
                            </ul>
                        </li>
                        <li  class="active">
                            <a href="orderList.php"><img src="assets/img/icons/sales1.svg" alt="img"><span> Orders</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Orders List</h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>Order ID</th>
                                        <th>Sales Manager ID</th>
                                        <th>Date Ordered</th>
                                        <th>Shipping Cost</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>20240525-0001</td>
                                        <td class="text-red">Unassigned</td>
                                        <td>25 May 2024</td>
                                        <td>$199.99</td>
                                        <td>$4999.99</td>
                                        <td>
                                            <select>
                                                <option>Select Status</option>
                                                <option>Accepted</option>
                                                <option>Rejected</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye1.svg" class="me-2" alt="img">Order
                                                        Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/plus-circle.svg" class="me-2"
                                                            alt="img">Assign Sales Manager</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>20240525-0002</td>
                                        <td class="text-red">Unassigned</td>
                                        <td>25 May 2024</td>
                                        <td>$199.99</td>
                                        <td>$4999.99</td>
                                        <td>
                                            <select>
                                                <option>Select Status</option>
                                                <option>Accepted</option>
                                                <option>Rejected</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye1.svg" class="me-2" alt="img">Order
                                                        Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/plus-circle.svg" class="me-2"
                                                            alt="img">Assign Sales Manager</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>20240525-0003</td>
                                        <td class="text-red">Unassigned</td>
                                        <td>25 May 2024</td>
                                        <td>$199.99</td>
                                        <td>$4999.99</td>
                                        <td>
                                            <select>
                                                <option>Select Status</option>
                                                <option>Accepted</option>
                                                <option>Rejected</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye1.svg" class="me-2" alt="img">Order
                                                        Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/plus-circle.svg" class="me-2"
                                                            alt="img">Assign Sales Manager</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>20240525-0004</td>
                                        <td class="text-red">Unassigned</td>
                                        <td>25 May 2024</td>
                                        <td>$199.99</td>
                                        <td>$4999.99</td>
                                        <td>
                                            <select>
                                                <option>Select Status</option>
                                                <option>Accepted</option>
                                                <option>Rejected</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye1.svg" class="me-2" alt="img">
                                                            Order Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/plus-circle.svg" class="me-2"
                                                            alt="img">Assign Sales Manager</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</php>