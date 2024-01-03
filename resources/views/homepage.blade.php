@extends('layouts.app')

@section('content')
    <div class="main-content mt-5">
        {{-- @if (isset($keyword))
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


                            <div class="form form-group">
                                <label for="" class="form form-label">Description</label>
                                <textarea type="text" name="description" id="" cols="30" rows="10" class="form form-control"></textarea>
                            </div>

                            {{-- <div form form-group>
                                <label for="checkin">checkin</label>
                                <input type="date" id="checkin" name="checkin">
                                <label for="checkout">checkout:</label>
                                <input type="date" id="checkout" name="checkout">
                            </div> --}}


                            <form method="post" action="{{ route('comments.store', ['postId' => $post->id]) }}">
                                @csrf
                                <input type="text" name="impression" placeholder="Tambahkan komentar.">
                                <button type="submit">impresi</button>
                            </form>


                            <div class="comments mt-3">
                                <h6>Comments:</h6>
                                @foreach ($post->impressions as $impression)
                                    {{-- @php
                                        dd($impression->user);
                                    @endphp --}}
                                    <li>{{ $impression->user->name }} - {{ $impression->impression }} -
                                        {{ $impression->created_at->diffForHumans() }}</li>
                                @endforeach
                            </div>



                            <!-- Form untuk menambahkan komentar baru -->

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
