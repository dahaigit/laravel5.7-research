@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($users as $user)
        {{ $user->name }}
    @endforeach

    {{ $users->links() }}

</div>

@endsection
