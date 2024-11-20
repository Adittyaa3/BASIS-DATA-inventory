<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets2/src/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/src/assets/css/styles.min.css') }}" />
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('assets2/src/assets/images/logos/dark-logo.svg') }}" width="180" alt="Logo">
                        </a>
                        <p class="text-center">Join Your Social Campaigns</p>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-4 rounded">Register</button>
                        </form>
                        <div class="d-flex align-items-center justify-content-center">
                            <p class="mb-0">Already have an account?</p>
                            <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
