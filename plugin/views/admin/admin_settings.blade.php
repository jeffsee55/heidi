@extends('admin.admin_layout')
@section('content')
    <h1>Hello</h1>
    <p>This is my body content.</p>
    <?php dd($user); ?>
    {{ $user->ID }}
@endsection
