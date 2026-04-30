@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Edit contact</h1>
        <form method="POST" action="{{ route('contacts.update', $contact) }}">
            @method('PUT')
            @include('contacts._form', ['submitLabel' => 'Update'])
        </form>
    </div>
@endsection
