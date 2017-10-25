@extends('layout.master')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">TOP 100 Players</div>
                    <div class="table-responsive">
                        <table class="table table-simple table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Character Name</th>
                                <th class="text-center">Level</th>
                                <th>Exp</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($characters as $k=>$char)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$char->sID}}</td>
                                    <td class="text-center">{{$char->nLevel}}</td>
                                    <td>{{$char->nExp}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($characters->hasPages())
                        <div class="panel-footer text-center">
                            {{$characters->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection