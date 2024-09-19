<!DOCTYPE html>
<html lang="<?= APP_LANGUAGE; ?>">
<head>
    <?php @layout('head', ['title' => $title]); ?>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php layout('admin/sidebar', ['active' => $active ?? '']); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <span class="navbar-title">
                        <?= APP_NAME; ?>
                    </span>
                            
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a 
                                class="nav-link dropdown-toggle" 
                                href="#" 
                                id="userDropdown" 
                                role="button"
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false"
                            >
                                <?php if (getSession()['auth']['sexo'] === 'Masculino'): ?>
                                    <img src="<?= asset('images/profile_male.svg'); ?>" class="img-profile rounded-circle" >
                                <?php else: ?>
                                    <img src="<?= asset('images/profile_female.svg'); ?>" class="img-profile rounded-circle" >
                                <?php endif ?>
                                
                                <span class="ml-2 d-none d-lg-inline text-gray-600 small">
                                    <?= abreviarNome(getSession()['auth']['nome']); ?>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a href="<?= route('alterar-senha'); ?>" class="dropdown-item">
                                    <i class="fa-regular fa-key fa-fw mr-2 text-gray-400"></i>
                                    Alterar Senha
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="<?= route('logout'); ?>" class="dropdown-item">
                                    <i class="fa-regular fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
