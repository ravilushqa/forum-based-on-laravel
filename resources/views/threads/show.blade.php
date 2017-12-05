@extends('layouts.app')

@section('content')
    <div class="single-post nobottommargin">

        <!-- Single Post
        ============================================= -->
        <div class="entry clearfix">

            <!-- Entry Title
            ============================================= -->
            <div class="entry-title">
                <h2>{{ $thread->title }}</h2>
            </div><!-- .entry-title end -->

            <!-- Entry Meta
            ============================================= -->
            <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i>{{$thread->created_at->diffForHumans()}}</li>
                <li><a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></li>
                <li><i class="icon-folder-open"></i>
                    <a href="{{route('threads.channel.index', ['channel' => $thread->channel->slug])}}">{{$thread->channel->slug}}</a>
                </li>
                <li><a href="{{ $thread->path() }}"><i class="icon-comments"></i>{{$thread->replies_count}}</a></li>
            </ul><!-- .entry-meta end -->

            <!-- Entry Image
            ============================================= -->
            {{--<div class="entry-image bottommargin">--}}
                {{--<a href="#"><img src="/canvas/images/blog/full/10.jpg" alt="Blog Single"></a>--}}
            {{--</div><!-- .entry-image end -->--}}

            <!-- Entry Content
            ============================================= -->
            <div class="entry-content notopmargin">

                <p>{{ $thread->body }}</p>
                <div class="clear"></div>
            </div>
        </div><!-- .entry end -->

        <!-- Comments
						============================================= -->
        <div id="comments" class="clearfix">

            <h3 id="comments-title"><span>{{ $thread->replies_count }}</span> Comments</h3>

            <!-- Comments List
            ============================================= -->
            <ol class="commentlist clearfix">
                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach
            </ol><!-- .commentlist end -->
        </div>
        {{$replies->links()}}

        @if(auth()->check())
            <form method="POST" action="{{ $thread->path() . '/replies'}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                </div>

                <button type="submit" class="btn btn-default">Post</button>
            </form>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
        @endif
    </div>
@endsection
