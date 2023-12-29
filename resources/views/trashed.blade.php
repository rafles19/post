@extends('layouts.master')

@section('content')


<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <h4>Trashed Posts</h4>
                </div>
                <div class="col col-md-6 d-flex justify-content-end">
                    <a class="btn btn-success" href="">Back</a>
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
                  <tr>
                    <th scope="row">1</th>
                    <td>
                        <img src="https://picsum.photos/200" alt="" width="80">
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ipsa quas molestiae odit velit mollitia doloribus aperiam? Corporis, nesciunt optio. Repudiandae praesentium natus veniam earum rerum enim unde aut officiis!</td>
                    <td>News</td>
                    <td>2-5-23</td>
                    <td>
                        <a class="btn btn-sm btn-primary">Edit</a>
                        <a class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>




@endsection