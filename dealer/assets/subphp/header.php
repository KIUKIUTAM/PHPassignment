<?php
require_once('../../../db/connet.php');
session_start();
?>
<style>
#loginOut:hover {
    color: #b23b3b;

}
</style>

<span>Dealer Email: <?php if(isset($_SESSION['dealer'])){echo$_SESSION['dealer'];}?></span>
<div class="header-main">
    <div class="container">
        <a href="./homepage.php" class="menu-title"><img src="../assets/img/catHead.jpg" width="70"
                class="showcase-img" />
            <h4 style="font-size: 1.4em;">SLMS</h4>
        </a>

        <div class="header-search-container">
            <input type="search" name="search" class="search-field" placeholder="Enter your product name..." />

            <button class="search-btn" onclick="search()">
                <ion-icon name="search-outline"></ion-icon>
            </button>
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
                <a href="./shoppingCart.php">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                </a>
                <span class="count" id="shoppingCartCount1">0</span>
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
                <a href="#" class="menu-title">Categories</a>

                <div class="dropdown-panel">
                    <ul class="dropdown-panel-list">
                        <li class="menu-title">
                            <a href="#">Sheet Metal</a>
                        </li>

                        <li class="panel-list-item">
                            <a href="./listOfProduct?Category=Sheet_Metal">All</a>
                        </li>
                    </ul>

                    <ul class="dropdown-panel-list">
                        <li class="menu-title">
                            <a href="#">Major Asssemblies</a>
                        </li>

                        <li class="panel-list-item">
                            <a href="./listOfProduct?Category=Major_Assemblies">All</a>
                        </li>
                    </ul>

                    <ul class="dropdown-panel-list">
                        <li class="menu-title">
                            <a href="#">Light Components</a>
                        </li>

                        <li class="panel-list-item">
                            <a href="./listOfProduct?Category=Light_Components">All</a>
                        </li>
                    </ul>

                    <ul class="dropdown-panel-list">
                        <li class="menu-title">
                            <a href="#">Accessories</a>
                        </li>
                        <li class="panel-list-item">
                            <a href="./listOfProduct?Category=Accessories">All</a>
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
    <button class="action-btn" onclick="location.href='./shoppingCart.php'">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <span class="count" id="shoppingCartCount2">0</span>
    </button>



    <button class="action-btn" data-mobile-menu-open-btn onclick="loginOut()" id="loginOut">
        <ion-icon name="log-in-outline"></ion-icon>
    </button>
</div>
<script>
function search() {
    var search = document.querySelector('.search-field').value;
    if (search == '') {
        alert('Please enter a product name');
    } else {
        location.href = './search.php?search=' + search;
    }
};

function fetchCartCount() {
    fetch("./assets/subphp/cart_count.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.cart_count !== undefined) {
                document.getElementById("shoppingCartCount1").innerText = responseData.cart_count;
                document.getElementById("shoppingCartCount2").innerText = responseData.cart_count;
            } else {
                console.error('Error:', responseData.message);
            }
        })
        .catch(error => console.error('Fetch error:', error));
}

fetchCartCount();

function loginOut() {
    fetch('./assets/subphp/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.replace('../index.php');
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>