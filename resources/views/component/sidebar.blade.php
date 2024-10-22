<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">DAPOPO</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard.index') }}" class="no-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Beranda</div>
            </a>
        </li>
        <li class="menu-label">Data Master</li>
        <li>
            <a href="{{ route ('site.index') }}" class="no-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i></div>
                <div class="menu-title">Site</div>
            </a>
        </li>
        <li>
            <a href="{{ route ('equipment.index') }}" class="no-arrow">
                <div class="parent-icon"><i class='bx bx-station'></i></div>
                <div class="menu-title">Equipment</div>
            </a>
        </li>
        <li class="menu-label">Data Management</li>
        <li>
            <a href="{{ route ('rectifier.index') }}">
                <div class="parent-icon"><i class='bx bx-bar-chart-alt-2'></i>
                </div>
                <div class="menu-title">Power</div>
            </a>
        </li>
    </ul>
    <!-- end navigation-->
</div>
