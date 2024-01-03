@extends('layouts.app')

@section('content')
    <div class="main-content mt-5">
        {{-- @if(isset($keyword))
            <h2>Hasil Pencarian untuk "{{ $keyword }}"</h2>
        @endif --}}

        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/thumbnail/' . $post->thumbnail_image) }}" alt="{{ $post->title }}">

                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p><strong>Author:</strong> {{ $post->user->name }}</p>
                            <p class="card-text">{{ $post->description }}</p>
                            <p><strong>Category:</strong> {{ $post->category->name }}</p>
                            <p><strong>Published Date:</strong> {{ date('d-m-Y', strtotime($post->created_at)) }}</p>
                            
                            <form action="{{ route('comments.store', $post->id) }}" method="post">
                                @csrf
                                <div class="comment-section">
                                    <input type="text" name="impression" class="form-control" placeholder="Your comment">
                                    <button type="submit" class="btn btn-success">Comment</button>
                                </div>
                            </form>

                            <div class="comments mt-3">
                                <h6>Comments:</h6>
                                @if ($comments)
                                    @foreach ($comments as $comment)
                                        <p>{{ $comment }}</p>
                                    @endforeach
                                @else
                                    <p>No comments yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
