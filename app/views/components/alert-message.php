<?php if (isset($_GET['success']) and !empty($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible mb-3" role="alert">
        <?= $_GET['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        window.addEventListener('load', (event) => {
            removeURLParams('success');
        });
    </script>
<?php elseif (isset($_GET['error']) and !empty($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible mb-3" role="alert">
        <?= $_GET['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        window.addEventListener('load', (event) => {
            removeURLParams('error');
        });
    </script>
<?php endif ?>