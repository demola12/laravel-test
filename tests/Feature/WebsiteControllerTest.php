<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Website;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class WebsiteControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function admin_can_delete_website()
    {
        // Create a user with the admin role
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Create a website
        $token  = Auth::login($admin);
        // Create a website
        $website = Website::factory()->create();
        Log::info( $token );
        // Acting as user
        $response = $this->actingAs($admin, 'api')->withHeader('Authorization', 'Bearer ' . $token)->deleteJson('/api/websites/' . $website->id);
       
        $response->assertStatus(200);
    }

    /** @test */
    public function non_admin_cannot_delete_website()
    {
        // Create a user with the user role
        $user = User::factory()->create();
        $user->assignRole('user');
        $token  = Auth::login($user);
        // Create a website
        $website = Website::factory()->create();

        // Acting as user
        $response = $this->actingAs($user, 'api')->withHeader('Authorization', 'Bearer ' . $token)->deleteJson('/api/websites/' . $website->id);
       
        $response->assertStatus(403);
    }
}
