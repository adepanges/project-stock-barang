

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
                    <form class="form-horizontal form-material" method="POST" action="<?php echo e(site_url('auth/log/validate/web')); ?>">
                        <input type="hidden" name="auth_access_key" value="<?php echo e($auth_access_key); ?>">
                        <a href="javascript:void(0)" class="text-center db">
                            <img src="<?php echo e(base_url('images/logo/logo.png')); ?>" alt="Home" width="200px"/>
                        </a>

                        <?php if(isset($error_message) && !empty($error_message)): ?>
                            <div class="alert alert-danger"> <?php echo e($error_message); ?> </div>
                        <?php endif; ?>

                        <div class="form-group m-t-40">
                            <div class="col-xs-12">
                                <input name="username" class="form-control" type="text" required="" placeholder="Username / Email" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="password" class="form-control" type="password" required="" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>