<li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">

    <div id="reply-{{$reply->id}}" class="comment-wrap clearfix">

        <div class="comment-meta">

            <div class="comment-author vcard">

                <span class="comment-avatar clearfix">
                <img alt='' src='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' class='avatar avatar-60 photo' height='60' width='60' /></span>

            </div>

        </div>

        <div class="comment-content clearfix">

            <div class="comment-author"><a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a><span><a href="#" title="Permalink to this comment">{{ $reply->created_at->diffForHumans() }}</a></span></div>

            <p>{{ $reply->body }}</p>

            <div>
                <form method="POST" action="/replies/{{ $reply->getKey() }}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-link" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        <i class="icon-like"></i>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>

        </div>

        <div class="clear"></div>

    </div>

</li>