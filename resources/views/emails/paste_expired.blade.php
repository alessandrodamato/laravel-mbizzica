@extends('layouts.email')

@section('content')
<h1>Il tuo paste è scaduto</h1>
<p>Il paste con il titolo <span class="highlight">{{ $paste->title }}</span> è scaduto in data <span
    class="highlight">{{ \Carbon\Carbon::parse($paste->expiration_date)->format('d/m/Y') }}</span></p>
<p><strong>Contenuto:</strong></p>
<p class="highlight">{{ $paste->content }}</p>
@endsection
