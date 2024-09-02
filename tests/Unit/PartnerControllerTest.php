<?php

namespace Tests\Unit;

use App\Models\Partner;
use App\Models\User;
use Database\Factories\PartnerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PartnerControllerTest extends TestCase
{
    private $user;
    private $partner;

    public function setpUp(): void
    {
        $this->user = User::find('email', 'test@email.com');
        $this->actingAs($this->user);
        Sanctum::actingAs($this->user);
    }

    public function setUpAsAdmin(): void
    {
        $this->user = User::where('is_admin', 1)->first();
        $this->actingAs($this->user);
        Sanctum::actingAs($this->user);
    }

    public function setUpPartner(): void
    {
        // check if test partner already exists
        $this->partner = Partner::where('email', 'info@acme.com')->first();
        if (!$this->partner) {
            $this->partner = Partner::create([
                'name' => 'Acme Inc.',
                'address' => '123 Main St.',
                'email' => 'info@acme.com',
            ]);
        }
    }
    public function removePartner(): void
    {
        $this->partner = Partner::where('email', 'info@acme.com')->delete();
    }

    public function test_can_get_partners_without_auth(): void
    {
        $response = $this->getJson('/api/partners');
        $response->assertStatus(401);
    }

    // get all partners test without auth
    public function test_can_get_partners_by_id_without_auth(): void
    {
        $response = $this->getJson('/api/partners/' . '1');
        $response->assertStatus(401);
    }

    // get partner by id test without auth
    public function test_can_get_partners_with_no_auth(): void
    {
        $response = $this->getJson('/api/partners');
        $response->assertStatus(401);
    }

    // create partner test without auth
    public function test_can_create_partners_without_auth(): void
    {
        $response = $this->postJson('/api/partners', []);
        $response->assertStatus(401);
    }

    // update partner test without auth
    public function test_can_update_partners_without_auth(): void
    {
        $response = $this->putJson('/api/partners/' . '1', []);
        $response->assertStatus(401);
    }

    // delete partner test without auth
    public function test_can_delete_partners_without_auth(): void
    {
        $response = $this->deleteJson('/api/partners/' . '1');
        $response->assertStatus(401);
    }

    // create partner test with auth
    public function test_can_create_partners(): void
    {
        $this->setUpAsAdmin();
        // Assert unprocessable when required fields are missing
        $response = $this->postJson('/api/partners', [
            'name' => '',
            'email' => '',
            'address' => '123, Test St.',
        ]);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name', 'email']);

        // Assert created when all required fields are present
        $response = $this->postJson('/api/partners', [
            'name' => 'testing',
            'email' => 'testing@email.com',
            'address' => '123, Test St.',
        ]);
        $response->assertStatus(201);
        $this->partner = Partner::where('email', 'testing@email.com')->first()->delete();
    }


    // get all partners test with auth
    public function test_can_get_partners(): void
    {
        $this->setUpAsAdmin();
        $this->setUpPartner();
        $response = $this->getJson('/api/partners');
        $response->assertStatus(200);
        $response->assertJsonIsArray();
        $response->assertJsonFragment([
            'name' => 'Acme Inc.',
            'address' => '123 Main St.',
            'email' => 'info@acme.com',
        ]);
        $this->removePartner();
    }

    // get partner by id test with auth
    public function test_can_get_partners_by_id(): void
    {
        $this->setUpAsAdmin();
        $this->setUpPartner();
        $response = $this->getJson('/api/partners/' . $this->partner->id);
        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Acme Inc.',
                'address' => '123 Main St.',
                'email' => 'info@acme.com',
            ]);
        $this->removePartner();
    }


    // update partner test with auth
    public function test_can_update_partners(): void
    {
        $this->setUpAsAdmin();
        $this->setUpPartner();
        $response = $this->putJson('/api/partners/' . $this->partner->id, [
            'name' => 'test updated',
        ]);
        $response->assertStatus(200)->assertJson([
            'name' => 'test updated',
            'email' => 'info@acme.com',
            'address' => '123 Main St.',
        ]);
        $this->removePartner();
    }

    // delete partner test with auth
    public function test_can_delete_partners(): void
    {
        $this->setUpAsAdmin();
        $this->setUpPartner();
        $response = $this->deleteJson('/api/partners/' . $this->partner->id);
        $response->assertStatus(204);
    }
}
