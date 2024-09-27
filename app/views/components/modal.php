<div class="modal fade" id="<?= $id ?? 'modal'; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="<?= $id ?? 'modal'; ?>-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $id ?? 'modal'; ?>-title"><?= $title ?? 'Title'; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="<?= $id ?? 'modal'; ?>-body">
                
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
                    <span class="icon">
                        <i class="fa-regular fa-xmark"></i>
                    </span>
                    <span class="text">Fechar</span>
                </button>
            </div>
        </div>
    </div>
</div>