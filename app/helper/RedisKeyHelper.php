<?php

namespace App\helper;

class RedisKeyHelper
{
    const KEY_TWEETS_ID_LIST_SORT_BY_TIME = 'tweet_time';
    const KEY_LAST_COMMENT_ID = 'last_comment_id';
    const KEY_LAST_TWEET_ID = 'last_tweet_id';

    public static function tweetKeyGenerator($tweetId)
    {
        return 'tweets:' . $tweetId;
    }

    public static function commentKeyGenerator($commentId)
    {
        return 'comments:' . $commentId;
    }

    public static function tweet_commentKeyGenerator($tweetId)
    {
        return 'tweets:' . $tweetId . ':comments';
    }
}
