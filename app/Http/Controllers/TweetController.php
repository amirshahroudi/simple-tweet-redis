<?php

namespace App\Http\Controllers;

use App\helper\RedisKeyHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redis;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $tweetId = Redis::command('incr', [RedisKeyHelper::KEY_LAST_TWEET_ID]);
        $tweetKey = RedisKeyHelper::tweetKeyGenerator($tweetId);
        Redis::hmset($tweetKey,
            "id", $tweetId,
            "user", auth()->user()->name,
            "user_id", auth()->id(),
            "content", $request->tweet,
            "like", 0,
            "dislike", 0,
            "comment", 0,
            "created_at", $date = Carbon::now()
        );
        Redis::zadd(RedisKeyHelper::KEY_TWEETS_ID_LIST_SORT_BY_TIME, $date->timestamp, $tweetId);
        return redirect(route('tweet.show', $tweetId));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show(int $id)
    {
        if ($id < 0 || !is_numeric($id)) {
            abort(404);
        }

        $tweet = Redis::hgetall(RedisKeyHelper::tweetKeyGenerator($id));

        if ([] == $tweet) {
            abort(404);
        }

        $commentIds = Redis::zrevrange(RedisKeyHelper::tweet_commentKeyGenerator($id), 0, -1);
//        dump($commentIds);
        $comments = collect();
        foreach ($commentIds as $commentId) {
            $comments->push(Redis::hgetall(RedisKeyHelper::commentKeyGenerator($commentId)));
        }

        return view('home.single', compact('tweet', 'comments'));
    }

    public function store_comment(Request $request, int $id)
    {
        $commentId = Redis::command('incr', [RedisKeyHelper::KEY_LAST_COMMENT_ID]);
        $commentKey = RedisKeyHelper::commentKeyGenerator($commentId);
        Redis::hmset($commentKey,
            "id", $commentId,
            "user", auth()->user()->name,
            "user_id", auth()->id(),
            "content", $request->comment,
            "like", 0,
            "dislike", 0,
            "created_at", $date = Carbon::now()
        );
        Redis::zadd(RedisKeyHelper::tweet_commentKeyGenerator($id), $date->timestamp, $commentId);
        Redis::hincrby(RedisKeyHelper::tweetKeyGenerator($id), "comment", 1);
        return redirect(route('tweet.show', $id));
    }

    public function like_tweet(Request $request, int $id)
    {
        $tweetKey = RedisKeyHelper::tweetKeyGenerator($id);
        Redis::hincrby($tweetKey, 'like', 1);
        return redirect()
            ->back();
    }

    public function dislike_tweet(Request $request, int $id)
    {
        $tweetKey = RedisKeyHelper::tweetKeyGenerator($id);
        Redis::hincrby($tweetKey, 'dislike', 1);
        return redirect()
            ->back();
    }

    public function like_comment(Request $request, int $id)
    {
        $commentKey = RedisKeyHelper::commentKeyGenerator($id);
        Redis::hincrby($commentKey, 'like', 1);
        return redirect()
            ->back();
    }

    public function dislike_comment(Request $request, int $id)
    {
        $commentKey = RedisKeyHelper::commentKeyGenerator($id);
        Redis::hincrby($commentKey, 'dislike', 1);
        return redirect()
            ->back();
    }
}
