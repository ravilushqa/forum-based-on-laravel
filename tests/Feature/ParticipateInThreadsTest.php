<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInThreadsTest extends TestCase
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

        $this->post(route('replies.store', ['channel' => $thread->channel->slug, 'thread' => $thread->getKey()]), $reply->toArray());

        $this->assertDatabaseHas('replies', ['body' => $reply->body]);

        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class, ['body' => null]);

        $this
            ->post(route('threads.store', ['channel' => $thread->channel->slug, 'thread' => $thread->getKey()]), $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $this->withExceptionHandling();
        $reply = create(Reply::class);

        $this->delete(route('replies.destroy', $reply))
            ->assertRedirect('login');
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $this->delete(route('replies.destroy', $reply))
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertEquals(0, $reply->thread->fresh()->replies_count);

    }

    /** @test */
    public function authorized_users_can_update_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $this->patch(route('replies.update', $reply), ['body' => 'changed']);

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => 'changed'
        ]);
    }

    /** @test */
    public function unauthorized_users_cannot_update_replies()
    {
        $this->withExceptionHandling();
        $reply = create(Reply::class);

        $this->patch(route('replies.update', $reply))
            ->assertRedirect('login');

        $this->signIn()
            ->patch(route('replies.update', $reply))
            ->assertStatus(403);
    }
}
