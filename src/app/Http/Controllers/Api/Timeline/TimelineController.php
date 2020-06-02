<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TweetCollection;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        $tweets = $request->user()->tweetsFromFollowing()->paginate(20);
        return new TweetCollection($tweets);
    }
}
