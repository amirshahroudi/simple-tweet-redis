@component('home.layouts.content')
    @auth
        <div class="box is-success is-shadowless has-background-danger-light is-size-4">
            در اندیشه چه هستی؟
            <form action="{{ route('tweet.store') }}" method="post" class="p-5">
                @csrf
                <div class="field">
                    <!--<label class="label">دیدگاه شما</label>-->
                    <div class="control">
                        <textarea class="textarea is-dark" placeholder="اینجا بنویس..." name="tweet"
                                  rows="2"></textarea>
                    </div>
                </div>
                <div class="control has-text-left is-full-mobile">
                    <button class="button is-dark px-6">ارسال</button>
                </div>
            </form>
        </div>
    @endauth
    @foreach($tweets as $tweet)
        @include('home.layouts.templates.simple-tweet',['tweet'=>$tweet])
    @endforeach
@endcomponent
