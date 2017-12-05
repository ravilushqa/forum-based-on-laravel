<nav id="primary-menu" class="style-2 center">

    <ul>
        <li><a href="#" class="current"><div>Browse</div></a>
            <ul>
                <li><a href="{{ route('threads.index') }}">All Threads</a></li>

                @if(auth()->check())
                    <li><a href="{{ route('threads.index', ['by' => auth()->user()->name]) }}">My Threads</a></li>
                @endif

                <li><a href="{{ route('threads.index', ['popular' => 1]) }}">Popular Threads</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('threads.create') }}">New Thread</a>
        </li>
        <li><a href="#" class="current"><div>Channels</div></a>
            <ul>
                @foreach($channels as $channel)
                    <li><a href="{{route('threads.channel.index', ['channel' => $channel->slug])}}">{{ $channel->name }}</a></li>
                @endforeach
            </ul>
        </li>
    </ul>

    <ul>
        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul>
                <li><a href="{{ route('profile', Auth::user()) }}">My Profile</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

        </li>
        @endguest
    </ul>
</nav><!-- #primary-menu end -->


