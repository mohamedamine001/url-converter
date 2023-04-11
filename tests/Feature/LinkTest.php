<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Models\Link;
use App\Models\User;

class LinkTest extends TestCase
{
    /**
     * Test add link.
     *
     * @return void
     */
    public function test_add_link()
    {
        $user = User::factory()->create(['role' => 'user']); 
        $response = $this->actingAs($user)->post('/dashboard/links', [
            'original' => 'http://www.test.com',
        ]);
        $response->assertStatus(302)->assertRedirect('/dashboard/links');
        $this->followRedirects($response)->assertSeeText('Short link created successfully');
    }

    /**
     * Test exceed links limit.
     *
     * @return void
     */
    public function test_exceed_links_limit()
    {
        $user = User::factory()->hasLinks(5)->create( ['role' => 'user']);

        $response = $this->actingAs($user)->post('/dashboard/links', [
            'source' => 'http://www.test.com',
        ]);
        $response->assertStatus(403);
    }
    
    /**
     * Test destroy link.
     *
     * @return void
     */
    public function test_destroy_link()
    {
        $user = User::factory()->hasLinks()->create(
            [
                'role' => 'user'
            ]
        );
        $response = $this->actingAs($user)->delete('/dashboard/links/' . $user->links->first()->id);
        $response->assertStatus(302)->assertRedirect('/dashboard/links');
        $this->followRedirects($response)->assertSeeText('Short link deleted successfully');
    }

    /**
     * Test delete other user's link.
     *
     * @return void
     */
    public function test_delete_other_user_link()
    {
        $userOwner = User::factory()->hasLinks()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($otherUser)->delete('/dashboard/links/' . $userOwner->links->first()->id);
        $response->assertStatus(403);
    }

}
