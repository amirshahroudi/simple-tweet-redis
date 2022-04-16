<div class="tweet--comment p-5 mt-3 has-background-grey-lighter">
    <article class="media">
        <figure class="media-left is-hidden-mobile">
            <p class="image is-64x64">
                <img src="https://bulma.io/images/placeholders/128x128.png">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ $comment['user'] }}</strong>
                    <small
                        class="is-pulled-left">{{ \Morilog\Jalali\Jalalian::forge($comment['created_at'])->ago() }}</small>
                    <br>
                    {{ $comment['content'] }}
                </p>
            </div>
            <nav class="level is-mobile">
                <div class="level-left">
                    <a class="level-item">
                        <form action="{{ route('comment.like',['id'=>$comment['id']]) }}" method="post">
                            @csrf
                            <button class="button is-link">
                                <span class="icon-text">
                                    <ion-icon name="thumbs-up" class="icon"></ion-icon>
                                    <span class="mt-1">{{ $comment['like'] }}</span>
                                </span>
                            </button>
                        </form>
                    </a>
                    <a class="level-item">
                        <form action="{{ route('comment.dislike',['id'=>$comment['id']]) }}" method="post">
                            @csrf
                            <button class="button is-danger">
                            <span class="icon-text">
                                <ion-icon name="thumbs-down" class="icon"></ion-icon>
                                <span class="mt-1">{{ $comment['dislike'] }}</span>
                            </span>
                            </button>
                        </form>
                    </a>
                </div>
            </nav>
        </div>

    </article>
</div>
