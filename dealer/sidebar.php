<?php
echo '
<div class="sidebar has-scrollbar" data-mobile-menu>
    <div class="sidebar-category">
      <div class="sidebar-top">
        <h2 class="sidebar-title">Category</h2>

        <button class="sidebar-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="sidebar-menu-category-list">
        <li class="sidebar-menu-category">
          <button class="sidebar-accordion-menu" data-accordion-btn>
            <div class="menu-title-flex">
              <a href="./listOfProduct?Category=Sheet_Metal">
                <p class="menu-title Sheet-Metal">
                  Sheet Metal
                </p>
              </a>
            </div>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon
                name="remove-outline"
                class="remove-icon"
              ></ion-icon>
            </div>
          </button>
        </li>
        <li class="sidebar-menu-category">
          <button class="sidebar-accordion-menu" data-accordion-btn>
            <div class="menu-title-flex">
              <a href="./listOfProduct?Category=Major_Assemblies">
                <p class="menu-title Major-Asssemblies">Major Asssemblies</p></a
              >
            </div>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon
                name="remove-outline"
                class="remove-icon"
              ></ion-icon>
            </div>
          </button>
        </li>
        <li class="sidebar-menu-category">
          <button class="sidebar-accordion-menu" data-accordion-btn>
            <div class="menu-title-flex">
              <a href="./listOfProduct?Category=Light_Components">
                <p class="menu-title Light-Components">Light Components</p></a
              >
            </div>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon
                name="remove-outline"
                class="remove-icon"
              ></ion-icon>
            </div>
          </button>
        </li>
        <li class="sidebar-menu-category">
          <button class="sidebar-accordion-menu" data-accordion-btn>
            <div class="menu-title-flex ">
              <a href="./listOfProduct?Category=Accessories">
                <p class="menu-title Accessories">Accessories</p></a
              >
            </div>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon
                name="remove-outline"
                class="remove-icon"
              ></ion-icon>
            </div>
          </button>
        </li>
      </ul>
    </div>
  </div>
';
?>