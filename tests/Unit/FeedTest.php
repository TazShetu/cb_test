<?php

namespace Tests\Unit;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class FeedTest extends TestCase
{

    public function test_seeding()
    {
        $users = User::count();
        $posts = Post::count();
        $pages = Page::count();
        $this->assertEquals(4, $users);
        $this->assertEquals(4, $posts);
        $this->assertEquals(3, $pages);
    }

    public function test_user_relation_seed()
    {
        $user2 = User::findOrFail(2);
        $followUsers = $user2->followUsers()->get();
        $this->assertEquals(1, count($followUsers));
        $this->assertEquals(1, $followUsers[0]->id);
    }

    public function test_post_seed()
    {
        $totalPost = Post::count();
        $user1Post = Post::where('creator_id', 1)->count();
        $page3Post = Post::where('page_id', 3)->count();
        $this->assertEquals(4, $totalPost);
        $this->assertEquals(1, $user1Post);
        $this->assertEquals(1, $page3Post);
    }


    public function test_page_seed()
    {
        $totalPage = Page::count();
        $page4 = Page::findOrFail(3);
        $followers = $page4->followers()->get();
        $this->assertEquals(3, $totalPage);
        $this->assertEquals(1, count($followers));
        $this->assertEquals(2, $followers[0]->id);
    }


    public function test_login_url()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'j2@g.com',
            'password' => '123456789'
        ]);
        $response->assertStatus(200)
            ->assertJsonPath('user.id', 2)
            ->assertJsonPath('user.first_name', "John2")
            ->assertJsonPath('user.last_name', "Doe2");
    }


    public function test_feed()
    {
        $user = User::findOrFail(2);
        $response = $this->actingAs($user, 'api')->get('/api/person/feed?page=1&page_size=1');
        $response->assertStatus(200)
            ->assertJsonPath('total_count', 2)
            ->assertJsonCount(2, $key = null);
    }


    public function test_feed_pagination()
    {
        $user = User::findOrFail(2);
        $response = $this->actingAs($user, 'api')->get('/api/person/feed?page=2&page_size=5');
        $response->assertStatus(200)
            ->assertJsonPath('total_count', 2)
            ->assertJsonPath('data', []);
    }

}
