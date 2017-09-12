@extends('layout.master')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row row-divide-first">
                    <div class="col-md-3">
                        @include('shop.user_embed')
                        <div class="list-group">
                            @foreach($cats as $s)
                                <a href="{{route('get:shop:cat', $s->nCat)}}" class="list-group-item">
                                    {{$s->sName}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="alert alert-info">
                            <i class="mdi mdi-information"></i> Please select an Category on the Left :)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection