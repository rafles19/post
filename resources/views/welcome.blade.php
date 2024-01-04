
@extends('layouts.app')

@section('content')


{{-- @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Published Date:</strong> {{ date('d-m-Y', strtotime($post->created_at)) }}</p>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p><strong>Author:</strong> {{ $post->user->name }}</p>
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            <p class="card-text">{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
@endforeach --}}




<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>


@endsection
