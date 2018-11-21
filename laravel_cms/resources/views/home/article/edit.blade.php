@extends('home.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h1 class="header-title">
                                    文章编辑
                                </h1>

                            </div>
                        </div> <!-- / .row -->
                    </div>
                </div>

                <!-- Form -->
                <form class="mb-4" method="post" action="{{route('home.article.update',$article)}}">
                @csrf @method('PUT')
                <!-- Project name -->
                    <div class="form-group">
                        <label>文章标题</label>
                        <input type="text" name="title" class="form-control" value="{{$article['title']}}">
                    </div>
                    <div class="form-group">
                        <label>所属栏目</label>
                        <select class="form-control" name="category_id">
                            <option value="">请选择</option>
                            @foreach($categories as  $category)
                                <option @if($article['category_id'] == $category['id']) selected @endif value="{{$category['id']}}">
                                    {{$category['title']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Project description -->
                    <div class="form-group">
                        <label class="mb-1">
                            文章内容
                        </label>
                        <div id="editormd">
                            <textarea style="display:none;" name="content">{{$article['content']}}</textarea>
                        </div>
                    </div>


                    <!-- Buttons -->
                    <button  class="btn btn-block btn-primary">
                        保存数据
                    </button>

                </form>

            </div>
        </div> <!-- / .row -->
    </div>
@endsection

