@extends('home.layouts.master')
@section('content')

    <div class="container">
        <div class="row edu-topic-show mt-3">
            <div class="col-12 col-xl-9">
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col text-right">
                            @auth()
                            <a href="{{route('home.collect.make',['type'=>'article','id'=>$article['id']])}}" class="btn btn-xs">
                                @if($article->collect->where('user_id',auth()->id())->first())
                                    <i class="fa fa-heart-o" aria-hidden="true"></i> 取消收藏
                                @else
                                    <i class="fa fa-heart-o" aria-hidden="true"></i> 收藏
                                @endif
                            </a>
                                @endauth
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <h2 class="mb-4">
                                {{$article['title']}}
                            </h2>
                            <p class="text-muted mb-1 text-muted small">
                                <a href="{{route('home.article.show',$article)}}" class="text-secondary">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </a><a href="{{route('member.user.show',$article->user)}}" class="text-secondary">{{$article->user->name}}</a>

                                <i class="fa fa-clock-o ml-2" aria-hidden="true"></i>
                                {{$article->created_at->diffForHumans()}}

                                <a href="{{route('home.article.index',['category'=>$article->category->id])}}" class="text-secondary">
                                    <i class="fa fa-folder-o ml-2" aria-hidden="true"></i>
                                    {{$article->category->title}}
                                </a>

                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="markdown editormd-html" id="content">
                                <textarea name="content" id="" hidden cols="30" rows="10"> {{$article->content}}</textarea>
                            </div>
                        </div>
                    </div>

                    {{--点赞--}}
                    <div class="text-center">
                        @auth()
                            @if($article->zan->where('user_id',auth()->id())->first())
                                <a class="btn btn-white" href="{{route('home.zan.make',['type'=>'article','id'=>$article['id']])}}">😢取消点赞</a>
                            @else
                                <a class="btn btn-white" href="{{route('home.zan.make',['type'=>'article','id'=>$article['id']])}}">👍 赞</a>
                            @endif
                        @else
                            <a class="btn btn-white" href="{{route('login',['from'=>url()->full()])}}">👍 赞</a>
                        @endauth
                    </div>
                    <div class="row">
                        <div class="col-12 mr--3">
                            <div class="avatar-group d-none d-sm-flex">
                                @foreach($article->zan as $zan)
                                <a href="{{route('member.user.show',$zan->user)}}" class="avatar avatar-xs" data-toggle="tooltip" title="" data-original-title="Ab Hadley">
                                    <img src="{{$zan->user->icon}}" alt="..." class="avatar-img rounded-circle border border-white">
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>

                @include('home.layouts.comment')
            </div>

            <div class="col-12 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <a href="" class="text-secondary">
                                {{$article->user->name}}
                            </a>
                        </div>
                    </div>
                    <div class="card-block text-center p-5">
                        <div class="avatar avatar-xl">
                            <a href="{{route('member.user.show',$article->user)}}">
                                <img src="{{$article->user->icon}}" alt="..." class="avatar-img rounded-circle">
                            </a>
                        </div>
                    </div>

                    @auth()
                        @can('isNotMine',$article->user)
                    <div class="card-footer text-muted">
                        <a class="btn btn-white btn-block btn-xs" href="{{route('member.attention',$article->user)}}">
                            @if($article->user->fans->contains(auth()->user()))
                                <i class="fa fa-minus" aria-hidden="true"></i> 取消关注
                            @else
                                <i class="fa fa-plus" aria-hidden="true"></i> 关注 TA
                            @endif
                        </a>
                    </div>
                            @endcan
                        @endauth
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        require(['hdjs','MarkdownIt','marked', 'highlight'], function (hdjs,MarkdownIt,marked) {
            //将markdown转为html代码：http://hdjs.hdphp.com/771125
            let md = new MarkdownIt();
            let content = md.render($('textarea[name=content]').val());
            $('#content').html(content);
            //代码高亮
            $(document).ready(function() {
                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });
            });
        })
    </script>
@endpush