@extends('layouts.app')

@section('content')

<div class="container my-5 text-center">

  {{-- se non c'è la password o arriva corretta mostro il paste --}}
  @if (!$paste->password || $password_correct)

  {{-- paste --}}
  <h1 class="text-center mb-3">{{$paste->title}}</h1>

  <div>
    <img class="img-fluid w-50 mb-3"
      src="{{$paste->file ? asset('storage/' . $paste->file) : '/img/placeholder-img.jpg'}}">
  </div>

  <h3 class="mb-3"><strong>Visibilità: </strong>{{$paste->visibility}}</h3>

  @if ($paste->expiration_date)
  <h3 class="mb-3"><strong>Data di scadenza: </strong>{{ \Carbon\Carbon::parse($paste->expiration_date)->format('d/m/Y') }}</h3>
  @endif

  @if (count($paste->tags) > 0)
  <h3 class="mb-3"><strong>Tag: </strong>
    @foreach ($paste->tags as $tag)
    <span class="badge text-bg-secondary">{{$tag->name}}</span>
    @endforeach
  </h3>
  @endif

  <p class="w-75 mx-auto mb-3" style="word-wrap: break-word; overflow-wrap: break-word">{{$paste->content}}</p>
  {{-- /paste --}}

  {{-- voti --}}
  @auth
  <form class="w-50 mx-auto d-flex justify-content-end mb-5" method="POST" action="{{ route('votes.handle', $paste->id) }}">
    @csrf
    <button class="btn btn-sm btn-success" type="submit" name="vote" value="1">
      {!! $vote == 1 ? '<i class="fa-solid fa-thumbs-up"></i>' : '<i class="fa-regular fa-thumbs-up"></i>' !!} {{$n_upvotes}}
    </button>
    <button class="btn btn-sm btn-danger ms-2" type="submit" name="vote" value="-1">
      {!! $vote == -1 ? '<i class="fa-solid fa-thumbs-down"></i>' : '<i class="fa-regular fa-thumbs-down"></i>' !!} {{$n_downvotes}}
    </button>
  </form>
  @endauth
  {{-- /voti --}}

  {{-- se sono autenticato posso commentare --}}
  @auth
  <div class="mb-5 w-50 mx-auto">
    <h3>Aggiungi un commento</h3>
    <form action="{{ route('comments.store') }}" method="POST">
      @csrf
      <input type="hidden" name="paste_id" value="{{ $paste->id }}">
      <div class="mb-3">
        <textarea class="form-control" id="text" name="text" rows="4">{{ old('text') }}</textarea>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-secondary">Pubblica</button>
      </div>
    </form>
  </div>
  @endauth

  {{-- oppure chiedo di accedere  --}}
  @guest
    <h6 class="mb-3">Vuoi pubblicare un commento? <a href="{{route('login')}}" class="text-secondary">Accedi</a></h6>
  @endguest

  {{-- commenti --}}
  @if (count($comments) > 0)
    @if(count($comments) !== 1) <h4>{{count($comments)}} commenti</h4> @else <h4>1 commento</h1> @endif
  @endif

  @forelse ($comments as $comment)
  <div class="comment border border-dark-subtle mb-3 p-3 rounded-2 w-50 mx-auto">
    <div class="fw-bold text-start">{{$comment->user->name}}: </div>
    <p class="m-0 text-start" style="word-wrap: break-word; overflow-wrap: break-word">{{$comment->text}}</p>
  </div>
  @empty
  <h4>0 commenti</h4>
  @endforelse
  {{-- /commenti --}}

  {{-- altrimenti chiedo la password  --}}
  @else
  <form action="{{ route('pastes.show', $paste->id) }}" method="GET" class="w-50 mx-auto">
    @csrf
    <div class="mb-3">
      <label for="confirm" class="form-label">Inserisci password per visualizzare il contenuto:</label>
      <input type="password" class="form-control" id="confirm" name="confirm">
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
