@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row">
            <h1>Contact details</h1>
            <div class="actions">
                <a class="btn" href="{{ route('contacts.edit', $contact) }}">Edit</a>
                <form method="POST" action="{{ route('contacts.destroy', $contact) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

        <p><strong>ID:</strong> {{ $contact->id }}</p>
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Contact:</strong> {{ $contact->contact }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
    </div>
@endsection
