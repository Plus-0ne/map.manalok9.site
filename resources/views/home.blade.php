<!DOCTYPE html>
<html lang="en">

<head>
    <x-meta title="{{ $title }}"></x-meta>

    <x-links></x-links>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        #panorama.pnlm-container {
            background-image: none;
            background-color: rgb(32, 32, 32);

        }
        </style>
</head>

<body>
    <div class="main">

        <nav class="navbar navbar-expand bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="{{ route('home') }}">
                    <img src="{{ asset('img/Manalo Resort Hotel Vertical White Logo.png') }}" height="50px">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        {{-- <li class="nav-ite active">
                            <a class="nav-link text-light active" aria-current="page" href="{{ route('home') }}">
                                Map
                            </a>
                        </li> --}}
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
        <div id="customContextMenu" style="position: absolute; display: none; z-index: 999999;">
            <!-- Hover added -->
            <div class="list-group">
                <a id="updateMarker" href="javascript:void(0);" class="list-group-item list-group-item-action" style="display: none;">
                    <small>Update</small>
                </a>

                <a id="deleteMarker" href="javascript:void(0);" class="list-group-item list-group-item-action">
                    <small>Delete</small>
                </a>

            </div>

        </div>
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
    <x-modal.add_marker :markers="$markers"></x-modal.add_marker>
    @endauth
    <x-footer></x-footer>
    <x-scripts></x-scripts>
    <script src="{{ asset('js/map.js') }}"></script>
    <script>

    </script>
</body>

</html>
