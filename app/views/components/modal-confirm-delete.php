<div class="modal fade" id="modal-confirm-delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atenção</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="message-confirm-delete">
                <?= $message ?? 'Você tem certeza que deseja EXCLUIR?'; ?>
            </div>
            <div class="modal-footer justify-content-start">
                <form id="form-modal-confirm-delete" method="POST">
                    <button type="submit" class="btn btn-danger btn-icon-split">
                        <span class="icon">
                            <i class="fa-regular fa-trash-alt"></i>
                        </span>
                        <span class="text">Excluir</span>
                    </button>
                </form>

                <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                    <span class="icon">
                        <i class="fa-regular fa-xmark"></i>
                    </span>
                    <span class="text">Cancelar</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url, message = null) {
        if (message !== null) {
            $('#message-confirm-delete').text(message);
        }
        $('#form-modal-confirm-delete').attr('action', url);
        $('#modal-confirm-delete').modal('show');
    }
</script>