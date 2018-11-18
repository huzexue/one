@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <!-- Header -->
                <div class="header mt-md-2">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h2 class="header-title">
                                    栏目管理
                                </h2>

                            </div>

                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link active">
                                            栏目列表
                                        </a>

                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.category.create')}}" class="nav-link ">
                                            添加栏目
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">编号</th>
                        <th scope="col">栏目标题</th>
                        <th scope="col">栏目图标</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td scope="row">{{$category->id}}</td>
                        <td>{{$category->title}}</td>
                        <td><span class="{{$category->icon}}"></span></td>
                        <td>
                            <a class="btn btn-white" href="{{route('admin.category.edit',$category)}}">编辑</a>

                            <button onclick="del(this)" type="button" class="btn btn-white">删除</button>
                            <form action="{{route('admin.category.destroy',$category)}}" method="post">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                {{$categories->links()}}
            </div>

        </div> <!-- / .row -->

    </div>
@endsection
@push('js')
<script>
    function del(obj) {
        require(['hdjs','bootstrap'], function (hdjs) {
            hdjs.confirm('确定删除吗?', function () {
                $(obj).next('form').submit();
            })
        })
    }
</script>
@endpush