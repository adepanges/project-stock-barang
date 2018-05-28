

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

        <script src="<?php echo e(base_url('js/module/waitres/orders.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
            <div class="row">
            <?php $__currentLoopData = $active_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $cls_active = '';
                if (!empty($value->order_id) && $value->is_active == 1 )
                {
                    $cls_active = 'table-onserve';
                }
                ?>
                <div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="white-box side-tables <?php echo e($cls_active); ?>">
                        <h1><?php echo e($value->code); ?></h1>
                        <b><?php echo e($value->name); ?></b>
                        <br>
                        <span><?php echo e($value->customer_name); ?></span>
                        <br>
                    <?php if($value->is_active != 1): ?>
                        <button class="btn btn-info" onclick="serveTable('<?php echo e(base64_encode(json_encode($value))); ?>')">Serve</button>
                    <?php else: ?>
                        <button class="btn btn-success" onclick="window.location = '<?php echo e(site_url('orders/cart/index/'.$value->order_id)); ?>'">Cart</button>
                    <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.waitres', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>