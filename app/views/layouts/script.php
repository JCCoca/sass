<!-- Bootstrap 5 JS -->
<script src="<?= asset('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- SB Admin 2 JS -->
<script src="<?= asset('vendor/sb-admin/js/sb-admin.min.js'); ?>"></script>

<!-- JQuery LoadingOverlay -->
<script src="<?= asset('vendor/jquery-loading-overlay/loadingoverlay.min.js'); ?>"></script>

<script>
    $(function(){
        $('.money').mask("#.##0,00", {reverse: true});

        $('form').on('submit', (event) => {
            var form = $(this);
            form.find('button[type="submit"]').prop("disabled", true);

            $.LoadingOverlay("show", {
                fontawesome: '',
                image: '<?= asset('images/loading.svg'); ?>',
                imageAnimation: false,
                imageColor: false
            });
        });
    });
</script>