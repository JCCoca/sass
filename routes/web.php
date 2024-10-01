<?php

Route::setGet('', pages('home'), 'auth');

Route::setGet('login', pages('auth/login'), 'guest');
Route::setPost('authenticate', actions('auth/authenticate'), 'guest');
Route::setGet('logout', actions('auth/logout'), 'auth');

Route::setGet('alterar-senha', pages('auth/editPassword'), 'auth');
Route::setPost('alterar-senha', actions('auth/changePassword'), 'auth');

Route::setGet('redefinir-senha', pages('auth/resetPassword'), 'guest');
Route::setPost('redefinir-senha', actions('auth/updatePassword'), 'guest');

Route::setGet('usuario', pages('usuario/index'), 'auth', function(){
    return isGestor() || isAdministrador();
});
Route::setGet('usuario/listar', actions('usuario/list'), 'auth', function(){
    return isGestor() || isAdministrador();
});
Route::setGet('usuario/cadastrar', pages('usuario/create'), 'auth', function(){
    return isGestor() || isAdministrador();
});
Route::setPost('usuario/cadastrar', actions('usuario/store'), 'auth', function(){
    return isGestor() || isAdministrador();
});
Route::setGet('usuario/editar', pages('usuario/edit'), 'auth', function(){
    return isGestor() || isAdministrador();
});
Route::setPost('usuario/editar', actions('usuario/update'), 'auth', function(){
    return isGestor() || isAdministrador();
});
Route::setPost('usuario/excluir', actions('usuario/destroy'), 'auth', function(){
    return isGestor() || isAdministrador();
});

Route::setGet('cidade/obter', actions('cidade/get'), 'auth');

Route::setGet('unidade', pages('unidade/index'), 'auth', function(){
    return isAdministrador();
});
Route::setGet('unidade/listar', actions('unidade/list'), 'auth', function(){
    return isAdministrador();
});
Route::setGet('unidade/cadastrar', pages('unidade/create'), 'auth', function(){
    return isAdministrador();
});
Route::setPost('unidade/cadastrar', actions('unidade/store'), 'auth', function(){
    return isAdministrador();
});
Route::setGet('unidade/editar', pages('unidade/edit'), 'auth', function(){
    return isAdministrador();
});
Route::setPost('unidade/editar', actions('unidade/update'), 'auth', function(){
    return isAdministrador();
});
Route::setPost('unidade/excluir', actions('unidade/destroy'), 'auth', function(){
    return isAdministrador();
});

Route::setGet('sala', pages('sala/index'), 'auth', function(){
    return isOrientador() || isGestor();
});
Route::setGet('sala/listar', actions('sala/list'), 'auth', function(){
    return isOrientador() || isGestor();
});
Route::setGet('sala/detalhar', pages('sala/detail'), 'auth', function(){
    return isOrientador() || isGestor();
});
Route::setGet('sala/cadastrar', pages('sala/create'), 'auth', function(){
    return isGestor();
});
Route::setPost('sala/cadastrar', actions('sala/store'), 'auth', function(){
    return isGestor();
});
Route::setGet('sala/editar', pages('sala/edit'), 'auth', function(){
    return isGestor();
});
Route::setPost('sala/editar', actions('sala/update'), 'auth', function(){
    return isGestor();
});
Route::setPost('sala/excluir', actions('sala/destroy'), 'auth', function(){
    return isGestor();
});
Route::setGet('sala/obter', actions('sala/get'), 'auth');

Route::setGet('sala/disponibilidade/listar', actions('disponibilidade-sala/list'), 'auth', function(){
    return isOrientador() || isGestor();
});
Route::setGet('sala/disponibilidade/cadastrar', pages('disponibilidade-sala/create'), 'auth', function(){
    return isGestor();
});
Route::setPost('sala/disponibilidade/cadastrar', actions('disponibilidade-sala/store'), 'auth', function(){
    return isGestor();
});
Route::setGet('sala/disponibilidade/editar', pages('disponibilidade-sala/edit'), 'auth', function(){
    return isGestor();
});
Route::setPost('sala/disponibilidade/editar', actions('disponibilidade-sala/update'), 'auth', function(){
    return isGestor();
});
Route::setPost('sala/disponibilidade/excluir', actions('disponibilidade-sala/destroy'), 'auth', function(){
    return isGestor();
});

Route::setGet('relatorio', pages('relatorio/index'), 'auth', function(){
    return isGestor();
});
Route::setGet('relatorio/imprimir', pages('relatorio/print'), 'auth', function(){
    return isGestor();
});

Route::setGet('agendamento', pages('agendamento/index'), 'auth', function(){
    return isOrientador() || isGestor();
});
Route::setGet('agendamento/listar', actions('agendamento/list'), 'auth', function(){
    return isOrientador() || isGestor();
});
Route::setGet('agendamento/cadastrar', pages('agendamento/create'), 'auth', function(){
    return isOrientador();
});
Route::setPost('agendamento/cadastrar', actions('agendamento/store'), 'auth', function(){
    return isOrientador();
});
Route::setGet('agendamento/editar', pages('agendamento/edit'), 'auth', function(){
    return isOrientador();
});
Route::setPost('agendamento/editar', actions('agendamento/update'), 'auth', function(){
    return isOrientador();
});
Route::setPost('agendamento/excluir', actions('agendamento/destroy'), 'auth', function(){
    return isOrientador();
});
Route::setPost('agendamento/confirmar', actions('agendamento/confirm'), 'auth', function(){
    return isGestor();
});
Route::setPost('agendamento/recusar', actions('agendamento/reject'), 'auth', function(){
    return isGestor();
});
Route::setGet('agendamento/obter', actions('agendamento/get'), 'auth');