<div class="panel panel-default top-half-wrapper top-half-sm">
    <div class="panel-body text-center">
        <img src="{{Gravatar::fallback('/img/defaultprofile.png')->get(\Auth::user()->email, ['size' => 100])}}" alt="" class="img-responsive img-thumbnail top-half">
    </div>
    <div class="table-responsive">
        <table class="table table-simple table-first-grey">
            <tbody>
            <tr>
                <td><strong>Username</strong></td>
                <td>{{Auth::user()->username}}</td>
            </tr>
            <tr>
                <td><strong>Coins</strong></td>
                <td>{{Auth::user()->nCoins}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>