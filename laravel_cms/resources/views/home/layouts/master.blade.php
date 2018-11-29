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
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @stack('css')
    <title>Dashkit</title>
</head>
<body>

<!-- 头部
================================================== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">

        <!-- Toggler -->
        <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand mr-auto" href="{{route('home')}}">
            <img src="{{asset('org/images')}}/timg.jpeg" alt="..." class="navbar-brand-img">
            <span class="font-weight-bold">白溪豆腐</span>
        </a>

        <!-- 搜索框 -->
        <form class="form-inline mr-4 d-none d-lg-flex" action="{{route('home.search')}}">
            <div class="input-group input-group-rounded input-group-merge" data-toggle="lists" data-lists-values='["name"]'>

                <!-- Input -->
                <input type="text" name="wd" class="form-control form-control-prepended  dropdown-toggle search" >
                <button  class="input-group-prepend btn-link" style="border: none;box-shadow: none;margin: 0;padding-left: 0;padding-right:0;padding-top: 0;cursor:pointer;">
                    <div class="input-group-text">
                        <i class="fe fe-search text-primary">搜索</i>
                    </div>
                </button>



            </div>
        </form>

        <!-- User -->
        <div class="navbar-user">

            <!-- 通知 -->
            @auth()
            <div class="dropdown mr-4 d-none d-lg-flex">

                <!-- Toggle -->
                <a href="#" class="text-muted" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              <span class="icon @if(auth()->user()->unreadNotifications()->count()!=0) active @endif">
                <i class="fe fe-bell"></i>
              </span>
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="card-header-title">
                                    通知{{auth()->user()->unreadNotifications()->count()}}
                                </h5>

                            </div>
                            <div class="col-auto">

                                <!-- Link -->
                                <a href="{{route('member.notify',auth()->user())}}" class="small">
                                    查看全部通知
                                </a>

                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .card-header -->

                    <div class="card-body">

                        <!-- List group -->
                        <div class="list-group list-group-flush my--3">
                            @if(auth()->user()->unreadNotifications()->count() != 0)
                            @foreach(auth()->user()->unreadNotifications()->limit(3)->get() as $notification)
                                <a class="list-group-item px-0" href="{{route('member.notify.show',$notification)}}">

                                    <div class="row">
                                        <div class="col-auto">

                                            <!-- Avatar -->
                                            <div class="avatar avatar-sm">
                                                <img src="{{$notification['data']['user_icon']}}" alt="..." class="avatar-img rounded-circle">
                                            </div>

                                        </div>
                                        <div class="col ml--2">

                                            <!-- Content -->
                                            <div class="small text-muted">
                                                <strong class="text-body">{{$notification['data']['user_name']}}</strong> 评论了
                                                <strong class="text-body">{{$notification['data']['article_title']}}</strong>
                                            </div>

                                        </div>
                                        <div class="col-auto">

                                            <small class="text-muted">
                                                {{$notification->created_at->diffForHumans()}}
                                            </small>

                                        </div>
                                    </div> <!-- / .row -->

                                </a>
                            @endforeach
                            @else
                                <h2 class="text-center">暂无通知</h2>
                            @endif
                        </div>

                    </div>

                </div> <!-- / .dropdown-menu -->

            </div>
            @endauth
            {{--添加文章--}}
            <div class="dropdown mr-4 d-none d-lg-flex">

                <a href="{{route('home.article.create')}}" class="text-muted">
                  <span class="icon">
                    <i class="fa fa-pencil-square-o"></i>
                  </span>
                </a>

            </div>

            <!-- 头像Dropdown -->
            @auth()
            <div class="dropdown">

                <!-- Toggle -->
                <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{auth()->user()->icon}}" alt="..." class="avatar-img rounded-circle">
                </a>

                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('member.user.show',auth()->user())}}" class="dropdown-item">{{auth()->user()->name}}</a>
                    @if(auth()->user()->is_admin==1)
                    <a href="{{route('admin.index')}}" class="dropdown-item">后台管理</a>
                    @endif
                    <hr class="dropdown-divider">
                    <a href="{{route('logout')}}" class="dropdown-item">退出登录</a>
                </div>

            </div>
            @else
            {{--登录注册--}}
            <div class="dropdown">
                <a class="btn btn-link btn-sm" href="{{route('register')}}">还没有账号！去注册</a>
                <a  class="btn btn-primary btn-sm" href="{{route('login')}}">登录</a>
            </div>
            @endauth
        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse mr-auto order-lg-first" id="navbar">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <input type="search" class="form-control form-control-rounded" placeholder="Search" aria-label="Search">
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link  text-primary font-weight-bold" href="{{route('home.index')}}">
                        首页
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#!" id="topnavPages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pages
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="topnavPages">
                        <li class="dropright">
                            <a class="dropdown-item dropdown-toggle" href="#!" id="topnavProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profile
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnavProfile">
                                <a class="dropdown-item" href="profile-posts.html">
                                    Posts
                                </a>
                                <a class="dropdown-item" href="profile-groups.html">
                                    Groups
                                </a>
                                <a class="dropdown-item" href="profile-projects.html">
                                    Projects
                                </a>
                                <a class="dropdown-item" href="profile-files.html">
                                    Files
                                </a>
                                <a class="dropdown-item" href="profile-subscribers.html">
                                    Subscribers
                                </a>
                            </div>
                        </li>
                        <li class="dropright">
                            <a class="dropdown-item dropdown-toggle" href="#!" id="topnavProject" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Project
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnavProject">
                                <a class="dropdown-item" href="project-overview.html">
                                    Overview
                                </a>
                                <a class="dropdown-item" href="project-files.html">
                                    Files
                                </a>
                                <a class="dropdown-item" href="project-reports.html">
                                    Reports
                                </a>
                                <a class="dropdown-item" href="project-new.html">
                                    New project
                                </a>
                            </div>
                        </li>
                        <li class="dropright">
                            <a class="dropdown-item dropdown-toggle" href="#!" id="topnavTeam" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Team
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnavTeam">
                                <a class="dropdown-item" href="team-overview.html">
                                    Overview
                                </a>
                                <a class="dropdown-item" href="team-project.html">
                                    Project
                                </a>
                                <a class="dropdown-item" href="team-members.html">
                                    Members
                                </a>
                                <a class="dropdown-item" href="team-new.html">
                                    New team
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="orders.html">
                                Orders
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="feed.html">
                                Feed
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="settings.html">
                                Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="invoice.html">
                                Invoice
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pricing.html">
                                Pricing
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home.article.index')}}">
                        文章列表
                    </a>
                </li>

            </ul>

        </div>

    </div> <!-- / .container -->
</nav>


<div class="main-content">
    @yield('content')
</div>


<footer class="container">
    {{--<div class="footer-fixed-bottom">--}}
    <hr class="my-2">
    <div class="text-center py-1">
        <div>
            <p class="text-muted">十年磨一剑，霜刃未曾试。</p>
            <small class="small text-secondary">
                Copyright © 2010-2018 www.woej980.cn All Rights Reserved
                京ICP备18055905号
            </small>
            <p class="small text-secondary">
                <i class="fa fa-phone-square" aria-hidden="true"></i> : 151****8888
                <i class="fa fa-telegram ml-2" aria-hidden="true"></i> :
                <a href="mailto:314330329@qq.com" class="text-secondary">
                    314330329@qq.com
                </a>
                <br>
            </p>
        </div>
    </div>
    {{--</div>--}}
</footer>

@include('layouts.hdjs')
<script>
    require(['bootstrap'])
</script>
@include('layouts.message')

@stack('js')
</body>
</html>