<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NoteTest extends TestCase
{
    
    #[Test]
    public function it_can_list_notes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/api/notes');

        $response->assertStatus(200);
        $response->assertJson([$note->toArray()]);
    }

    #[Test]
    public function it_can_store_a_note()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => 'Test Note',
            'description' => 'This is a test note.',
        ];

        $response = $this->post('/api/notes', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('notes', $data + ['user_id' => $user->id]);
    }

    #[Test]
    public function it_can_show_a_note()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/api/notes/' . $note->id);

        $response->assertStatus(200);
        $response->assertJson($note->toArray());
    }

    #[Test]
    public function it_can_update_a_note()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $note = Note::factory()->create(['user_id' => $user->id]);

        $data = [
            'title' => 'Updated Note',
            'description' => 'This is an updated test note.',
        ];

        $response = $this->put('/api/notes/' . $note->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', $data + ['id' => $note->id]);
    }

    #[Test]
    public function it_can_delete_a_note()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->delete('/api/notes/' . $note->id);

        $response->assertStatus(204);
        $this->assertDeleted($note);
    }
}
