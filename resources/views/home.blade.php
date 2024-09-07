@extends('layouts.app')
@section('content')

<div class="container my-5">
  <section class="wrapper">
    <div class="container-ad">
      <h3 class="text-center">Paste pubblici</h3>
      <div class="content">
        <div class="container">
          <div class="row">

            @forelse ($pastes as $paste)
            <div class="col-xs-12 col-md-6 col-lg-4 d-flex flex-column p-0">
              <div class="card m-3">
                <div class="img-card">
                  <img src="{{$paste->file ? asset('storage/' . $paste->file) : '/img/placeholder-img.jpg'}}" />
                </div>
                <div class="card-content">
                  <h4 class="card-title">{!! $paste->title ? $paste->title : '&nbsp;' !!}</h4>
                  <p>{{$paste->content}}</p>
                </div>
                <div class="card-read-more">
                  <a href="" class="btn btn-link btn-block">Vai al dettaglio</a>
                </div>
              </div>
            </div>
            @empty
            <h3>Non ci sono paste pubblici</h3>
            @endforelse
          </div>
        </div>
      </div>
  </section>
</div>

@endsection
