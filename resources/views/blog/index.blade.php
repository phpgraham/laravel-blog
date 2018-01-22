@extends('layouts.app')

@section('content')
<div class="container">

  <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">{{ $featured->title }}</h1>
      <p class="lead my-3">{{ str_limit($featured->content,100) }}</p>
      <p class="lead mb-0"><a href="{{ $featured->path() }}" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
  </div>

  <div class="row mb-2">

    @foreach ($pages as $page)
    <div class="col-md-6">
        <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">blog category</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="{{ $page->path() }}">{{ str_limit($page->title, 20, '') }}</a>
              </h3>
              <div class="mb-1 text-muted">{{ $page->updated_at->toFormattedDateString() }}</div>
              <p class="card-text mb-auto">{{ str_limit($page->content,100) }}</p>
              <a href="{{ $page->path() }}">Continue reading</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=industrial" alt="Card image cap">
          </div>
    </div>
    @endforeach

  </div>

</div>
@endsection
