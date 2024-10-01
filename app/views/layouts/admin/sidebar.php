<ul class="navbar-nav bg-gradient-senac sidebar sidebar-dark accordion" id="accordionSidebar">
    <a href="<?= route(''); ?>" class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="<?= asset('images/icone_logo_senac.png'); ?>" style="width: 40px;">
        </div>
        <div class="sidebar-brand-text">
            <img src="<?= asset('images/nome_logo_senac.png'); ?>" style="width: 100px; margin-left: 10px;">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= $active === 'inicio' ? 'active' : '' ?>">
        <a href="<?= route(''); ?>" class="nav-link">
            <i class="fa-regular fa-house fa-fw"></i>
            <span>Início</span>
        </a>
    </li>

    <?php if (isOrientador() or isGestor()): ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Módulos
        </div>

        <li class="nav-item <?= $active === 'agendamento' ? 'active' : '' ?>">
            <a href="<?= route('agendamento'); ?>" class="nav-link">
                <i class="fa-regular fa-calendar-lines-pen fa-fw"></i>
                <span>Agendamento</span>
            </a>
        </li>

        <li class="nav-item <?= $active === 'sala' ? 'active' : '' ?>">
            <a href="<?= route('sala'); ?>" class="nav-link">
                <i class="fa-regular fa-screen-users fa-fw"></i>
                <span>Sala</span>
            </a>
        </li>

        <?php if (isGestor()): ?>
            <li class="nav-item <?= $active === 'relatorio' ? 'active' : '' ?>">
                <a href="<?= route('relatorio'); ?>" class="nav-link">
                    <i class="fa-regular fa-file-pdf fa-fw"></i>
                    <span>Relatório</span>
                </a>
            </li>
        <?php endif ?>
    <?php endif ?>

    <?php if (isAdministrador() or isGestor()): ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Admin
        </div>

        <li class="nav-item <?= $active === 'usuario' ? 'active' : '' ?>">
            <a href="<?= route('usuario'); ?>" class="nav-link">
                <i class="fa-regular fa-users fa-fw"></i>
                <span>Usuário</span>
            </a>
        </li>

        <?php if (isAdministrador()): ?>
            <li class="nav-item <?= $active === 'unidade' ? 'active' : '' ?>">
                <a href="<?= route('unidade'); ?>" class="nav-link">
                    <i class="fa-regular fa-building-flag fa-fw"></i>
                    <span>Unidade</span>
                </a>
            </li>
        <?php endif ?>
    <?php endif ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>