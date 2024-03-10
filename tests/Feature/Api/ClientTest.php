<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Faker\Factory;
use Tests\Feature\Trait\Utils;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use Utils;

    public function testExample(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testFailCreateClient(): void
    {
        $response = $this->postJson('/api/v1/clients', []);

        $response->assertStatus(422);
    }

    public function testCreateClient(): void
    {
        $faker = Factory::create();

        $fakeImage = $this->createFakeImage($faker);

        $response = $this->postJson('/api/v1/clients', [
            'name' => 'Name Test',
            'social_name' => 'Name Social Test',
            'birth_date' => '2000-01-01',
            'cpf' => '70457898372',
            'photo' => $fakeImage,
        ]);

        $response->assertStatus(201);
    }

    public function testFailNotFoundGetClient(): void
    {
        $nonExistentClientId = -1;

        $response = $this->getJson("/api/v1/clients/$nonExistentClientId");

        $response->assertStatus(404);
    }

    public function testGetClient(): void
    {
        $client = Client::factory()->create();

        $response = $this->getJson("/api/v1/clients/{$client->id}");

        $response->assertStatus(200);
    }

    public function testGetAllClient(): void
    {
        Client::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/clients');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    public function testFailNotFoundUpdateClient(): void
    {
        Client::factory()->create();

        $faker = Factory::create();
        $fakeImage = $this->createFakeImage($faker);

        $nonExistentClientId = -1;

        $newData = [
            'name' => 'Name Test',
            'social_name' => 'Name Social Test',
            'birth_date' => '2000-01-01',
            'cpf' => '70457898372',
            'photo' => $fakeImage,
        ];

        $response = $this->putJson("/api/v1/clients/{$nonExistentClientId}", $newData);

        $response->assertStatus(404);
    }

    public function testUpdateClient(): void
    {
        $client = Client::factory()->create();

        $faker = Factory::create();
        $fakeImage = $this->createFakeImage($faker);

        $newData = [
            'name' => 'Name Test',
            'social_name' => 'Name Social Test',
            'birth_date' => '2000-01-01',
            'cpf' => '70457898372',
            'photo' => $fakeImage,
        ];

        $response = $this->putJson("/api/v1/clients/{$client->id}", $newData);

        $response->assertStatus(200);
    }

    public function testFailNotFoundDestroyClient(): void
    {
        $nonExistentProductId = -1;

        $response = $this->deleteJson("/api/v1/clients/{$nonExistentProductId}", []);

        $response->assertStatus(404);
    }

    public function testDestroyClient(): void
    {
        $client = Client::factory()->create();

        $response = $this->deleteJson("/api/v1/clients/{$client->id}", []);

        $response->assertStatus(200);
    }
}
