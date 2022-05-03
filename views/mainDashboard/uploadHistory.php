<?php
ob_start();
?>
    <!-- Start Historique de chargement=============================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="" method="POST" autocomplete="off">
                        <div class="row">
                            <div  class="form-group offset-lg-0 col-lg-2 ">
                                <select class="custom-select" name="status">
                                    <option value="all" selected>All Status</option>
                                    <option value="active">Active</option>
                                    <option value="deleted">Deleted</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <div>
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text" class="form-control" value="<?=$debut?>" name="debut" placeholder="mm/dd/yyyy" />
                                        <input type="text" class="form-control" value="<?=$fin?>" name="fin" placeholder="mm/dd/yyyy" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Afficher</button>
                            </div>
                            <div class="form-group col-lg-2 offset-lg-2">
                                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Nouveau</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="card-body" method="post" action="">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h4 class="page-title">Historique Chargements</h4>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <button name="deleteChargement" class="btn btn-success" type="submit">
                                    <i class="mdi mdi-delete mr-2"></i> Supprimer
                                </button>
                            </div>

                        </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>User</th>
                            <th>Code</th>
                            <th>Service Name</th>
                            <th>Nombre</th>
                            <th>Status</th>
                            <th>Création</th>
                            <th>Mise à jour</th>
                            <th>Delete by</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- Historique de chargement End -->
    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Parametrage Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label name="name" for="nom" class="col-sm-4 col-form-label">Type Chargement<span class="text-warning">*</span></label>
                        <div class="col-sm-8">
                            <select name="type_data" class="browser-default custom-select" id="name" required>
                                <!--option value="" disabled selected>Choose Service</option-->
                                <option value="numeros">Numéros</option>
                                <option value="cellid">Cell ID</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label name="name" for="nom" class="col-sm-4 col-form-label">Nom ACL<span class="text-warning">*</span></label>
                        <div class="col-sm-8">
                            <select name="selectedId" class="browser-default custom-select" id="name" required>
                                <option value="" disabled selected>Choose Service</option>
                                <?php foreach ($retour as $data): extract($data); ?>
                                <option value="<?=$id?>"><?="{$name}({$code_service})"?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-4 col-form-label">Chargez le fichier <span class="text-warning">*</span></label>
                        <div class="col-sm-8">
                            <input name="file" type="file" id="file" class="filestyle" data-buttonname="btn-secondary" accept=".csv, .txt" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="template" class="col-sm-4 col-form-label">Template</label>
                        <div class="col-sm-8">
                            <a href="public/templates/template_numeros.csv" id="file" ><i class="fas fa-file-csv fa-2x text-warning"></i> CSV File</a> or
                            <a href="public/templates/template_numeros.txt" id="file" ><i class="fa fa-file-alt fa-2x text-warning"></i> TXT File</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="uploadFile" class="btn btn-warning waves-effect waves-light">Save</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<?php
$uploadHistory = ob_get_clean();
?>