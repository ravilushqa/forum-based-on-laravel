<?php

use Illuminate\Database\Seeder;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory(\App\Thread::class, 50)->create();

        $threads->each(function ($thread) {
           factory(\App\Reply::class, 10)->create(['thread_id' => $thread->id]);
        });
    }
}
