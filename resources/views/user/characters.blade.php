@extends('layout.master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Characters</div>
            <div class="panel-body">
            <div class="panel-wall">
            @foreach($characters as $char)
                    <div class="panel panel-default panel-hover">
                        <div class="panel-body">
                            <p class="lead">{{$char->sID}}<div class="class-icon class-icon-{{$char->shape()->first()->nClass}} pull-right"></div></p>
                            <small>Lv.{{$char->nLevel}}, {{printf("%d000.00.000.000", $char->nExp)}} EXP</small>
                        </div>
                    </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{$characters->links()}}
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection