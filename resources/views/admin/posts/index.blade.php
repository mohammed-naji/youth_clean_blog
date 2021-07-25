@extends('admin.master')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Posts</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-dark text-white">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->image }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>


</div>
<!-- /.container-fluid -->
@stop
