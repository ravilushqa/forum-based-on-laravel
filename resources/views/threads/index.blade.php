@extends('layouts.app')

@section('content')
    <!-- Post Content
					============================================= -->
    <div class="postcontent nobottommargin clearfix">

        <!-- Posts
        ============================================= -->
        <div id="posts" class="small-thumbs">
                @forelse($threads as $thread)
                <div class="entry clearfix">
                    <div class="entry-c">
                        <div class="entry-title">
                            <h2><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h2>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i>{{$thread->created_at->diffForHumans()}}</li>
                            <li><a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></li>
                            <li><i class="icon-folder-open"></i>
                                <a href="{{route('threads.channel.index', ['channel' => $thread->channel->slug])}}">{{$thread->channel->slug}}</a>
                            </li>
                            <li><a href="{{ $thread->path() }}"><i class="icon-comments"></i>{{$thread->replies_count}}</a></li>
                        </ul>
                        <div class="entry-content">
                            <p>{{ $thread->body }}</p>
                        </div>
                    </div>
                </div>
                @empty
                    <p>There are no relevant results at this time.</p>
                @endforelse
        </div>
    </div>
@endsection
