@extends('layouts.app')

@section('content')
<div class="container my-5 text-center">
  <h1 class="mb-3">I tuoi pastes</h1>
  <a href="{{route('pastes.create')}}" class="btn btn-success">Crea un nuovo paste</a>
</div>
@endsection
