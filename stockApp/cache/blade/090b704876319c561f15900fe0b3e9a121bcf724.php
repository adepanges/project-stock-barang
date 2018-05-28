

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('load_css'); ?>
##parent-placeholder-0ebd91b02e2776264f4d9b7a9fd5a20b3359fc09##
        <link href="<?php echo e(base_url('plugins/bower_components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(base_url('plugins/bower_components/datatables-bootstrap/Buttons-1.5.1/css/buttons.dataTables.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(base_url('plugins/bower_components/sweetalert/sweetalert.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(base_url('plugins/bower_components/switchery/dist/switchery.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('load_js'); ?>
##parent-placeholder-fdbde45a831b188a18d02b225ad1de0d1f3c37be##
        <script src="<?php echo e(base_url('plugins/bower_components/datatables/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(base_url('plugins/bower_components/datatables-bootstrap/Buttons-1.5.1/js/dataTables.buttons.min.js')); ?>"></script>
        <script src="<?php echo e(base_url('plugins/bower_components/datatables-bootstrap/Buttons-1.5.1/js/buttons.flash.min.js')); ?>"></script>
        <script src="<?php echo e(base_url('plugins/bower_components/blockUI/jquery.blockUI.js')); ?>"></script>
        <!-- Sweet-Alert  -->
        <script src="<?php echo e(base_url('plugins/bower_components/sweetalert/sweetalert.min.js')); ?>"></script>
        <script src="<?php echo e(base_url('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js')); ?>"></script>
        <script src="<?php echo e(base_url('plugins/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
        <script src="<?php echo e(base_url('js/validator.js')); ?>"></script>

        <script src="<?php echo e(base_url('js/module/admin/product.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('main-inc.default.top_navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('main-inc.default.admin_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
            <!-- .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <table id="dataTableComponent" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>
                                        Action
                                            <button onclick="add()" style="margin-left: 4px;" type="button" class="btn btn-success btn-circle btn-sm m-r-5"><i class="ti-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- .row -->

            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel1">Product</h4> </div>
                        <div class="modal-body">
                            <form id="FormData" data-toggle="validator" data-delay="100">
                                <input type="hidden" name="product_id">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Nama</label>
                                    <input type="text" class="form-control" name="name" data-error="Hmm, Nama harap diisi" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Tipe</label>
                                    <select class="form-control" name="type" data-error="Hmm, Tipe harap diisi dan valid" required>
                                        <option value="DRINK">Drink</option>
                                        <option value="FOOD">Food</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Harga</label>
                                    <input type="number" class="form-control" name="unit_price" data-error="Hmm, harga harap diisi" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label" style="margin-right: 10px;">Active</label>
                                    <input type="checkbox" name="status" value="1" checked class="js-switch" data-color="#99d683">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button id="btnSaveFormData" type="button" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>