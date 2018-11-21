@extends('home.layouts.master')
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Files -->
                    <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h4 class="card-header-title">
                                        文章列表
                                    </h4>

                                </div>
                                <div class="col-auto">

                                    <!-- Dropdown -->
                                    <div class="dropdown">

                                        <!-- Toggle -->
                                        <a href="#!" class="small text-muted dropdown-toggle" data-toggle="dropdown">
                                            筛选
                                        </a>

                                        <!-- Menu -->
                                        <div class="dropdown-menu">
                                            @foreach($categorys as $category)
                                            <a class="dropdown-item sort"  href="{{route('home.article.index',['category'=>$category['id']])}}">
                                                {{$category->title}}
                                            </a>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>
                                <div class="col-auto">

                                    <!-- Button -->
                                    <a href="{{route('home.article.create')}}" class="btn btn-sm btn-primary">
                                        发表文章
                                    </a>

                                </div>
                            </div> <!-- / .row -->
                        </div>

                        <div class="card-body">

                            <!-- List -->
                            <ul class="list-group list-group-lg list-group-flush list my--4">
                                    @foreach($art as $v)
                                    <li class="list-group-item px-0">

                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="{{route('member.user.show',$v->user)}}" class="avatar avatar-sm">
                                                    <img src="{{$v->user->icon}}" alt="..." class="avatar-img rounded">
                                                </a>

                                            </div>
                                            <div class="col ml--2">

                                                <!-- 标题 -->
                                                <h4 class="card-title mb-1 name">
                                                    <a href="{{route('home.article.show',$v)}}">{{$v->title}}</a>
                                                </h4>

                                                <p class="card-text small mb-1">
                                                    <a href="javascript:;" class="text-secondary mr-2">
                                                        {{--作者名字--}}
                                                        <i class="fa fa-user-circle" aria-hidden="true"></i> {{$v->user->name}}
                                                    </a>
                                                    {{--Carbon 处理时间库--}}
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{$v->created_at->diffForHumans()}}

                                                    <a href="javascript:;" class="text-secondary ml-2">
                                                        {{--所属栏目--}}
                                                        <i class="fa fa-folder-o" aria-hidden="true"></i> {{$v->category->title}}</a>
                                                </p>

                                            </div>
                                            <div class="col-auto">

                                                <!-- Dropdown -->
                                                <div class="dropdown">
                                                    <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('home.article.show',$v)}}" class="dropdown-item">
                                                            查看详情
                                                        </a>

                                                        @can('update',$v)
                                                            <a href="{{route('home.article.edit',$v)}}" class="dropdown-item">
                                                                编辑
                                                            </a>
                                                        @endcan
                                                        @can('delete',$v)
                                                            <a href="javascript:;" onclick="del(this)" class="dropdown-item">
                                                                删除
                                                            </a>
                                                            <form action="{{route('home.article.destroy',$v)}}" method="post">
                                                                @csrf @method('DELETE')
                                                            </form>
                                                        @endcan

                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- / .row -->

                                    </li>
                                    @endforeach
                            </ul>

                        </div>
                    </div>
                    {{$art->appends(['category' => Request::query('category')])->links()}}

                </div>
            </div> <!-- / .row -->
        </div>
    </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            require(['https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js'], function (swal) {
                swal("确定删除?", {
                    icon: 'warning',
                    buttons: {
                        cancel: "取消",
                        defeat: '确定',
                    },
                }).then((value) => {
                    switch (value) {
                        case "defeat":
                            $(obj).next('form').submit();
                            break;
                        default:

                    }
                });
            })
        }
    </script>
@endpush
