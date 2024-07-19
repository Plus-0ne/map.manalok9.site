<div id="sidebar" class="sidebar">
    <div id="sidebar-close" class="sidebar-close w-100 p-3 text-end">
        {{-- <span class="mdi mdi-close"></span> --}}
    </div>
    <div class="w-100 mb-3">
        <div class="logo-container">
            <img class="img-fluid" src="{{ asset('img/Manalo Resort Hotel Vertical White Logo.png') }}" alt="">
        </div>
    </div>
    <div class="my-3">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link link-light">
                    <span class="mdi mdi-view-dashboard"></span> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('markers') }}" class="nav-link link-light">
                    <span class="mdi mdi-map-marker"></span>
                    Markers
                </a>
            </li>
            <li>
                <a href="{{ route('icons') }}" class="nav-link link-light">
                    <span class="mdi mdi-map-marker-plus"></span>
                    Icons
                </a>
            </li>
            <li>
                <a href="{{ route('admins') }}" class="nav-link link-light">
                    <span class="mdi mdi-account-group-outline"></span>
                    Admins
                </a>
            </li>

            <li>
                <a href="{{ route('account') }}" class="nav-link link-light">
                    <span class="mdi mdi-account-outline"></span>
                    Profile
                </a>
            </li>

            <li>
                <a href="{{ route('home') }}" class="nav-link link-light">
                    <span class="mdi mdi-web"></span> Visit Homepage
                </a>
            </li>

        </ul>
    </div>
</div>
