@extends('layouts.app')

@auth
@section('content')
<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <h4>Edit Posts</h4>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <a class="btn btn-success" href="/posts">Kembali</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <img style="width: 200px" src="{{ asset('storage/'. $post->image) }}" alt="">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title" class="form-label">Judul</label>
                    <input value="{{ $post->title }}" type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category" class="form-label">Kategori</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">Pilih</option>
                        @foreach ($categories as $category)
                            <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $post->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="keywords" class="form-label">Kata Kunci</label>
                    <input type="text" class="form-control" name="keywords">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@else
<script>
    window.location.href = "{{ route('login') }}";
</script>
@endauth
