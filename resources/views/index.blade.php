@extends('layouts.master')


@auth
    @section('content')
        <div class="main-content mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-6">
                            <h4>All Posts by {{ auth()->user()->name }}</h4>
                        </div>
                        <div class="col col-md-6 d-flex justify-content-end">
                            <a class="btn btn-success" href="{{ route('posts.create') }}">Create</a>
                            <a class="btn btn-warning" href="">Trashed</a>
                        </div>
                    </div>
                </div>



                <div class="card-body">
                    <table class="table table-striped table-bordered border-dark">
                        <thead style="background: white">
                            <tr>
                                <th scope="col width: 5%">#</th>
                                <th scope="col" style="10%">Image</th>
                                <th scope="col" style="20%">Title</th>
                                <th scope="col" style="30%">Description</th>
                                <th scope="col" style="10%">Category</th>
                                <th scope="col" style="10%">Published Date</th>
                                <th scope="col" style="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="" width="80">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($post->created_at)) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
@else
    @php
        return redirect()->route('login');
    @endphp
@endauth
