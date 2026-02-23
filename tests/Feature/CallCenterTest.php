<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CallAssignment;

class CallCenterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure the call center form is accessible.
     */
    public function test_call_center_form_can_be_viewed()
    {
        $response = $this->get(route('wedding.call-center'));
        $response->assertStatus(200);
        $response->assertSee('Enter your phone number');
    }

    /**
     * Submitting a valid phone returns assignments.
     */
    public function test_posting_phone_shows_assignments()
    {
        $assignment = CallAssignment::create([
            'caller_phone' => '+15551234567',
            'contact_name' => 'Alice',
            'contact_phone' => '555-0001',
        ]);

        $response = $this->post(route('wedding.call-center'), [
            'phone' => '+15551234567',
        ]);

        $response->assertStatus(200);
        $response->assertSee('Alice');
        $response->assertSee('555-0001');
    }

    public function test_no_assignments_shows_warning()
    {
        $response = $this->post(route('wedding.call-center'), [
            'phone' => '000'
        ]);
        $response->assertStatus(200);
        $response->assertSee('No call assignments found');
    }
}
