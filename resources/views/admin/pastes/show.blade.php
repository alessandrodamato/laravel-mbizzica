@extends('layouts.app')

@section('content')

<div class="container my-5 text-center">

  @if (!$paste->password || $password_correct)
  <h1 class="text-center mb-3">{{$paste->title}}</h1>

  <div>
    <img class="img-fluid w-50 mb-3"
      src="{{$paste->file ? asset('storage/' . $paste->file) : '/img/placeholder-img.jpg'}}">
  </div>

  <h3 class="mb-3"><strong>Visibilità: </strong>{{$paste->visibility}}</h3>

  @if ($paste->expiration_date)
  <h3 class="mb-3"><strong>Data di scadenza: </strong>{{$paste->expiration_date}}</h3>
  @endif

  @if (count($paste->tags) > 0)
  <h3 class="mb-3"><strong>Tag: </strong>
    @foreach ($paste->tags as $tag)
    <span class="badge text-bg-secondary">{{$tag->name}}</span>
    @endforeach
  </h3>
  @endif

  <p class="m-0" style="word-wrap: break-word; overflow-wrap: break-word">{{$paste->content}}</p>
  @else
  <form action="{{ route('pastes.show', $paste->id) }}" method="GET" class="w-50 mx-auto">
    @csrf
    <div class="mb-3">
      <label for="confirm" class="form-label">Inserisci password per visualizzare il contenuto:</label>
      <input type="password" class="form-control" id="confirm" name="confirm" value="{{ old('confirm') }}">
    </div>
    <button type="submit" class="btn btn-primary">Invia</button>
  </form>

  @if ($errors->has('confirm'))
  <div class="alert alert-danger mt-3 w-50 mx-auto">
    {{ $errors->first('confirm') }}
  </div>
  @endif
  @endif

</div>

@endsection
