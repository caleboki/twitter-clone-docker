<?php

Route::get('/timeline', 'Api\Timeline\TimelineController@index');
Route::post('/tweets', 'Api\Tweets\TweetController@store');
Route::post('/tweets/{tweet}/likes', 'Api\Tweets\TweetLikeController@store');
Route::delete('/tweets/{tweet}/likes', 'Api\Tweets\TweetLikeController@destroy');

Route::post('/tweets/{tweet}/retweets', 'Api\Tweets\TweetRetweetController@store');
Route::delete('/tweets/{tweet}/retweets', 'Api\Tweets\TweetRetweetController@destroy');

Route::get('/media/types', 'Api\Media\MediaTypesController@index');
