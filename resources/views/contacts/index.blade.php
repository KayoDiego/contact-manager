@extends('layouts.app')

@section('content')
    <div class="card row">
        <h1>Contacts</h1>
        @auth
            <a class="btn btn-primary" href="{{ route('contacts.create') }}">Add contact</a>
        @endauth
    </div>

    @forelse($contacts as $contact)
        <div class="card row">
            <div>
                <strong>{{ $contact->name }}</strong><br>
                {{ $contact->contact }} | {{ $contact->email }}
            </div>
            <div class="actions">
                @auth
                    <a class="btn" href="{{ route('contacts.show', $contact) }}">Details</a>
                    <a class="btn" href="{{ route('contacts.edit', $contact) }}">Edit</a>
                    <form method="POST" action="{{ route('contacts.destroy', $contact) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endauth
            </div>
        </div>
    @empty
        <div class="card">No contacts found.</div>
    @endforelse
@endsection
