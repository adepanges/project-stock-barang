<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="adepanges">
        <meta name="description" content="">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(base_url('image/logo/dermeva_logo_205x41.png')); ?>">
        <title><?php echo $__env->yieldContent('title'); ?></title>

<?php $__env->startSection('load_css'); ?>
        <link href="<?php echo e(base_url('bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <!-- This is Sidebar menu CSS -->
        <link href="<?php echo e(base_url('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')); ?>" rel="stylesheet">
        <!-- animation CSS -->
        <link href="<?php echo e(base_url('css/animate.css')); ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo e(base_url('css/style.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(base_url('css/custom.css')); ?>" rel="stylesheet">
        <!-- color CSS -->
        <link href="<?php echo e(base_url('css/colors/megna-dark.css')); ?>" id="theme" rel="stylesheet">
<?php echo $__env->yieldSection(); ?>
        <script type="text/javascript">
            document.app = {
                base_url: '<?php echo e(base_url()); ?>',
                site_url: '<?php echo e(site_url()); ?>',
                role_active: <?php echo json_encode($role_active); ?>

            }
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="fix-header">
        <!-- Preloader -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>

        <div class="wrapper">

<?php echo $__env->yieldContent('header'); ?>


            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
<?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- /.container-fluid -->
                <footer class="footer text-center"> <?php echo e(date('Y')); ?> &copy; Dermeva </footer>
            </div>
            <!-- /#page-wrapper -->
        </div>
<?php $__env->startSection('load_js'); ?>
        <script src="<?php echo e(base_url('plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo e(base_url('bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="<?php echo e(base_url('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
        <!--slimscroll JavaScript -->
        <script src="<?php echo e(base_url('js/jquery.slimscroll.js')); ?>"></script>

        <script src="<?php echo e(base_url('js/waves.js')); ?>"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo e(base_url('js/custom.js')); ?>"></script>
        <!--Style Switcher -->
        <script src="<?php echo e(base_url('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')); ?>"></script>

        <script type="text/javascript" src="<?php echo e(base_url('js/helper.js')); ?>"></script>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('render_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>
