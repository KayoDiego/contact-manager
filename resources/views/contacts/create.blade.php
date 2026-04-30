@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Add contact</h1>
        <form method="POST" action="{{ route('contacts.store') }}">
            @include('contacts._form', ['submitLabel' => 'Create'])
        </form>
    </div>
@endsection
