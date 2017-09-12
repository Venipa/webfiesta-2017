

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
                                <a href="{{route('get:shop:cat', $s->nCat)}}" class="list-group-item {{(isset($currentCat) && $currentCat == $s->nCat ? 'active' : '')}}">
                                    {{$s->sName}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if(count($items) > 0)
                        <div class="panel-wall">
                                @foreach($items as $item)
                                    <div class="panel panel-default panel-hover">
                                        <div class="panel-heading">
                                            {{$item->sName}}
                                        </div>
                                        <div class="panel-image panel-fit">
                                            @if($item->nPrice <= Auth::user()->nCoins)
                                                <div class="panel-image-hover" data-href="{{route('get:shop:buy', $item->nID)}}">
                                                    <div class="panel-image-text">
                                                        <i class="mdi mdi-48px mdi-plus"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="panel-image-hover red">
                                                    <div class="panel-image-text" data-toggle="tooltip" title="Not enough Coins">
                                                        <i class="mdi mdi-48px mdi-alert-circle"></i>
                                                    </div>
                                                </div>
                                            @endif

                                            <img src="/img/Items/{{$item->sImg}}" alt="" class="img-full">
                                        </div>
                                        <div class="panel-footer">

                                            <div class="text-right"><i class="mdi mdi-coins mdi-18px mdi-middle"></i> <b>{{$item->nPrice}} Coins</b></div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                            <div class="row">
                                <div class="col-md-12">{{$items->links()}}</div>
                            </div>
                            @else
                                <div class="alert alert-danger"><i class="mdi mdi-alert-circle"></i> No Items have been Found on this Category.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection