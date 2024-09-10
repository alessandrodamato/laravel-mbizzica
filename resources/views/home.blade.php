@extends('layouts.app')

@section('content')

<div class="container my-5">

  @if (count($pastes) > 0)
  <div class="d-flex align-items-center justify-content-between px-3">

    <div class="d-flex">
      <h3 class="text-center m-0 me-2">Paste pubblici</h3>
      @if (!Auth::id())
      <a href="{{route('noauth-pastes.create')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
      @endif
    </div>

    <form action="{{ route('search') }}" method="GET" class="d-flex">
      @csrf

      <input type="date" class="form-control me-2" placeholder="Data di scadenza" name="expiration_date"
        value="{{ request('expiration_date') }}">

      <input type="text" class="form-control me-2" placeholder="Titolo" name="title" value="{{ request('title') }}">

      <input type="text" class="form-control me-2" placeholder="Contenuto" name="content"
        value="{{ request('content') }}">

      <select class="form-select me-2 tag-select" name="tag">

        <option value="" {{ request('tag')=='' ? 'selected' : '' }}>Tag</option>

        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" {{ request('tag')==$tag->id ? 'selected' : '' }}>
          {{ $tag->name }}
        </option>
        @endforeach

      </select>

      <button type="submit" class="btn btn-outline-secondary">Cerca</button>

    </form>

  </div>
  @endif

  @if($pastes->isEmpty())
  <div class="alert alert-secondary mt-3">{{ $message }}</div>
  @else
  @include('partials.card')
  @endif

</div>

@endsection
