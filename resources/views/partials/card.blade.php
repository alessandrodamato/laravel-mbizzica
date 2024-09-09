<section class="main-wrapper">
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
              <p>{{ \Illuminate\Support\Str::limit($paste->content, 150) }}</p>
            </div>
            @if ($paste->id)
              <div class="card-read-more">
                <a href="{{route('pastes.show', $paste)}}" class="btn btn-link btn-block">Vai al dettaglio</a>
              </div>
            @endif
          </div>
        </div>
        @empty
        <h4 class="text-center">{{$message}}</h4>
        @endforelse
      </div>
    </div>
  </div>
</section>
