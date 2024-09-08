@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="d-flex align-items-center justify-content-center">
    <h1 class="me-3">I tuoi paste</h1>
    <a href="{{route('pastes.create')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
  </div>
  @include('partials.card')
</div>
@endsection
