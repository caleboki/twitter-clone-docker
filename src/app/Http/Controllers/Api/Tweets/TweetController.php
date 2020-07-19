<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use App\Events\Tweets\TweetWasCreated;
use Illuminate\Http\Request;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Tweet;
use App\Tweets\TweetType;

class TweetController extends Controller
{
    public function __constructor()
    {
        $this->middleware(['auth:airlock'])->only(['store']);
    }

    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), [
            'type' => TweetType::TWEET
        ]));
        broadcast(new TweetWasCreated($tweet));
    }
}
