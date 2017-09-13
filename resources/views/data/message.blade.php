@if (session()->has('message'))
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('error') && session()->get('error'))
                <div class="alert alert-danger fade in">
                    @else
                        <div class="alert alert-success fade in">
                            @endif
                            <i class="mdi mdi-check"></i> {{ session()->get('message') }}
                        </div>
                </div>
        </div>
@endif