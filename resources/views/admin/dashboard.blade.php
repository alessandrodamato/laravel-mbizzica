@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Hai {{ $n_pastes }} paste</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h6 class="mb-0"><a href="{{route('pastes.index')}}" class="text-decoration-none text-black">I tuoi paste</a></h6>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
