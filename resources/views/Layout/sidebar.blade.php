<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #265149">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fw fa-tachometer-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GREENBOOK<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a  class="nav-link" href="{{ route('home') }}">
            <i class="fa-solid fa-chart-simple"></i>
            <span>Thống kê</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý sản phẩm
    </div>
    <!-- Nav Item Product -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa fa-book"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('product.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('product.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa fa-bookmark"></i>
            <span>Danh mục</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('category.index') }}">Danh
                    sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('category.create') }}">Thêm
                    mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
            aria-expanded="true" aria-controls="collapseEight">
            <i class="fa-solid fa-warehouse"></i>
            <span>Kho hàng</span>
        </a>
        <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('warehouse.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('warehouse.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine"
            aria-expanded="true" aria-controls="collapseNine">
            <i class="fa-solid fa-truck-field"></i>
            <span>Nhà cung cấp</span>
        </a>
        <div id="collapseNine" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('suppliers.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('suppliers.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen"
            aria-expanded="true" aria-controls="collapseTen">
            <i class="fa-solid fa-file-import"></i>
            <span>Dữ liệu nhập</span>
        </a>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('product-movement.index') }}">Danh
                    sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('product-movement.create') }}">Thêm
                    mới</a>
            </div>
        </div>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseElevent"
            aria-expanded="true" aria-controls="collapseElevent">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Sự kiện</span>
        </a>
        <div id="collapseElevent" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('product.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('product.create') }}">Thêm mới</a>
            </div>
        </div>
    </li> --}}
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý BLOG
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-newspaper-o"></i>
            <span>Bài đăng</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item" href="{{ route('post.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item" href="{{ route('post.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#six" aria-expanded="true"
            aria-controls="six">
            <i class="fas fa-fw fa-newspaper-o"></i>
            <span>Danh mục bài đăng</span>
        </a>
        <div id="six" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item" href="{{ route('category-post.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item" href="{{ route('category-post.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Quản lý người dùng
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa fa-users"></i>
            <span>Người dùng</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('user.index') }}">Danh
                    sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('user.create') }}">Thêm
                    mới</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#seven"
            aria-expanded="true" aria-controls="seven">
            <i class="fas fa-fw fa-barcode"></i>
            <span>Quản lý mã giảm giá</span>
        </a>
        <div id="seven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('coupon.index') }}">Danh
                    sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('coupon.create') }}">Thêm
                    mới</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý đơn hàng
    </div>

    <!-- Nav Item Product -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa fa-archive"></i>
            <span>Đơn hàng</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item" href="{{ route('order.index') }}">Danh sách</a>
                <a class="collapse-item" href="cards.html">Thêm mới</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#eight"
            aria-expanded="true" aria-controls="eight">
            <i class="fa-solid fa-gear"></i>
            <span>Cài đặt Website</span>
        </a>
        <div id="eight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item spa_route" href="{{ route('setting.index') }}">Danh sách</a>
                <a wire:navigate class="collapse-item spa_route" href="{{ route('setting.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- Sidebar Message -->
</ul>
