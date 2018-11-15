
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
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Dashkit</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

            <!-- Image -->
            <div class="text-center">
                <img src="{{asset('org/assets')}}/img/illustrations/coworking.svg" alt="..." class="img-fluid">
            </div>

        </div>
        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                重置密码
            </h1>

            <!-- Subheading -->
            <div class="text-center">
                <small class="text-muted text-center">
                    有密码！我要去 <a href="{{route('login')}}">登录</a>.
                </small>

            </div>

            <!-- Form -->
            <form action="{{route('passwordReset')}}" method="post">
                @csrf
                <!-- Email address -->
                <div class="form-group">

                    <!-- Label -->
                    <label>验证邮箱</label>

                    <!-- Input -->
                    <input type="email" name="email" class="form-control" value="314330329@qq.com" placeholder="请输入邮箱">

                </div>
                {{--新密码--}}
                <div class="form-group">

                    <!-- Label -->
                    <label>新密码</label>

                    <!-- Input -->
                    <input type="password" name="password" class="form-control" placeholder="请输入新密码">

                </div>
                {{--重复新密码--}}
                <div class="form-group">

                    <!-- Label -->
                    <label>重复新密码</label>

                    <!-- Input -->
                    <input type="password" name="password_confirmation" class="form-control" placeholder="请输入重复密码">

                </div>

                <div class="form-group">
                    <label>
                        验证码
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" name="code" value="8823" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="bt">发送验证码</button>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3">
                    重置密码
                </button>

                <!-- Link -->

                <div class="text-center">
                    <small class="text-muted text-center">
                        没有账号！我要去 <a href="{{route('register')}}">注册</a>.
                    </small>

                </div>


            </form>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->


@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['hdjs','bootstrap'], function (hdjs) {
        let option = {
            //按钮
            el: '#bt',
            //后台链接
            url: '{{route('code.send')}}',
            //验证码等待发送时间
            timeout: 10,
            //表单，手机号或邮箱的INPUT表单
            input: '[name="email"]'
        };
        hdjs.validCode(option);
    })
</script>



</body>
</html>