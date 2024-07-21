<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>SLMS - Spare Parts List</title>
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
                                <li><a href="partsList.php" class="active">Spare Parts List</a></li>
                                <li><a href="addPart.php">Add Spare Part</a></li>
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
                <div class="page-header">
                    <div class="page-title">
                        <h4>Spare Parts List</h4>
                    </div>
                    <div class="page-btn">
                        <a href="addPart.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                                class="me-1">Add Spare Part</a>
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
                                        <th>Name</th>
                                        <th>No.</th>
                                        <th>Category</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/100001.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Sheet Metal 100001</a>
                                        </td>
                                        <td>100001</td>
                                        <td>Sheet Metal</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/100002.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Sheet Metal 100002</a>
                                        </td>
                                        <td>100002</td>
                                        <td>Sheet Metal</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/100003.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Sheet Metal 100003</a>
                                        </td>
                                        <td>100003</td>
                                        <td>Sheet Metal</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/100004.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Sheet Metal 100004</a>
                                        </td>
                                        <td>100004</td>
                                        <td>Sheet Metal</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/100005.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Sheet Metal 100005</a>
                                        </td>
                                        <td>100005</td>
                                        <td>Sheet Metal</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/200001.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Major Assemblies 200001</a>
                                        </td>
                                        <td>200001</td>
                                        <td>Major Assemblies</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/200002.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Major Assemblies 200002</a>
                                        </td>
                                        <td>200002</td>
                                        <td>Major Assemblies</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/200003.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Major Assemblies 200003</a>
                                        </td>
                                        <td>200003</td>
                                        <td>Major Assemblies</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/200004.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Major Assemblies 200004</a>
                                        </td>
                                        <td>200004</td>
                                        <td>Major Assemblies</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/200005.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Major Assemblies 200005</a>
                                        </td>
                                        <td>200005</td>
                                        <td>Major Assemblies</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/300001.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Light Components 300001</a>
                                        </td>
                                        <td>300001</td>
                                        <td>Light Components</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/300002.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Light Components 300002</a>
                                        </td>
                                        <td>300002</td>
                                        <td>Light Components</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/300003.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Light Components 300003</a>
                                        </td>
                                        <td>300003</td>
                                        <td>Light Components</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/300004.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Light Components 300004</a>
                                        </td>
                                        <td>300004</td>
                                        <td>Light Components</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/300005.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Light Components 300005</a>
                                        </td>
                                        <td>300005</td>
                                        <td>Light Components</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/400001.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Accessories 400001</a>
                                        </td>
                                        <td>400001</td>
                                        <td>Accessories</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/400002.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Accessories 400002</a>
                                        </td>
                                        <td>400002</td>
                                        <td>Accessories</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/400003.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Accessories 400003</a>
                                        </td>
                                        <td>400003</td>
                                        <td>Accessories</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/400004.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Accessories 400004</a>
                                        </td>
                                        <td>400004</td>
                                        <td>Accessories</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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
                                        <td class="productimgname">
                                            <a href="javascript:void(0);" class="product-img">
                                                <img src="assets/img/product/400005.jpg" alt="product">
                                            </a>
                                            <a href="javascript:void(0);">Accessories 400005</a>
                                        </td>
                                        <td>400005</td>
                                        <td>Accessories</td>
                                        <td>50</td>
                                        <td>$1500.00</td>
                                        <td>100</td>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/eye.svg" class="me-3" alt="img">
                                                            Part Details</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/edit.svg" class="me-3" alt="img">
                                                            Edit Part</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/pdf.svg" class="me-3" alt="img">
                                                            Generate Report</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><img
                                                            src="assets/img/icons/delete.svg" class="me-3" alt="img">
                                                            Delete Part</a>
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


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>