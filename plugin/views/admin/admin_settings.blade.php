@extends('admin.admin_layout')
@section('content')
    <h1>Hello</h1>
    <p>This is my body content.</p>
    {{ $post->title() }}
    {{ $post->get_preview() }}
@endsection
