@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            {{--左侧--}}
            @include('member.layouts.menu')
            {{--右侧--}}
            <div class="col-sm-9">
                @if($attentionlists->count() == 0)
                    <p class="text-muted text-center p-5">暂无粉丝</p>
                @else
                    <div class="row">
                        @foreach($attentionlists as $attentionlist)
                            <div class="col-12 col-md-6 col-xl-4">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body text-center">
                                        <a href="{{route('member.user.show',$attentionlist)}}" class="avatar avatar-xl card-avatar ">
                                            <img src="{{$attentionlist->icon}}" class="avatar-img rounded-circle border border-white" alt="...">
                                        </a>

                                        <h2 class="card-title">
                                            <a href="{{route('member.user.show',$attentionlist)}}">{{$attentionlist->name}}</a>
                                        </h2>

                                        <p class="card-text">
                                          <span class="badge badge-soft-secondary">
                                            粉丝:{{$attentionlist->fans->count()}}
                                          </span>
                                            <span class="badge badge-soft-secondary">
                                            关注:{{$attentionlist->following->count()}}
                                          </span>
                                        </p>

                                        @auth()
                                            @can('isNotMine',$attentionlist)
                                            <hr>
                                            <div class="col-auto">
                                                <a href="{{route('member.attention',$attentionlist)}}" class="btn btn-block btn-sm btn-white">
                                                    @if($attentionlist->fans->contains(auth()->user()))
                                                        取消关注
                                                    @else
                                                        关注
                                                    @endif

                                                </a>
                                            </div>
                                                @endcan
                                        @endauth
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    {{$attentionlists->links()}}
                @endif
            </div>

        </div>
    </div>
@endsection