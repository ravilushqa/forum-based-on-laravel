<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling();
        $thread = create(Thread::class);

        $reply = make(Reply::class);

        $this
            ->post(route('threads.store', ['channel' => $thread->channel->slug, 'thread' => $thread->getKey()]), $reply->toArray())
            ->assertRedirect('/login');
    }

    /** @test  */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class);

        $this->post(route('threads.store', ['channel' => $thread->channel->slug, 'thread' => $thread->getKey()]), $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
