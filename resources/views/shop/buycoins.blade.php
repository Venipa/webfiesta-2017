@extends('layout.master')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <iframe src="https://wall.superrewards.com/super/offers?h={{config('fiesta.srr.apphash')}}&uid={{Auth::id()}}" frameborder="0" style="min-width:100%;" height="800" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection