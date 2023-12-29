@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        @if(isset($keyword))
            <h2>Search Results for "{{ $keyword }}"</h2>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered border-dark">
                    <thead style="background: white">
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col" style="width: 10%">Author</th>
                            <th scope="col" style="width: 10%">Image</th>
                            <th scope="col" style="width: 20%">Title</th>
                            <th scope="col" style="width: 30%">Description</th>
                            <th scope="col" style="width: 10%">Category</th>
                            <th scope="col" style="width: 10%">Published Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="" width="80">
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->description }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($post->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection