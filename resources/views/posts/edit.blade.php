@extends('admin')

@section('content')
    <div >
        <h3>Edit Post</h3>
        <a href="{{ route('admin.post.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('posts/postForm', ['post' => $post])
    </div>
@endsection