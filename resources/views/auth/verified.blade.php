@extends('layouts.app')　
@section('content')
@php
    $title = __('You\'ve verified your email address.');
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('You\'ve verified your email address.') }}</div>

                <div class="card-body">
                    {{ __('Let\'s get started.') }}&ensp;&ensp;
                    <a href="/" class="btn btn-link text-nowrap">トップページへ&ensp;<i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection