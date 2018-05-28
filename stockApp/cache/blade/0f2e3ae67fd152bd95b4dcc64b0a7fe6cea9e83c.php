

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

        <script src="<?php echo e(base_url('js/module/waitres/cart.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
            <div class="row white-box">
                Nama Pelanggan: <b><?php echo e($orders->customer_name); ?></b>
                <br>
                Total Harga:
                <h2><?php echo e(rupiah($orders->total_price)); ?></h2>
            </div>

            <div class="row">
                <button class="btn btn-warning form-control" onclick="window.location = '<?php echo e(site_url('orders')); ?>'">Kembali</button>
            </div>

            <br>

            <?php if(empty($cart)): ?>
            <div class="row white-box">
                Belum ada pesanan
            </div>
            <?php endif; ?>

            <div class="row">
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="white-box">
                        <div class="col-xs-9">
                            <b><?php echo e($value->product_name); ?></b>
                        </div>
                        <div class="col-xs-3">
                            x <?php echo e($value->qty); ?>

                        </div>
                        <br>
                        <br>
                        <div class="col-xs-12">
                            <i class="fa fa-trash pull-right" style="font-size: 20px; color: #F00; cursor: pointer;" onclick="delOrders(<?php echo e($value->cart_id); ?>)"></i>

                            <b><?php echo e(rupiah($value->price)); ?></b>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="row">
                <?php if($role_active['role_id'] == 3): ?>
                <div class="col-xs-12 col-md-6">
                    <button class="btn btn-success form-control" onclick="bayarPesanan()">Bayar</button>
                </div>
                <?php endif; ?>

                <div class="col-xs-12 col-md-6">
                    <button class="btn btn-info form-control" onclick="window.location = '<?php echo e(site_url('orders/product/index/'.$orders->order_id)); ?>'">Tambah</button>
                </div>
            </div>

            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel1">Checkout</h4> </div>
                        <div class="modal-body">
                            <form id="FormData" data-toggle="validator" data-delay="100">
                                <input type="hidden" name="order_id" value="<?php echo e($orders->order_id); ?>">
                                <input type="hidden" name="total_price" value="<?php echo e($orders->total_price); ?>">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" value="<?php echo e($orders->customer_name); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Total Harga</label>
                                    <input type="text" class="form-control" value="<?php echo e(rupiah($orders->total_price)); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Jumlah Uang</label>
                                    <input type="number" class="form-control" name="pay" id="jumlah_uang" value="0" data-error="Hmm, harap diisi jumlah uang dengan valid" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kembalian</label>
                                    <input type="number" class="form-control" min-value="0" value="0" name="refund" id="kembalian" data-error="Hmm, harap diisi jumlah uang dengan valid" readonly required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button id="btnSaveFormData" type="button" class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.waitres', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>