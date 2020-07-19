<?php

//Route::get('/timeline', 'Api\Timeline\TimelineController@index');
Route::post('/tweets', 'Api\Tweets\TweetController@store');
