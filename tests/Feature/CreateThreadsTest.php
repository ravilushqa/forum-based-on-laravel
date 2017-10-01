<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray());

    }

    /** @test */
    public function guests_cannot_see_the_create_thread_page()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get(route('threads.create'));
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
