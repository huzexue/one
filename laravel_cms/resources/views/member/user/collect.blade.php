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
                                                @if(auth()->id() == $user->id)
                                                    我的收藏
                                                @else
                                                    他的收藏
                                                @endif
                                            </h4>

                                        </div>

                                    </div> <!-- / .row -->
                                </div>

                                <div class="card-body">
                                    <!-- List -->
                                    <ul class="list-group list-group-lg list-group-flush list my--4">
                                        @foreach($collects as $collect)
                                        <li class="list-group-item px-0">
                                                <div class="row align-items-center">

                                                    <div class="col ml--2">

                                                        <!-- Title -->
                                                        <h4 class="card-title mb-1 name">
                                                            <a href="{{route('home.article.show',$collect->belongsModel)}}">{{$collect->belongsModel->title}}</a>
                                                        </h4>

                                                        <p class="card-text small mb-1">
                                                            <a href="{{route('member.user.show',$collect->belongsModel->user)}}" class="text-secondary mr-2">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i>{{$collect->belongsModel->user->name}}
                                                            </a>

                                                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{$collect->belongsModel->created_at->diffForHumans()}}

                                                            <a href="{{route('home.article.index',['category'=>$collect->belongsModel->category->id])}}" class="text-secondary ml-2">
                                                                <i class="fa fa-folder-o" aria-hidden="true"></i>
                                                                {{$collect->belongsModel->category->title}}
                                                            </a>
                                                        </p>

                                                    </div>

                                                </div> <!-- / .row -->

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{$collects->appends(['type'=>Request::query('type')])->links()}}
                        </div>
                    </div> <!-- / .row -->

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
