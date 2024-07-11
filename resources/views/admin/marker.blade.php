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
                                    <span class="mdi mdi-home"></span> Markers
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="w-100 table-responsive">
                            <table id="markers" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Location</th>
                                        <th scope="col">Lat. / Long.</th>
                                        <th scope="col">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($markers->count() > 0)
                                    @foreach ($markers as $row)
                                    <tr>
                                        <td>
                                            {{ $row->title }}
                                        </td>
                                        <td>
                                            {{ $row->latitude }} / {{ $row->longitude }}
                                        </td>
                                        <td>
                                            {{ $row->created_at }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.sections.scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>

     let markers = new DataTable('#markers');
    </script>
</body>

</html>
