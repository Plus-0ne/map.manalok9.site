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
                                    <span class="mdi mdi-home"></span> Profile
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                {{-- <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <button id="btnShowAdminForm" type="button" class="btn btn-primary">
                            <span class="mdi mdi-plus"></span> New
                        </button>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <dl class="row">
                            <dt class="col-sm-3">
                                EDIT NAME
                            </dt>
                            <dd class="col-sm-9">
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <input id="last_name" type="text" class="form-control" placeholder="Last name" value="{{ Auth::guard('admins')->user()->last_name }}"/>
                                        <small id="helpId" class="form-text text-muted">Last name</small>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <input id="first_name" type="text" class="form-control" placeholder="First name"  value="{{ Auth::guard('admins')->user()->first_name }}"/>
                                        <small id="helpId" class="form-text text-muted">First name</small>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <input id="middle_name" type="text" class="form-control" placeholder="Middle initial/name"  value="{{ Auth::guard('admins')->user()->middle_name }}"/>
                                        <small id="helpId" class="form-text text-muted">Middle initial / name</small>
                                    </dd>
                                </dl>
                            </dd>
                            <dt class="col-sm-3 text-truncate">

                            </dt>
                            <dd class="col-sm-9">
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <button id="btnSubmitNameUpdate" type="button" class="btn btn-primary">
                                            Save
                                        </button>
                                    </dd>
                                </dl>
                            </dd>
                            <dt class="col-sm-3">
                                CHANGE PASSWORD
                            </dt>
                            <dd class="col-sm-9">
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <input id="cPassword" type="text" class="form-control" placeholder="Current"/>
                                        <small id="helpId" class="form-text text-muted">Current password</small>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <input id="nPassword" type="text" class="form-control" placeholder="New"/>
                                        <small id="helpId" class="form-text text-muted">New password</small>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <input id="vPassword" type="text" class="form-control" placeholder="Verify"/>
                                        <small id="helpId" class="form-text text-muted">Verify password</small>
                                    </dd>
                                </dl>
                            </dd>
                            <dt class="col-sm-3 text-truncate">

                            </dt>
                            <dd class="col-sm-9">
                                <dl class="row">
                                    <dd class="col-12 col-lg-4">
                                        <button id="btnSubmitPasswordUpdate" type="button" class="btn btn-primary">
                                            Change password
                                        </button>
                                    </dd>
                                </dl>
                            </dd>
                        </dl>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
    @include('admin.sections.scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
</body>

</html>
