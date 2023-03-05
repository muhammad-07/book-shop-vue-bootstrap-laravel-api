@extends('layouts.app')

@section('content')
<div id="app"><App :api_token="`{{env('APP_KEY')}}`" /></div>
@endsection
