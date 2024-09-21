<?php

Route::setGet('', pages('home'), 'auth');

Route::setGet('login', pages('auth/login'), 'guest');
Route::setPost('authenticate', actions('auth/authenticate'), 'guest');
Route::setGet('logout', actions('auth/logout'), 'auth');

Route::setGet('alterar-senha', pages('auth/editPassword'), 'auth');
Route::setPost('alterar-senha', actions('auth/changePassword'), 'auth');

Route::setGet('usuario', pages('usuario/index'), 'auth');
Route::setGet('usuario/listar', actions('usuario/list'), 'auth');
Route::setGet('usuario/cadastrar', pages('usuario/create'), 'auth');
Route::setPost('usuario/cadastrar', actions('usuario/store'), 'auth');
Route::setGet('usuario/editar', pages('usuario/edit'), 'auth');
Route::setPost('usuario/editar', actions('usuario/update'), 'auth');
Route::setPost('usuario/excluir', actions('usuario/destroy'), 'auth');

Route::setGet('cidade/obter', actions('cidade/get'), 'auth');

Route::setGet('unidade', pages('unidade/index'), 'auth');
Route::setGet('unidade/listar', actions('unidade/list'), 'auth');
Route::setGet('unidade/cadastrar', pages('unidade/create'), 'auth');
Route::setPost('unidade/cadastrar', actions('unidade/store'), 'auth');
Route::setGet('unidade/editar', pages('unidade/edit'), 'auth');
Route::setPost('unidade/editar', actions('unidade/update'), 'auth');
Route::setPost('unidade/excluir', actions('unidade/destroy'), 'auth');