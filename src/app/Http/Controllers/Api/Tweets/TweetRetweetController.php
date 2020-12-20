<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Tweet;
use App\Tweets\TweetType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
{
    public function store(Tweet $tweet, Request $request)
    {
        $retweet = $request->user()->tweets()->create([
            'type'              => TweetType::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();
    }
}