@extends('home.layouts.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <!-- Files -->
                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h4 class="card-header-title">
                                    动态
                                </h4>

                            </div>
                        </div> <!-- / .row -->
                    </div>

                    <div class="card-body">

                        <!-- List group -->
                        <div class="list-group list-group-flush my--3">
                            @foreach($actives as $active)
                                @if($active['log_name'] =='article')
                                    @include('home.layouts._article')
                                @elseif($active['log_name'] =='comment')
                                    @include('home.layouts._comment')
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <!-- List -->

                </div>
                {{$actives->links()}}
            </div>

        </div>
    </div>
@endsection