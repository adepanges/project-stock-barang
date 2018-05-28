

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



        <script src="<?php echo e(base_url('js/module/admin/role.js')); ?>" type="text/javascript"></script>
        <script type="text/javascript">
            user_role = {
                user_id: <?php echo e($user->user_id); ?>

            }
        </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('main-inc.default.top_navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('main-inc.default.admin_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
            <div class="row bg-title">
                <!-- .page title -->
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">User Role</h4>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 pull-right">
                    <a href="<?php echo e(site_url('user')); ?>" class="btn btn-success form-control">Kembali</a>
                </div>
                <!-- /.page title -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" role="form">
                        <div class="col-md-6 white-box">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="state-success">Username</label>
                                <div class="col-md-6">
                                    <span class="form-control"><?php echo e($user->username); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="state-success">Email</label>
                                <div class="col-md-6">
                                    <span class="form-control"><?php echo e($user->email); ?></span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 white-box">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="state-success">Nama Lengkap</label>
                                <div class="col-md-6">
                                    <span class="form-control"><?php echo e("{$user->first_name} {$user->last_name}"); ?></span>
                                </div>
                            </div>
<?php if($user->status==1): ?>
                            <div class="form-group has-success">
                                <label class="col-md-3 control-label" for="state-success">Status</label>
                                <div class="col-md-6">
                                    <span class="form-control">activated</span>
                                </div>
                            </div>
<?php else: ?>
                            <div class="form-group has-error">
                                <label class="col-md-3 control-label" for="state-success">Status</label>
                                <div class="col-md-6">
                                    <span class="form-control">deactivated</span>
                                </div>
                            </div>
<?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <table id="dataTableComponent" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role Name</th>
                                    <th>Created At</th>
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
                            <h4 class="modal-title" id="exampleModalLabel1">Role</h4>
                        </div>
                        <div class="modal-body">
                            <form id="FormData" data-toggle="validator" data-delay="100">
                                <input type="hidden" name="user_id">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Role</label>
                                    <select class="form-control" name="role_id" data-error="Hmm, role harap dipilih" required>
                                        <option value="" selected</option>
<?php $__currentLoopData = $active_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->role_id); ?>"><?php echo e($value->label); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
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