<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_validates_contact_fields(): void
    {
        $user = User::factory()->create();
        Contact::query()->create([
            'name' => 'Existing User',
            'contact' => '999999999',
            'email' => 'existing@example.com',
        ]);

        $response = $this->actingAs($user)->post(route('contacts.store'), [
            'name' => 'Ana',
            'contact' => '123',
            'email' => 'existing@example.com',
        ]);

        $response->assertSessionHasErrors(['name', 'contact', 'email']);
    }

    public function test_update_validates_contact_fields_and_ignores_current_record_uniqueness(): void
    {
        $user = User::factory()->create();
        $contact = Contact::query()->create([
            'name' => 'Contact One',
            'contact' => '111111111',
            'email' => 'one@example.com',
        ]);
        Contact::query()->create([
            'name' => 'Contact Two',
            'contact' => '222222222',
            'email' => 'two@example.com',
        ]);

        $response = $this->actingAs($user)->put(route('contacts.update', $contact), [
            'name' => 'abc',
            'contact' => '222222222',
            'email' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['name', 'contact', 'email']);
    }

    public function test_store_allows_reusing_contact_and_email_from_soft_deleted_record(): void
    {
        $user = User::factory()->create();
        $contact = Contact::query()->create([
            'name' => 'Soft Deleted',
            'contact' => '333333333',
            'email' => 'deleted@example.com',
        ]);
        $contact->delete();

        $response = $this->actingAs($user)->post(route('contacts.store'), [
            'name' => 'New Active Contact',
            'contact' => '333333333',
            'email' => 'deleted@example.com',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('contacts', [
            'name' => 'New Active Contact',
            'contact' => '333333333',
            'email' => 'deleted@example.com',
            'deleted_at' => null,
        ]);
    }
}
