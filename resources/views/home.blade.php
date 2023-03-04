@extends('layouts.app')

@section('content')
<div id="app"><App :api_token="'123'" /></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @php
                    // echo Auth::user()->remember_token.'<br><br>';
                    // print_r(Auth::user()->currentAccessToken());
                    // $tt = Auth::user()->createToken("test_key");
                    // echo ($tt->accessToken);
                    print_r(Auth::user());
                    echo $token = Auth::user()->createToken('Laravel Password Grant Client')->accessToken;

                   echo env('APP_KEY');
                @endphp
                <div class="card-body">Hello  @can('admin') Admin @else Reader @endcan
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }} Hello

                        </div>

                    @endif

                    {{ __('You are logged in!') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
