<?php

namespace Tests\Feature;

use App\Models\Contribution;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContributionTest extends TestCase
{
    use RefreshDatabase;

    protected function createTreasurer()
    {
        return User::factory()->create(['role' => 'treasurer']);
    }

    protected function createRegularUser()
    {
        return User::factory()->create(['role' => 'user']);
    }

    public function test_non_authenticated_redirected_to_login()
    {
        $response = $this->get(route('contributions.index'));
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_contributions()
    {
        $user = $this->createRegularUser();
        Contribution::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('contributions.index'));
        $response->assertStatus(200);
        $response->assertSee('Wedding Contributions');
    }

    public function test_treasurer_can_create_update_and_delete()
    {
        $treasurer = $this->createTreasurer();

        // creation is handled via modal; we just POST directly below

        // store
        $data = [
            'amount' => 1000,
            'payment_method' => 'cash',
            'payment_status' => 'completed',
            'description' => 'test',
        ];
        $this->actingAs($treasurer)->post(route('contributions.store'), $data)
            ->assertRedirect(route('contributions.index'));

        $contribution = Contribution::first();
        $this->assertEquals(1000, $contribution->amount);

        // update
        $this->actingAs($treasurer)->put(route('contributions.update', $contribution), [
            'amount' => 2000,
            'payment_method' => 'card',
            'payment_status' => 'pending',
            'description' => 'updated',
        ])->assertRedirect(route('contributions.index'));

        $contribution->refresh();
        $this->assertEquals('pending', $contribution->payment_status);

        // delete
        $this->actingAs($treasurer)->delete(route('contributions.destroy', $contribution))
            ->assertRedirect(route('contributions.index'));
        $this->assertCount(0, Contribution::all());
    }

    public function test_non_treasurer_cannot_access_management_routes()
    {
        $user = $this->createRegularUser();
        $contribution = Contribution::factory()->create();

        $this->actingAs($user)
            ->post(route('contributions.store'), [])
            ->assertStatus(403);

        $this->actingAs($user)
            ->put(route('contributions.update', $contribution), [])
            ->assertStatus(403);

        $this->actingAs($user)
            ->put(route('contributions.update', $contribution), [])
            ->assertStatus(403);

        $this->actingAs($user)
            ->delete(route('contributions.destroy', $contribution))
            ->assertStatus(403);
    }
}
