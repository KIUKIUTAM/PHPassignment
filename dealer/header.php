<?php
require_once ('../db/connet.php');

?>
<?php
echo '
<div class="header-main">
  <div class="container">
    <a href="./homepage.php" class="menu-title">SLMS</a>

    <div class="header-search-container">
      <input
        type="search"
        name="search"
        class="search-field"
        placeholder="Enter your product name..."
      />

      <button class="search-btn" onclick="location.href=\'./Search.php\'">
        <ion-icon name="search-outline"></ion-icon>
      </button>
    </div>

    <div class="header-user-actions">
      <button class="action-btn" >
        <a href="./infromation.php"
          ><ion-icon name="person-outline" ></ion-icon
        ></a>
      </button>



      <button class="action-btn">
        <a href="./shoppingCart.php"><ion-icon name="bag-handle-outline"></ion-icon></a>
        <span class="count">2</span>
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
              <a href="./listOfProduct?Category=Sheet_Metal"
                >Sheet Metal-abc</a
              >
            </li>
          </ul>

          <ul class="dropdown-panel-list">
            <li class="menu-title">
              <a href="#">Major Asssemblies</a>
            </li>

            <li class="panel-list-item">
              <a href="./listOfProduct?Category=Major_Assemblies"
                >Major Asssemblies-abc</a
              >
            </li>
          </ul>

          <ul class="dropdown-panel-list">
            <li class="menu-title">
              <a href="#">Light Components</a>
            </li>

            <li class="panel-list-item">
              <a href="./listOfProduct?Category=Light_Components"
                >Light Components-abc</a
              >
            </li>
          </ul>

          <ul class="dropdown-panel-list">
            <li class="menu-title">
              <a href="#">Accessories</a>
            </li>
            <li class="panel-list-item">
              <a href="./listOfProduct?Category=Accessories"
                >Accessories-abc</a
              >
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="mobile-bottom-navigation">
  <button class="action-btn" data-mobile-menu-open-btn>
    <ion-icon name="menu-outline"></ion-icon>
  </button>

  <button class="action-btn" onclick="location.href=\'./shoppingCart.php\'">
    <ion-icon name="bag-handle-outline" ></ion-icon>
    <span class="count">2</span>
  </button>

  <button class="action-btn" onclick="location.href=\'./homepage.php\'">
    <ion-icon name="home-outline"></ion-icon>
  </button>

  <button class="action-btn" data-mobile-menu-open-btn>
    <ion-icon name="grid-outline"></ion-icon>
  </button>
</div>
';
?>