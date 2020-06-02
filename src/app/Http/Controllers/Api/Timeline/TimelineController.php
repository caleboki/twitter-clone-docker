<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TweetCollection;

class TimelineController extends Controller
{
    public function __constructor()
    {
        $this->middleware(['auth:airlock']);
    }

    public function index(Request $request)
    {
        $tweets = $request->user()
                    ->tweetsFromFollowing()
                    ->latest()
                    ->paginate(20);
        return new TweetCollection($tweets);
    }
}
