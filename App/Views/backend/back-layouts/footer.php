 
<!-- modal delete -->
        <div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi Logout</h4>
                    </div>
                
                    <div class="modal-body">
                        <p>Anda akan keluar dari system</p>
                        <p>Apakah anda akan melanjutkan ?</p>
                        <p class="debug-url"></p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <a class="btn btn-danger btn-ok">Ok</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#confirm-logout').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                
                // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        </script>

 </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php  BASE_URL ?>/asset/bootstrap/js/bootstrap.min.js"></script>

     <!-- Bootstrap Core JavaScript -->
    <script src="<?php  BASE_URL ?>/asset/bootstrap/js/bootstrap-switch.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php  BASE_URL ?>/asset/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php  BASE_URL ?>/asset/raphael/raphael-min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php  BASE_URL ?>/asset/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php  BASE_URL ?>/asset/datatables/media/js/dataTables.bootstrap.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php  BASE_URL ?>/asset/dist/js/sb-admin-2.js"></script>

    <script>
    $(document).ready(function() {
        //Datatable Bootstrap
        $('#dataTablesMenu').DataTable();

        //Bootstrap Switch
        $("[name='tampil-menu']").bootstrapSwitch({
            onColor :'success',
            size    :'small',
            onText  :'Y',
            offText :'N'
        });
    });
    </script>

</body>
</html>
