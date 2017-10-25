@extends('layout.master') @section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div class="row">
                        @if(count(config('fiesta.downloads')) > 0)
                            @foreach(config('fiesta.downloads') as $k=>$d)
                                <div class="col-md-4 m-b-md">
                                    <a href="{{$d}}" class="btn btn-primary btn-block">{{strtoupper($k)}} Download</a>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-contrast">
                                    <div class="icon"><i class="mdi mdi-alert"></i></div>
                                    <div class="message"><strong>Currently</strong> no downloads available</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <table class="table table-simple table-bordered">
                        <thead>
                        <tr class="table-header">
                            <th>
                                <div align="center">SYSTEM</div>
                            </th>
                            <th>
                                <div align="center">MINIMUM</div>
                            </th>
                            <th>
                                <div align="center">RECOMMENDED</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">OS</div>
                            </td>
                            <td>
                                <div align="left">WINDOWS XP</div>
                            </td>
                            <td>
                                <div align="left">WINDOWS 7</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">CPU</div>
                            </td>
                            <td>
                                <div align="left">INTEL PENTIUM 4 AT 1.6 GHZ</div>
                            </td>
                            <td>
                                <div align="left">INTEL PENTIUM 4 AT 2.0 GHZ</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">MEMORY</div>
                            </td>
                            <td>
                                <div align="left">512 MB OF RAM</div>
                            </td>
                            <td>
                                <div align="left">1GB OF RAM</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">VIDEO CARD</div>
                            </td>
                            <td>
                                <div align="left">NVIDIA GEFORCE MX</div>
                            </td>
                            <td>
                                <div align="left">NVIDIA GEFORCE TI</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">DIRECT X</div>
                            </td>
                            <td>
                                <div align="left">DIRECT X 9.0C</div>
                            </td>
                            <td>
                                <div align="left">DIRECT X 11</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">HARD DISK SPACE</div>
                            </td>
                            <td>
                                <div align="left">4GB OF FREE HDD SPACE</div>
                            </td>
                            <td>
                                <div align="left">6GB OF FREE HDD SPACE</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-hightlight">
                                <div align="left">INTERNET CONNECTION</div>
                            </td>
                            <td>
                                <div align="left">BROADBAND 10MBPS</div>
                            </td>
                            <td>
                                <div align="left">BROADBAND 20MBPS</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

@endsection