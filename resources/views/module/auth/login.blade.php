<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login Page</title>
    @include('layout.include-header')
</head>

<body class="bg-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <strong>Terjadi kesalahan!</strong> Silakan periksa kembali inputan kamu.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
          
                        {{-- --- --}}
                        <form action="{{route('loginStore')}}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email"
                                    placeholder="name@example.com" name="email" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password" placeholder="Password"
                                    name="password" />
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('layout.include-footer')
    @include('include.modal')
</body>

</html>
