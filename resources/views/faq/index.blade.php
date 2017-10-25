@extends('layout.master')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                    @include('faq.data.levelguide')
                    @include('faq.data.errors')
                </div>
            </div>
        </div>
    </div>

@endsection