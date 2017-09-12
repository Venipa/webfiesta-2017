@extends('layout.master')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if(count($item) > 0)
                    <div class="panel panel-default top-half-wrapper">
                        <div class="panel-heading">
                            <div class="text-center top-half"><img src="/img/Items/{{$item->sImg}}" alt="" class="img-responsive img-thumbnail text-center"></div>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-warning"><i class="mdi mdi-alert-circle"></i> Do you really want to buy this Item?</div>
                            <div class="table-responsive">
                                <table class="table table-simple table-bordered table-first-grey">
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{$item->sName}}</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>{{$item->nPrice}} Coins</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{$item->sDescript}}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount</td>
                                        <td>{{$item->nLot}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sale Start</td>
                                        <td>{{Carbon\Carbon::create($item->dStartSale)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <form action="" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" class="hidden" name="itemid" value="{{$item->nID}}">
                                    <button type="submit" class="btn btn-success">Buy now</button>
                                    <button class="btn btn-link" data-href="{{route('get:shop')}}">Back to Shop</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-danger"><i class="mdi mdi-alert-circle"></i> Item could not be found</div>
                @endif
            </div>
        </div>
    </div>
@endsection