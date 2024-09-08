@extends('layouts.app')
@section('content')

<div class="container my-5">
  @if (count($pastes) > 0)
    <h3 class="text-center">Paste pubblici</h3>
  @endif
  @include('partials.card')
</div>

@endsection
