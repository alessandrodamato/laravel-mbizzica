@extends('layouts.app')

@section('content')

<div class="container py-5 text-center">

  <h1 class="mb-3"> Crea un nuovo paste</h1>

  <div class="row">

    @if($errors->any())
    <div class="col-6 offset-3">
      <div class="alert alert-danger text-start" role="alert">
        <ul class="m-0">
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    <div class="col-6 offset-3">

      <form action="{{$route}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)

        <div class="container-fluid">

          <div class="row">

            <!-- Campo del titolo -->
            <div class="col-12">
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Aggiungi titolo"
                  value="{{old('title')}}">
              </div>
            </div>

            <!-- Campo del contenuto -->
            <div class="col-12">
              <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea name="content" class="form-control" id="content"
                  rows="8">{{old('content')}}</textarea>
              </div>
            </div>

            <!-- Campo della visibilità -->
            <div class="col-4">
              <div class="mb-3">
                <label for="visibility" class="form-label">Visibilità</label>
                <select class="form-select" name="visibility" id="visibility">
                  <option value="1">Pubblico</option>
                  <option value="2">Privato</option>
                  <option value="3">Non in elenco</option>
                </select>
              </div>
            </div>

            <!-- Campo della data di scadenza -->
            <div class="col-4">
              <div class="mb-3">
                <label for="expiration_date" class="form-label">Data di scadenza</label>
                <input name="expiration_date" type="date" class="form-control" id="expiration_date"
                  value="{{old('expiration_date')}}">
              </div>
            </div>

            <!-- Campo della password -->
            <div class="col-4">
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password"
                  value="{{old('password')}}">
              </div>
            </div>

            <!-- Campo del file -->
            <div class="col-12">
              <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input name="file" type="file" class="form-control" id="file" placeholder="file"
                  value="{{old('file')}}">
              </div>
            </div>

            <!-- Campo dei tag -->
            <div class="col-12">
              <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <input name="tags" type="text" class="form-control" id="tag"
                  placeholder="Aggiungi uno o più tag separati da una virgola: es. Giallo,Verde"
                  value="{{old('tag')}}">
              </div>
            </div>

            <!-- Campo reCAPTCHA -->
            <div class="col-6 mb-3">
              <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
            </div>

            <!-- Pulsante di invio -->
            <div class="col-6">
              <div class="float-end mt-3">
                <button type="submit" class="btn btn-primary ms-3">{{$btn}}</button>
              </div>
            </div>

          </div>

        </div>

      </form>

    </div>

  </div>

</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
