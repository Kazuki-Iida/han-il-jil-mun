@extends('layouts.app')　
@section('content')
@php
    $title = __('You\'ve verified your email address.');
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pt-5">
                <div class="card-header">{{ __('You\'ve verified your email address.') }}</div>

                <div class="card-body">
                    {{ __('Let\'s get started.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection