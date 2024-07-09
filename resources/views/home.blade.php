<!DOCTYPE html>
<html lang="en">

<head>
    <x-meta title="{{ $title }}"></x-meta>

    <x-links></x-links>
</head>

<body>
    <div class="main">

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="#">Manalo Resort Hotel</a>
                <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="mdi mdi-format-align-justify"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-ite active">
                            <a class="nav-link text-light active" aria-current="page" href="{{ route('home') }}">
                                Map
                            </a>
                        </li>
                    </ul>
                    @auth('admins')
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-ite">
                            <a class="nav-link text-light" aria-current="page" href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-ite">
                            <a class="nav-link text-light" aria-current="page" href="{{ route('logout') }}">
                                Logout
                            </a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <div id="map" class="map"></div>
        @auth('admins')
        <div class="admin-controls">
            <div class="btn-group" role="group" data-bs-toggle="buttons">
                <label class="btn btn-primary">
                    <input id="checkboxNewMarker" type="checkbox" class="me-2"/>
                    Add Marker
                </label>
            </div>
        </div>
        @endauth
    </div>
    <x-modal.view_360></x-modal.view_360>
    @auth('admins')
    <x-modal.add_marker></x-modal.add_marker>
    @endauth
    <x-footer></x-footer>
    <x-scripts></x-scripts>
    <script src="{{ asset('js/map.js') }}"></script>
    <script>

    </script>
</body>

</html>
