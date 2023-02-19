<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="yoursite.com" />

    <title>Login/Sign up</title>

    <!-- Favicon -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">


    <!-- Main structure css file -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    @php
    $Model = new App\Models\UserRoleModel();
    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">

                <!-- -login start -->
                <div class="authfy-login">
                    <!-- panel-login start -->
                    <div class="authfy-panel panel-login text-center active">
                        <div class="authfy-heading">
                            <h3 class="auth-title">Login to your account</h3>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <form name="loginForm" class="loginForm" action="{{route('login')}}" method="POST">
                                    @csrf
                                    <input type="email" class="form-control email" name="email"
                                        placeholder="Email address" required>
                                    <div class="pwdMask">
                                        <input type="password" class="form-control password" name="password"
                                            placeholder="Password" required>
                                        <span class="fa fa-eye-slash pwd-toggle"></span>
                                    </div>
                                    <div class="row remember-row">
                                        <div class="col-xs-6 col-sm-6">
                                            <label class="checkbox text-left">
                                                <input type="checkbox" value="remember-me"><span
                                                    class="label-text">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="col-xs-6 col-sm-6">
                                            <p class="forgotPwd">
                                                <a class="lnk-toggler" data-panel=".panel-forgot" href="#">Forgot
                                                    password?</a>
                                            </p>
                                        </div>
                                    </div> <!-- ./remember-row -->
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login with
                                            email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- ./panel-login -->
                    <!-- panel-signup start -->
                    <div class="authfy-panel panel-signup text-center">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="authfy-heading">
                                    <h3 class="auth-title">Sign up </h3>
                                </div>
                                <form name="signupForm" class="signupForm" action="{{route('signup')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email address" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fullname" id="fullname"
                                            placeholder="Full name" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="pwdMask">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" value="" required>
                                            <span class="fa fa-eye-slash pwd-toggle"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- USER DROP DOWN -->
                                        <select name="user_role_id" id="user_role_id" class="form-control" required>
                                            <option value="">----------Select Role----------</option>
                                            @if(isset($UserRoleData) && !empty($UserRoleData))
                                            @foreach($UserRoleData as $UeserRole)
                                            <option value="{{$UeserRole['id']}}">{{$UeserRole['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="pwdMask">
                                            <input type="file" class="form-control" name="image"
                                                placeholder="Choose image" id="image" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image-before-upload"
                                            style="max-height: 132px;max-width: 143px;margin-right: 320px;"
                                            src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                            alt="preview image" style="max-height: 250px;">
                                    </div>
                                    <div class="form-group">
                                        <p class="term-policy text-muted small">I agree to the <a href="#">privacy
                                                policy</a> and <a href="#">terms of service</a>.</p>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                                    </div>
                                </form>
                                <a class="lnk-toggler" data-panel=".panel-login" href="#">Already have an account?</a>
                            </div>
                        </div>
                    </div> <!-- ./panel-signup -->
                    <!-- panel-forget start -->
                    <div class="authfy-panel panel-forgot">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="authfy-heading">
                                    <h3 class="auth-title">Recover your password</h3>
                                    <p>Fill in your e-mail address below and we will send you an email with further
                                        instructions.</p>
                                </div>
                                <form name="forgetForm" class="forgetForm" action="#" method="POST">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="username"
                                            placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Recover your
                                            password</button>
                                    </div>
                                    <div class="form-group">
                                        <a class="lnk-toggler" data-panel=".panel-login" href="#">Already have an
                                            account?</a>
                                    </div>
                                    <div class="form-group">
                                        <a class="lnk-toggler" data-panel=".panel-signup" href="#">Don’t have an
                                            account?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- ./panel-forgot -->
                </div> <!-- ./authfy-login -->
            </div>
        </div> <!-- ./row -->
    </div> <!-- ./container -->

    <!-- Javascript Files -->

    <!-- initialize jQuery Library -->
    <script src="https://koder.top/demo/authfy/demo/js/jquery-2.2.4.min.js"></script>

    <!-- for Bootstrap js -->
    <script src="https://koder.top/demo/authfy/demo/js/bootstrap.min.js"></script>

    <!-- Custom js-->
    <script src="https://koder.top/demo/authfy/demo/js/custom.js"></script>
    <script>
    // image Preview
    $(document).ready(function(e) {


        $('#image').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
    </script>

</body>

</html>