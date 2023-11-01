<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

        {{--  --}}
        <li class="nav-title">TRANG CHỦ ADMIN</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.index') }}"><i
                    class="fa-solid fa-gauge me-2"></i>Bảng điều khiển</a>



        <li class="nav-title">Quản lý ...</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.user.index') }}"><i class="bi bi-bookmark me-2">
            </i>Người dùng</a>
                </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.index') }}"><i
                    class="fa-solid fa-flag me-2"></i>Danh mục</a>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.book.index') }}"><i
                    class="fa-solid fa-book me-2"></i>Sách</a>

        </li>
        {{-- MENU BOTTOM --}}
        {{-- <li class="nav-item mt-auto"><a class="nav-link" href="https://coreui.io/docs/templates/installation/"
                target="_blank">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                </svg> Docs</a></li>
        <li class="nav-item"><a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-layers"></use>
                </svg> Try CoreUI
                <div class="fw-semibold">PRO</div>
            </a></li> --}}
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
