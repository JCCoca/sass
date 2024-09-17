                </div>
            </div> 
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Senac/AC <?= date('Y'); ?>. Todos os direitos reservados.</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="<?= asset('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- SB Admin 2 JS -->
    <script src="<?= asset('vendor/sb-admin/js/sb-admin.min.js'); ?>"></script>

    <script>
        $(function(){
            $('.money').mask("#.##0,00", {reverse: true});
        });
    </script>
</body>
</html>