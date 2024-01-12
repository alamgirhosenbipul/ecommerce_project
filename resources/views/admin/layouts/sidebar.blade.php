<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> Arzena Fashion</a></div>
<div class="sl-sideleft">

  <div class="sl-sideleft-menu">
    <a href="{{ url('/') }}" class="sl-menu-link" target="_blank">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Visit Site</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <a href="{{ route('admin.home') }}" class="sl-menu-link">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

    <a href="#" class="sl-menu-link @yield('category')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
        <span class="menu-item-label">Categories</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{ route('category') }}" class="nav-link @yield('add-category')">Add Category</a></li>
      <li class="nav-item"><a href="{{ route('sub-category') }}" class="nav-link @yield('sub-category')">Add Subcategory</a></li>
      <li class="nav-item"><a href="{{ route('sub-sub-category') }}" class="nav-link @yield('sub-sub-category')">Add Sub-Sub-Category</a></li>

    </ul>
    <a href="#" class="sl-menu-link @yield('products')">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
        <span class="menu-item-label">Products</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{ route('add.products') }}" class="nav-link">Add products</a></li>
      <li class="nav-item"><a href="{{ route('manage.products') }}" class="nav-link @yield('manage-products')">Manage Products</a></li>
    </ul>
    <a href="{{ route('slider') }}" class="sl-menu-link @yield('slider')">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
        <span class="menu-item-label">Slider</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

  </div><!-- sl-sideleft-menu -->

  <br>
</div><!-- sl-sideleft -->