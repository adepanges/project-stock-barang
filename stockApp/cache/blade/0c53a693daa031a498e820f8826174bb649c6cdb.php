<?php if(DEBUG_PROCESS_TIME): ?>
        <script type="text/javascript">
            console.log('CodeIgniter Version <?php echo CI_VERSION ?>')
            console.log('This page took <?php echo e((microtime(true) - URANUS_LAUNCH)); ?> seconds to render')
        </script>
<?php endif; ?>
