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
                            <p><strong>Published Date:</strong> {{ date('d-m-Y', strtotime($post->created_at)) }}</p>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p><strong>Author:</strong> {{ $post->user->name }}</p>
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            <p class="card-text">{{ $post->description }}</p>

                            <!-- Form untuk menambahkan komentar baru -->
                            <form method="post" action="{{ route('comments.store', ['postId' => $post->id]) }}">
                                @csrf
                                <div class="form form-group">
                                    <label for="description" class="form form-label">Deskripsi</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form form-control" placeholder="Tambahkan deskripsi"></textarea>
                                </div>

                                <div class="form form-group">
                                    <label for="days" class="form form-label">Durasi Menginap (malam)</label>
                                    <input type="number" name="days" id="days" min="1" placeholder="Jumlah malam">
                                </div>

                                <div class="form form-group">
                                    <label for="start" class="form form-label">Bulan dan Tahun Mulai</label>
                                    <input type="month" id="start" name="start" min="2018-03" value="2018-05" />
                                </div>

                                <div class="form form-group">
                                    <label for="impression" class="form form-label">Tambahkan komentar</label>
                                    <input type="text" name="impression" id="impression" class="form form-control" placeholder="Tambahkan komentar">
                                </div>

                                <button type="submit" class="btn btn-primary">Tambahkan Komentar</button>
                            </form>

                            <div class="comments mt-3">
                                <h6>Komentar:</h6>
                                @foreach ($post->impressions as $impression)
                                    <li>{{ $impression->user->name }} - {{ $impression->impression }} - {{ $impression->created_at->diffForHumans() }}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
