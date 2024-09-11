@extends('layouts.email')

@section('content')
<h1>Il tuo codice di autenticazione a due fattori</h1>

<p>Il codice di autenticazione a due fattori che hai richiesto è: <span class="highlight">{{ $two_factor_code }}</span>
</p>

<p>Il codice è valido fino al <span class="highlight">{{ \Carbon\Carbon::parse($two_factor_expires_at)->format('d/m/Y') }} alle ore {{
\Carbon\Carbon::parse($two_factor_expires_at)->format('H:i') }}</span></p>

<p>Se non sei stato tu a richiedere il codice, ignora questa email.</p>

<p>Il team di {{ config('app.name') }}</p>
@endsection
