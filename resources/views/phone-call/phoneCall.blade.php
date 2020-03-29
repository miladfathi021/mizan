@extends('layouts.master')

@section('link')
    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
@endsection

@section('app_name')
    میزان - مشاوره آنلاین در زمینه وکالت
@endsection

@section('content')
    <router-view></router-view>
@endsection
