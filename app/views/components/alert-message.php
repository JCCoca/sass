<?php if (isset($_GET['success']) and !empty($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <?= $_GET['success']; ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script>
        $(function(){
            removeURLParams('success');
        });
    </script>
<?php elseif (isset($_GET['error']) and !empty($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        <?= $_GET['error']; ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script>
        $(function(){
            removeURLParams('error');
        });
    </script>
<?php endif ?>