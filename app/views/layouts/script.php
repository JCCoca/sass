<!-- Bootstrap 5 JS -->
<script src="<?= asset('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- SB Admin 2 JS -->
<script src="<?= asset('vendor/sb-admin/js/sb-admin.min.js'); ?>"></script>

<script>
    $(function(){
        $('.money').mask("#.##0,00", {reverse: true});
    });
</script>