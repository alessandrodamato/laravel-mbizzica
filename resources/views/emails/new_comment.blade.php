@extends('layouts.email')

@section('content')
<h1>Nuovo commento sul tuo paste</h1>
<p class="mb-3">{{$comment->user->name}} ha lasciato un nuovo commento sul paste intitolato <span class="highlight">{{ $comment->paste->title }}</span></p>
<p><strong>Contenuto del Commento:</strong></p>
<p class="highlight">{{ $comment->text }}</p>
@endsection
