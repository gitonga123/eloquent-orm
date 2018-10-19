<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBlogResponseIsValid()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }
}
