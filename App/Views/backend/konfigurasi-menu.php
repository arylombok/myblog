<?php include 'back-layouts/header.php'; ?>
<?php include 'back-layouts/navigation.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Konfigurasi Menu</h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                    <P class="text-right">
                        <button type="" class="btn btn-sm btn-success" data-toggle='modal' data-target='#add-menu'><span class="glyphicon glyphicon-plus"></span> Tambah Menu</button>
                    </P>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Menu Website
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Urut</th>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Tampil</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no=0;
                                        foreach ($dataMenu as $key => $value) {
                                               echo "<tr>
                                                    <td>".$value['ordering']."</td>
                                                    <td>".$value['menu']."</td>
                                                    <td>".$value['url']."</td>
                                                    <td><input type='checkbox' name='tampil-menu' checked></td>
                                                    <td>
                                                        <button class='btn btn-success btn-sm'><span class='glyphicon glyphicon-pencil'></span></button>
                                                        <button class='btn btn-danger btn-sm' data-href='/admin/".$value['idmenu']."/menudelete' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash'></span></button>
                                                    </td>
                                                    </tr>";

                                        }
                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

        <!-- modal tambah menu -->
        <div class="modal fade" id="add-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Menu</h4>
                    </div>
                
                    <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Menu
                        </div>
                        <div class="panel-body">
                            <form action="/admin/menuadd" method="POST">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Teks Menu</label>
                                <input type="text" class="form-control" id="teksmenu" name="teksmenu" placeholder="ex : Berita" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Link Menu</label>
                                <input type="text" class="form-control" id="linkmenu" name="linkmenu" placeholder="ex : /berita" required>
                              </div>
                              <button type="submit" class="btn btn-default">Tambah</button>
                            </form>
                        </div>
                    </div>
                        <p class="debug-url"></p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Add</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal delete -->
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi Delete</h4>
                    </div>
                
                    <div class="modal-body">
                        <p>You are about to delete one track, this procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                        <p class="debug-url"></p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                
                // $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });

            $('#add-menu').on('show.bs.modal');
        </script>

        <!-- /#page-wrapper -->
<?php include 'back-layouts/footer.php'; ?>
