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
                                    <span class="mdi mdi-home"></span> Admins
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <button id="btnShowAdminForm" type="button" class="btn btn-primary">
                            <span class="mdi mdi-plus"></span> New
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="admins" class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email address</th>
                                        <th scope="col">Verified at</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($admins->count() > 0)
                                    @foreach ($admins as $row)
                                    <tr>
                                        <td>
                                            {{ $row->first_name }} {{ $row->last_name }} {{ $row->middle_name }}
                                        </td>
                                        <td>
                                            {{ $row->email_address }}
                                        </td>
                                        <td>
                                            {{ $row->email_verified_at }}
                                        </td>
                                        <td>
                                            {{ $row->created_at }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <span class="mdi mdi-cog"></span> Options
                                                </button>
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);">
                                                        <span class="mdi mdi-circle-edit-outline text-primary"></span> Update
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0);">
                                                        <span class="mdi mdi-cancel text-secondary"></span> Disable
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item btnDeleteAdmin" href="javascript:void(0);" data-uuid="{{ $row->uuid }}">
                                                        <span class="mdi mdi-delete text-danger"></span> Delete
                                                    </a>
                                                </div>
                                            </div>
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

    <x-admin.modal_create_admin></x-admin.modal_create_admin>
    <x-footer></x-footer>
    @include('admin.sections.scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/admin-accounts.js') }}"></script>
</body>

</html>
