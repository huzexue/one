
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/fonts/feather/feather.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/highlight/styles/vs2015.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">

    <title>Dashkit</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 col-xl-4 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                登录
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                欢迎登录～
            </p>

            <!-- Form -->
            <form action="{{route('login',['from'=>Request::query('from')])}}" method="post">
                @csrf
                <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label>邮箱</label>

                    <!-- Input -->
                    <input type="email" name="email" class="form-control" placeholder="请输入邮箱">

                </div>

                <!-- Password -->
                <div class="form-group" style="margin-bottom: 0;">

                    <!-- Label -->
                    <label>密码</label>

                    <!-- Input -->
                    <input type="password" name="password" class="form-control" placeholder="请输入密码">

                </div>

                <div class="text-sm-right mb-2" >
                    <small class="text-muted align-text-top" >
                        <a href="{{route('passwordReset')}}">忘记密码？</a>.
                    </small>
                </div>


                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="rem" id="remember" value="1">
                    <label class="form-check-label" for="remember">记住我!</label>
                </div>
                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3">
                    登录
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                       还没有账号? 去<a href="{{route('register')}}">注册</a>.
                    </small>

                </div>

            </form>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->

<!-- JAVASCRIPT
================================================== -->
@include('layouts.hdjs')
@include('layouts.message')

</body>
</html>