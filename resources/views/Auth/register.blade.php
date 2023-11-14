<!doctype html>
<html lang="en">

<head>
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>

<body>
    <section class="ftco-section">
        <div class="col-12 mx-auto">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Đăng ký</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5 shadow-lg">
                        <div class="icon d-flex align-items-center justify-content-center mb-4">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <form action="#" class="login-form">
                            <div class="form-group col-12 d-flex justify">
                                <input type="text" class="form-control rounded-left col-6" placeholder="Username">
                                <input type="text" class="form-control rounded-left col-6" placeholder="Username">

                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password">
                            </div>
                            <div class="form-group text-center">
                                <a href="">Đã có tài khoản ? Đăng nhập ngay</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Đăng
                                    nhập</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
