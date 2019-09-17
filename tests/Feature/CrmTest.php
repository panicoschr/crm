<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CrmTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
 

  /** @test */
    public function only_logged_in_users_can_see_employees()
    {
        $response = $this->get('/employees');
        $response->assertRedirect('/login');
    }
    
     /** @test */ 
        public function only_logged_in_users_can_see_companies()
    {
        $response = $this->get('/companies');
        $response->assertRedirect('/login');
    }
    

    

}
