<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">DAPOPO</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    
    <ul class="metismenu" id="menu">
        <li class="menu-label">Navigation</li>
        
        <li>
            <a href="{{ route('dashboard.index') }}" class="no-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if (Auth::user()->role == 'user')
        <li class="menu-label">Data Submission</li>
        <li>
            <a href="{{ route ('rectifier.index') }}">
                <div class="parent-icon"><i class='bx bx-bar-chart-alt-2'></i>
                </div>
                <div class="menu-title">Power Potentian</div>
            </a>
            <li>
                <a href="{{ route ('genset.index') }}">
                    <div class="parent-icon"><i class='bx bx-plug'></i>
                    </div>
                    <div class="menu-title">Data Genset</div>
                </a>
            </li>
            <li>
                <a href="{{ route ('kwh.index') }}">
                    <div class="parent-icon"><i class='bx bx-power-off'></i>
                    </div>
                    <div class="menu-title">Data KWh Meter</div>
                </a>

            </li>
        </li>
        @else
        <li>
            <a href="{{ route ('logactivity.index') }}">
                <div class="parent-icon"><i class='bx bx-list-check'></i>
                </div>
                <div class="menu-title">Log Activity</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route ('user.index') }}"><i class="bx bx-right-arrow-alt"></i>Data User</a>
                </li>
                <li> <a href="{{ route ('area.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Kabupaten</a>
                </li>
                <li> <a href="{{ route ('site.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Site</a>
                </li>
                <li> <a href="{{ route ('equipment.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Equipment</a>
                </li>
                <li> <a href="{{ route ('battery_brand.index') }}"><i class="bx bx-right-arrow-alt"></i>Battery Brand</a>
                </li>
                <li> <a href="{{ route ('battery_type.index') }}"><i class="bx bx-right-arrow-alt"></i>Battery Type</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Data Submission</li>
        <li>
            <a href="{{ route ('rectifier.index') }}">
                <div class="parent-icon"><i class='bx bx-bar-chart-alt-2'></i>
                </div>
                <div class="menu-title">Power Potential</div>
            </a>
        </li>
        <li>
            <a href="{{ route ('genset.index') }}">
                <div class="parent-icon"><i class='bx bx-plug'></i>
                </div>
                <div class="menu-title">Data Genset</div>
            </a>
        </li>
        <li>
            <a href="{{ route ('kwh.index') }}">
                <div class="parent-icon"><i class='bx bx-power-off'></i>
                </div>
                <div class="menu-title">Data KWh Meter</div>
            </a>

        </li>
        @endif
    </ul>
    <!-- end navigation-->
</div>
