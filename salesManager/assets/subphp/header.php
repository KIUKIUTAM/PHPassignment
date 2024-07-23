<?php
require_once('../../../db/connect.php');
session_start();
?>
<style>
#loginOut:hover {
    color: #b23b3b;

}
</style>

<span>Manager Email: <?php if(isset($_SESSION['managerEmail'])){echo$_SESSION['managerEmail'];}?></span><br>
<span>Header: <?php if(isset($_SESSION['headPermission'])){echo "header AC";}?></span>
<div class="header-main">
    <div class="container">
        <a href="./homepage.php" class="menu-title"><img src="../assets/img/catHead2.jpg" width="70"
                class="showcase-img" />
            <h4 style="font-size: 1.4em;">SLMS</h4>
        </a>

        <div class="header-search-container">
            <h1>Manager Mode</h1>
        </div>

        <div class="header-user-actions">
            <button class="action-btn">
                <a href="./information.php">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            </button>
            <button class="action-btn">
                <a href="./OrderView.php">
                    <ion-icon name="file-tray-full-outline"></ion-icon>
                </a>
            </button>
            <button class="action-btn">
                <a href="./listOfProduct?Category=ALL">
                <ion-icon name="cube-outline"></ion-icon>
                </a>
            </button>

            <button class="action-btn">
                <a onclick="loginOut()" id="loginOut">
                    <ion-icon name="log-in-outline"></ion-icon>
                </a>
            </button>
        </div>
    </div>
</div>

<nav class="desktop-navigation-menu">
    <div class="container">
        <ul class="desktop-menu-category-list">
            <li class="menu-category">
                <a href="./homepage.php" class="menu-title">Home</a>
            </li>
            <li class="menu-category">
                <a href="#" class="menu-title">workBox</a>
                <div class="dropdown-panel">
                    <ul class="dropdown-panel-list">
                        <li class="menu-title">
                            <a href="#">SparePart</a>
                        </li>
                        <li class="panel-list-item">
                            <a href="./listOfProduct?Category=ALL">Show All</a>
                        </li>
                        <li class="panel-list-item">
                            <a href="#">Add new</a>
                        </li>
                        <li class="panel-list-item">
                            <a href="#">Edit spare</a>
                        </li>
                    </ul>
                    <ul class="dropdown-panel-list">
                        <li class="menu-title">
                            <a href="#">OrderView</a>
                        </li>

                        <li class="panel-list-item">
                            <a href="./OrderView.php">Show All</a>
                        </li>
                        <li class="panel-list-item">
                            <a href="./OrderViewRequestCancel">Request Cancel</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="mobile-bottom-navigation">
    <button class="action-btn" onclick="location.href='./homepage.php'">
        <ion-icon name="home-outline"></ion-icon>
    </button>
    <button class="action-btn">
        <a href="./information.php">
            <ion-icon name="person-outline"></ion-icon>
        </a>
    </button>
    <button class="action-btn">
        <a href="./OrderView.php">
            <ion-icon name="file-tray-full-outline"></ion-icon>
        </a>
    </button>
    <button class="action-btn">
        <a href="./listOfProduct?Category=ALL">
            <ion-icon name="cube-outline"></ion-icon>
        </a>
    </button>
    <button class="action-btn" data-mobile-menu-open-btn onclick="loginOut()" id="loginOut">
        <ion-icon name="log-in-outline"></ion-icon>
    </button>
</div>


<script>

function loginOut() {
    fetch('./assets/subphp/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.replace('../ManagerLogin.php');
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>