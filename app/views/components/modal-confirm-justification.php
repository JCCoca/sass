<div class="modal fade" id="modal-confirm-justification" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atenção</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-modal-confirm-justification" method="POST">
                <div class="modal-body">
                    <div id="message-confirm-justification" class="mb-3">
                        <?= $message ?? 'Você tem certeza que deseja realizar essa ação?'; ?>
                    </div>                   
                    <div class="form-group">
                        <label for="justificativa">
                            Justificativa<span class="text-danger">*</span>
                        </label>
                        <textarea 
                            name="justificativa" 
                            id="justificativa" 
                            class="form-control" 
                            rows="6" 
                            required
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon">
                            <i class="fa-regular fa-check"></i>
                        </span>
                        <span class="text">Sim</span>
                    </button>
                
                    <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                        <span class="icon">
                            <i class="fa-regular fa-xmark"></i>
                        </span>
                        <span class="text">Não</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmJustification(url, message = null) {
        if (message !== null) {
            $('#message-confirm-justification').text(message);
        }
        $('#form-modal-confirm-justification').attr('action', url);
        $('#modal-confirm-justification').modal('show');
    }
</script>