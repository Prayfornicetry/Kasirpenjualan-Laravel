@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Selamat Datang di Dashboard, {{ session('user_name') }}!</h2>
            <p>Anda telah berhasil login.</p>

            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>
@endsection