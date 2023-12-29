@extends('layouts.master')



@auth
@section('content')


<div class="main-content mt-5">

    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <h4>Create Posts</h4>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <a class="btn btn-success" href="/posts">Back</a>
                </div>
            </div>
        </div>

       
    
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form form-group">
                    <label for="" class="form form-label">Image</label>
                    <input type="file" class="form form-control" name="image">
                </div>
                <div class="form form-group">
                    <label for="" class="form form-label">Title</label>
                    <input type="text" class="form form-control" name="title">
                </div>
                <div class="form form-group">
                    <label for="" class="form form-label">Category</label>
                    <select class="form form-control" name="category_id">
                        <option value="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form form-group">
                    <label for="" class="form form-label">Description</label>
                    <textarea type="text" name="description" id="" cols="30" rows="10" class="form form-control"></textarea>
                </div>
                <div class="form form-group">
                    <label for="" class="form form-label">keywords</label>
                    <input type="text" class="form form-control" name="keywords">
                </div>
                <div class="form form-group">
                    <button class="btn btn-primary">Submit</button>
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
