  
      <!-- Bootstrap Bundle -->
      <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
      
      <!-- jQuery plugins Scripts -->
      <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
      <script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
      
      <!-- Custom Scripts -->
      <script src="<?php echo base_url('assets/js/customScript.js'); ?>"></script>
      <script>
            $(document).ready(function() {
                  window.baseUrl = "<?php echo base_url(); ?>";
                  customObj.onLoad();
            });
      </script>