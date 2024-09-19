<?php

Route::setGet('', pages('home'), 'auth');

Route::setGet('login', pages('auth/login'), 'guest');
Route::setPost('authenticate', actions('auth/authenticate'), 'guest');
Route::setGet('logout', actions('auth/logout'), 'auth');

Route::setGet('alterar-senha', pages('auth/editPassword'), 'auth');
Route::setPost('alterar-senha', actions('auth/changePassword'), 'auth');