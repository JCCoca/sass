<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php @layout('head', ['title' => $title]); ?>
    <script src="<?= asset('js/sidebar.js'); ?>"></script>
</head>
<body style="background-color: var(--bs-secondary-bg); height: 100%;">
    <?php layout('admin/sidebar', ['active' => $active]); ?>
