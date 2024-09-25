<div class="modal fade" id="modal-confirm-question" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atenção</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="message-confirm-question">
                <?= $message ?? 'Você tem certeza que deseja realizar essa ação?'; ?>
            </div>
            <div class="modal-footer justify-content-start">
                <form id="form-modal-confirm-question" method="POST">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon">
                            <i class="fa-regular fa-check"></i>
                        </span>
                        <span class="text">Sim</span>
                    </button>
                </form>

                <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                    <span class="icon">
                        <i class="fa-regular fa-xmark"></i>
                    </span>
                    <span class="text">Não</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmQuestion(url, message = null) {
        if (message !== null) {
            $('#message-confirm-question').text(message);
        }
        $('#form-modal-confirm-question').attr('action', url);
        $('#modal-confirm-question').modal('show');
    }
</script>