@extends('layout.master')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="table-responsive">
                            <table class="table table-simple table-striped">
                                <thead>
                                <tr>
                                    <th width="200" style="text-align:right;">Atleast Bought</th>
                                    <th width="150" class="text-center">Coins</th>
                                    <th>Bonus</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rates as $r)
                                    <tr>
                                        <td style="text-align:right;">{{$r->amount}}€</td>
                                        <td class="text-center">{{$base*$r->amount}}</td>
                                        <td>{{$r->bonusPercentage}}%</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection