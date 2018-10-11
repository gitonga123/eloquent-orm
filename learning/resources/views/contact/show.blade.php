@extends('welcome')
@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{ $contact->name }}
        </div>

        <div class="links">
            <p>{{ $contact->email }}</p>
            <p>{{ $contact->message }}</p>
            <p>{{ $contact->created_at }}</p>
            <p>{{ $contact->update_at }}</p>
        </div>
    </div>
@endsection