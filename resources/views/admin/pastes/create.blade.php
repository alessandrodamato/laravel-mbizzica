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

            <div class="col-12">
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input name="title" type="text" class="form-control" id="title"
                  placeholder="Aggiungi titolo" value="{{old('title', $paste?->title)}}">
              </div>
            </div>

            <div class="col-12">
              <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea name="content" class="form-control" id="content" rows="8">{{old('content', $paste?->content)}}</textarea>
              </div>
            </div>

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

            <div class="col-4">
              <div class="mb-3">
                <label for="expiration_date" class="form-label">Data di scadenza</label>
                <input name="expiration_date" type="date" class="form-control" id="expiration_date"
                value="{{old('expiration_date', $paste?->expiration_date)}}">
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control"
                  id="password" placeholder="Password" value="{{old('password', $paste?->password)}}">
              </div>
            </div>

            <div class="col-12">
              <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input name="file" type="file" class="form-control" id="file"
                  placeholder="file" value="{{old('file', $paste?->file)}}">
              </div>
            </div>

            <div class="col-12">
              <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <input name="tags" type="text" class="form-control" id="tag"
                  placeholder="Aggiungi uno o più tag separati da una virgola: es. Giallo,Verde" value="{{old('tag', $paste?->tag)}}">
              </div>
            </div>

            <div class="col-12">
              <div class="mb-3 float-end">
                <button type="submit" class="btn btn-primary ms-3">{{$btn}}</button>
              </div>
            </div>

          </div>

        </div>

      </form>

    </div>

  </div>

</div>

@endsection
