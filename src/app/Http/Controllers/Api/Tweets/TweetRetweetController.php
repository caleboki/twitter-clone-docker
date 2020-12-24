<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Tweet;
use App\User;
use App\Tweets\TweetType;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetWasDeleted;
use App\Events\Tweets\TweetRetweetsWereUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $retweet = $request->user()->tweets()->create([
            'type'              => TweetType::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($retweet));

        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        broadcast(new TweetWasDeleted($tweet->retweetedTweet));
        $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();
        broadcast(new TweetRetweetsWereUpdated($request->user(), $tweet));
    }
}
