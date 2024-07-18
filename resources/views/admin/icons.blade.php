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
                    @if ($marker_icons->count() > 0)
                    @foreach ($marker_icons as $row)
                    <div class="col-6 col-lg-2 text-light mb-4">
                        <div class="card text-dark py-2 px-1">
                            <img class="card-img-top w-50 mx-auto" src="{{ asset($row->path) }}" alt="Title" />
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ Str::upper($row->name) }}</h6>
                                <div class="card-text text-end">
                                    <br>
                                    <button type="button" class="btn btn-danger btn-sm w-100 removeIcon" data-uuid="{{ $row->uuid }}">
                                        <span class="mdi mdi-delete"></span> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-12 text-light mb-4 text-center">
                        <div class="text-dark lead">
                            No marker icon found!
                        </div>
                    </div>
                    @endif
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
