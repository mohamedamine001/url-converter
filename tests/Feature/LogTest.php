<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class LogTest extends TestCase
{
    /**
     * Test dashboard access as admin.
     *
     * @return void
     */
    public function test_admin_dashboard_access()
    {
        $user = User::factory()->create(['role' => 'admin']); 
        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
    }
}
