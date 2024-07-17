@include('admin.sections.header')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
</head>

<body>
    @include('admin.sections.nav')

    <div class="wrapper">
        @include('admin.sections.sidebar')

        <div class="main-content py-3">

            <div class="container-fluid container-lg">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span class="mdi mdi-home"></span> Icons
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <button id="btnShowIconForm" type="button" class="btn btn-primary">
                            <span class="mdi mdi-plus"></span> New
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-2 text-light">
                        <div class="card text-dark">
                            <img class="card-img-top" src="{{ asset('img/marker-icons/coffee-icon.png') }}" alt="Title" />
                            <div class="card-body">
                                <h4 class="card-title">Coffee icon</h4>
                                <div class="card-text">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Button
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-lg-2 text-light">
                        <div class="card text-dark">
                            <img class="card-img-top" src="{{ asset('img/marker-icons/pool-icon.png') }}" alt="Title" />
                            <div class="card-body">
                                <h4 class="card-title">Pool icon</h4>
                                <div class="card-text">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Button
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-lg-2 text-light">
                        <div class="card text-white">
                            <img class="card-img-top" src="{{ asset('img/marker-icons/food-icon.png') }}" alt="Title" />
                            <div class="card-body">
                                <h4 class="card-title">Food icon</h4>
                                <div class="card-text">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Button
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6 col-lg-2 text-light">
                        <div class="card text-white">
                            <img class="card-img-top" src="{{ asset('img/marker-icons/office-icon.png') }}" alt="Title" />
                            <div class="card-body">
                                <h4 class="card-title">Office icon</h4>
                                <div class="card-text">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Button
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <x-admin.modal_create_icon></x-admin.modal_create_icon>
    <x-footer></x-footer>
    @include('admin.sections.scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/icons.js') }}"></script>
</body>

</html>
