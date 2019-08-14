@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

                <img src="{{ auth()->user()->avatar }}" alt="" style="width: 100px">
            {{ display('hi').' '.preg_replace('/[[:^print:]]/','',InstaUser()->full_name) }}!

        </div>
    </div>
@endsection
