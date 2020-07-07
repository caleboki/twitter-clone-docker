<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Http\Controllers\Controller;
use App\Events\Tweets\TweetWasCreated;
use Illuminate\Http\Request;
use App\Http\Requests\Tweets\TweetStoreRequest;

class TweetController extends Controller
{
    public function __constructor()
    {
        $this->middleware(['auth:airlock'])->only(['store']);
    }

    public function store(TweetStoreRequest $request)
    {
        $tweet = $request->user()->tweets()->create($request->only('body'));
        broadcast(new TweetWasCreated($tweet));
    }
}
