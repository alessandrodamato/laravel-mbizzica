@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-6">

      <h2 class="fs-4 text-secondary my-4">Autenticazione a due fattori</h2>

      <div class="mb-4 text-muted">
        <p>Ti abbiamo inviato un codice via email.</p>
        <span>Non hai ricevuto il codice? Clicca </span>
        <a class="text-secondary" href="{{ route('verify.resend') }}">qui</a>
      </div>

      <form method="POST" action="{{ route('verify.store') }}">
        @csrf
        <div class="mb-3">
          <label for="two_factor_code" class="form-label">Codice 2FA</label>
          <input id="two_factor_code" class="form-control" type="text" name="two_factor_code" required autofocus>

          @if ($errors->has('two_factor_code'))
          <div class="text-danger mt-2">
            {{ $errors->first('two_factor_code') }}
          </div>
          @endif
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-secondary">
            Invia
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection
