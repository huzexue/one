@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            {{--左侧--}}
           @include('member.layouts.menu')
            {{--右侧--}}
            <div class="col-sm-9">
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
                                               我的文章
                                            </h4>

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
                                        @foreach($articles as $article)
                                        <li class="list-group-item px-0">
                                                <div class="row align-items-center">
                                                    {{--<div class="col-auto">--}}
                                                        {{--<!-- Avatar -->--}}
                                                        {{--<a href="" class="avatar avatar-sm">--}}
                                                            {{--<img src="{{$article->user->icon}}" alt="..." class="avatar-img rounded">--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    <div class="col ml--2">

                                                        <!-- Title -->
                                                        <h4 class="card-title mb-1 name">
                                                            <a href="{{route('home.article.show',$article)}}">{{$article->title}}</a>
                                                        </h4>

                                                        <p class="card-text small mb-1">
                                                            <a href="javascript:;" class="text-secondary mr-2">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>{{$article->user->name}}
                                                            </a>

                                                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{$article->updated_at->diffForHumans()}}

                                                            <a href="javascript:;" class="text-secondary ml-2">
                                                                <i class="fa fa-folder-o" aria-hidden="true"></i> {{$article->category->title}}</a>
                                                        </p>

                                                    </div>
                                                    <div class="col-auto">

                                                        <!-- Dropdown -->
                                                        <div class="dropdown">
                                                            <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fe fe-more-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="" class="dropdown-item">
                                                                    查看详情
                                                                </a>
                                                                @can('update',$article)
                                                                <a href="{{route('home.article.edit',$article)}}" class="dropdown-item">
                                                                    编辑
                                                                </a>
                                                                @endcan
                                                                @can('delete',$article)
                                                                <a href="javascript:;" onclick="del(this)" class="dropdown-item">
                                                                    删除
                                                                </a>
                                                                @endcan
                                                                <form action="{{route('home.article.destroy',$article)}}" method="post">
                                                                    @csrf @method('DELETE')
                                                                </form>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div> <!-- / .row -->

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div> <!-- / .row -->
                    {{$articles->links()}}
                </div>
            </div>

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
