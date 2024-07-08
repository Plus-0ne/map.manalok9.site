<!DOCTYPE html>
<html lang="en">
<head>
    <x-meta title="{{ $title }}"></x-meta>

    <x-links></x-links>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
</head>
<body>
    <div class="d-flex flex-column h-100 justify-content-center align-items-center">
        <div class="login-wrapper">
            <div class="login-container">
                <div class="mb-3">
                    <h4>
                        Resort map
                    </h4>
                </div>
                <div class="mb-3">
                    <label for="email_address" class="form-label">
                        Email address
                    </label>
                    <input id="email_address" type="text" class="form-control"/>
                    <small id="helpId" class="form-text text-muted">
                        Enter email address
                    </small>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>
                    <input id="password" type="password" class="form-control"/>
                    <small id="helpId" class="form-text text-muted">
                        Enter password
                    </small>
                </div>

                <div class="mb-0">
                    <button id="submitCredentials" type="button" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
    <x-scripts></x-scripts>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
