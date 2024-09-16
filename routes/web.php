<?php

Route::setGet('', pages('home'));

Route::setGet('login', pages('auth/login'), 'guest');
Route::setPost('authenticate', actions('auth/authenticate'), 'guest');
Route::setGet('logout', actions('auth/logout'), 'auth');