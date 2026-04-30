@csrf
<div class="field">
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $contact->name ?? '') }}" required>
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="contact">Contact (9 digits)</label>
    <input id="contact" type="text" name="contact" value="{{ old('contact', $contact->contact ?? '') }}" required>
    @error('contact')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email', $contact->email ?? '') }}" required>
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<button class="btn btn-primary" type="submit">{{ $submitLabel }}</button>
