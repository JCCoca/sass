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

Route::setGet('sala', pages('sala/index'), 'auth');
Route::setGet('sala/listar', actions('sala/list'), 'auth');
Route::setGet('sala/detalhar', pages('sala/detail'), 'auth');
Route::setGet('sala/cadastrar', pages('sala/create'), 'auth');
Route::setPost('sala/cadastrar', actions('sala/store'), 'auth');
Route::setGet('sala/editar', pages('sala/edit'), 'auth');
Route::setPost('sala/editar', actions('sala/update'), 'auth');
Route::setPost('sala/excluir', actions('sala/destroy'), 'auth');
Route::setGet('sala/obter', actions('sala/get'), 'auth');

Route::setGet('sala/disponibilidade/listar', actions('disponibilidade-sala/list'), 'auth');
Route::setGet('sala/disponibilidade/cadastrar', pages('disponibilidade-sala/create'), 'auth');
Route::setPost('sala/disponibilidade/cadastrar', actions('disponibilidade-sala/store'), 'auth');
Route::setGet('sala/disponibilidade/editar', pages('disponibilidade-sala/edit'), 'auth');
Route::setPost('sala/disponibilidade/editar', actions('disponibilidade-sala/update'), 'auth');
Route::setPost('sala/disponibilidade/excluir', actions('disponibilidade-sala/destroy'), 'auth');

Route::setGet('agendamento', pages('agendamento/index'), 'auth');
Route::setGet('agendamento/listar', actions('agendamento/list'), 'auth');
Route::setGet('agendamento/cadastrar', pages('agendamento/create'), 'auth');
Route::setPost('agendamento/cadastrar', actions('agendamento/store'), 'auth');
Route::setGet('agendamento/editar', pages('agendamento/edit'), 'auth');
Route::setPost('agendamento/editar', actions('agendamento/update'), 'auth');
Route::setPost('agendamento/excluir', actions('agendamento/destroy'), 'auth');
Route::setPost('agendamento/confirmar', actions('agendamento/confirm'), 'auth');
Route::setPost('agendamento/recusar', actions('agendamento/reject'), 'auth');