<div class="card">
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
        <div
            class="tweet--footer is-flex-tablet has-text-centered-mobile is-align-items-center is-justify-content-space-between">
            <div class="actions is-flex">
                <form action="{{ route('tweet.like',['id'=>$tweet['id']]) }}" method="post" class="">
                    @csrf
                    <button class="button is-link is-light">
                        <span class="icon-text">
                            <ion-icon name="thumbs-up" class="icon"></ion-icon>
                            <span class="mt-1">{{ $tweet['like'] }}</span>
                        </span>
                    </button>
                </form>
                <form action="{{ route('tweet.dislike',['id'=>$tweet['id']]) }}" method="post" class="mr-2">
                    @csrf
                    <button class="button is-danger is-light">
                        <span class="icon-text">
                            <ion-icon name="thumbs-down" class="icon"></ion-icon>
                            <span class="mt-1">{{ $tweet['dislike'] }}</span>
                        </span>
                    </button>
                </form>
                <a href="#" class="button is-primary is-light mr-2">
                    <span class="icon-text">
                        <ion-icon name="chatbubble-ellipses" class="icon"></ion-icon>
                        <span class="mt-1">{{ $tweet['comment'] }}</span>
                    </span>
                </a>
            </div>
            <div class="p-3">
                <time datetime="2016-1-1">{{ \Morilog\Jalali\Jalalian::forge($tweet['created_at'])->ago() }}</time>
            </div>
        </div>
        <div class="tweet--input-comment has-background-warning-light mt-5">
            <form action="{{ route('comment.store',['id'=>$tweet['id']]) }}" method="post" class="p-5">
                @csrf
                <div class="field">
                    <!--<label class="label">دیدگاه شما</label>-->
                    <div class="control">
                        <textarea class="textarea is-dark" placeholder="دیدگاه خود را اینجا وارد کنید..." name="comment"
                                  rows="2"></textarea>
                    </div>
                </div>
                <div class="control has-text-left is-full-mobile">
                    <button class="button is-dark px-6">ارسال</button>
                </div>
            </form>
        </div>
        <div class="tweet--comments mt-5">
            @foreach($comments as $comment)
                @include('home.layouts.templates.comment')
            @endforeach
        </div>
    </article>
</div>
