<?php

namespace App\Http\Controllers;

use App\helper\RedisKeyHelper;
use Carbon\Carbon;
use Faker\Provider\fa_IR\Person;
use Faker\Provider\fa_IR\Text;
use Illuminate\Contracts\Support\Renderable;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $tweets = collect();

        $tweetsId = Redis::zrevrange(RedisKeyHelper::KEY_TWEETS_ID_LIST_SORT_BY_TIME, 0, -1);

        foreach ($tweetsId as $tweetId) {
            $tweets->push(Redis::hgetall(RedisKeyHelper::tweetKeyGenerator($tweetId)));
        }

        return view('home.index', compact('tweets'));
    }

    public function mock()
    {
//        Redis::command('flushdb', []);
        $faker = Container::getInstance()->make(Generator::class);
        $person = new Person($faker);
        $text = new Text($faker);

        for ($i = 0; $i < 10; $i++) {
            $tweetId = Redis::command('incr', [RedisKeyHelper::KEY_LAST_TWEET_ID]);
            $tweetKey = RedisKeyHelper::tweetKeyGenerator($tweetId);

            Redis::hmset($tweetKey,
                "id", $tweetId,
                "user", Arr::random([Person::firstNameFemale(), Person::firstNameMale()]),
                "user_id", rand(1, 100),
                "content", $text->realText(800),
                "like", rand(0, 50),
                "dislike", rand(0, 50),
                "comment", 0,
                "created_at", $date = Carbon::now()
            );
            Redis::zadd(RedisKeyHelper::KEY_TWEETS_ID_LIST_SORT_BY_TIME, $date->timestamp, $tweetId);
        }
        $tweetsId = Redis::zrevrange(RedisKeyHelper::KEY_TWEETS_ID_LIST_SORT_BY_TIME, 0, -1);
        foreach ($tweetsId as $id) {
            for ($j = 0; $j < rand(1, 9); $j++) {
                $commentId = Redis::command('incr', [RedisKeyHelper::KEY_LAST_COMMENT_ID]);
                $commentKey = RedisKeyHelper::commentKeyGenerator($commentId);

                Redis::hmset($commentKey,
                    "id", $commentId,
                    "user", Arr::random([Person::firstNameFemale(), Person::firstNameMale()]) . ' ' . $person->lastName(),
                    "user_id", rand(1, 100),
                    "content", $text->realText(rand(150, 500)),
                    "like", rand(0, 50),
                    "dislike", rand(0, 50),
                    "created_at", $date = Carbon::now()
                );
                Redis::zadd(RedisKeyHelper::tweet_commentKeyGenerator($id), $date->timestamp, $commentId);
                Redis::hincrby(RedisKeyHelper::tweetKeyGenerator($id), "comment", 1);
            }
        }
        return redirect(url('/'));
    }
}
