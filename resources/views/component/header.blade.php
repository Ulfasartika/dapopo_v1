<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="header-notifications-list">
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="header-message-list">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-user bx-lg"></i>
                    <div class="user-info ps-3">
                        <p class="user-name mb-0"> {{ Str::upper(Auth::user()->name) }} </p>
                        <p class="designattion mb-0"> {{ Str::ucfirst(Auth::user()->role) }} </p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <li>
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="bx bx-log-out-circle"></i>
                                <span>Logout</span>
                            </button>
                        </li>
                    </form>
                </ul>
            </div>
        </nav>
    </div>
</header>
