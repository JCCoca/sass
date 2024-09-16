<div class="modal fade" id="modal-confirm-delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atenção</h5>
                <button 
                    type="button" 
                    class="btn-close" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <?= $message ?? 'Você tem certeza que deseja excluir?'; ?>
            </div>
            <div class="modal-footer justify-content-start">
                <form id="form-modal-confirm-delete" method="POST">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-regular fa-trash-alt"></i> Excluir
                    </button>
                </form>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fa-regular fa-xmark"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url) {
        let form = document.querySelector('#form-modal-confirm-delete');
        let modalConfirmDelete = new bootstrap.Modal('#modal-confirm-delete');

        form.setAttribute('action', url);
        modalConfirmDelete.show();
    }
</script>