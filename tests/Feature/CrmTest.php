<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\User;


class CrmTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    

  /** @test */
    public function only_logged_in_users_can_see_data()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/all');
        $response->assertSuccessful();
    }
        
    /** @test */
    public function a_default_user_cannot_access_the_admin_section()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get('/apisedit')
            ->assertRedirect('home');
    }
    
    /** @test */
    public function an_admin_can_access_the_admin_api_section()
    {
        $admin = factory(User::class)
            ->states('admin')
            ->create();
        
        $this->actingAs($admin)
            ->get('/apisedit')
            ->assertStatus(200);
    }
}
