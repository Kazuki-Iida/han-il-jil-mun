@php
    $title = __('You\'ve verified your email address.');
@endphp

@extends('layouts.myapp')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You\'ve verified your email address.') }}</div>

                <div class="card-body">
                    {{ __('Let\'s get started.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection