<div class="card @if(!$loop->first) mt-6 @endif">
    <article class="tweet p-3">
        <div class="tweet--header is-flex is-align-items-center">
            <figure>
                <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                </p>
            </figure>
            <strong class="mr-3">{{ $tweet['user'] }}</strong>
        </div>
        <hr class="my-1">
        <div class="tweet--content my-4">
            <p>{{ $tweet['content'] }}</p>
        </div>
        <hr class="my-1">
        <div class="tweet--footer is-flex is-align-items-center is-justify-content-space-between">
            <div class="actions">
                <form action="{{ route('tweet.like',['id'=>$tweet['id']]) }}" method="post" class="is-inline-block">
                    @csrf
                    <button class="button is-link is-light">
                        <span class="icon-text">
                            <ion-icon name="thumbs-up" class="icon"></ion-icon>
                            <span class="mt-1">{{ $tweet['like'] }}</span>
                        </span>
                    </button>
                </form>
                <form action="{{ route('tweet.dislike',['id'=>$tweet['id']]) }}" method="post" class="is-inline-block">
                    @csrf
                    <button class="button is-danger is-light">
                        <span class="icon-text">
                            <ion-icon name="thumbs-down" class="icon"></ion-icon>
                            <span class="mt-1">{{ $tweet['dislike'] }}</span>
                        </span>
                    </button>
                </form>
                <a href="{{ route('tweet.show',$tweet['id']) }}" class="button is-primary is-light">
                    <span class="icon-text">
                        <ion-icon name="chatbubble-ellipses" class="icon"></ion-icon>
                        <span class="mt-1">{{ $tweet['comment'] }} - افزودن دیدگاه</span>
                    </span>
                </a>
            </div>
            <time datetime="2016-1-1">{{ \Morilog\Jalali\Jalalian::forge($tweet['created_at'])->ago() }}</time>
        </div>
    </article>
</div>
