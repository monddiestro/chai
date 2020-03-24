<!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url("src/vendor/jquery/jquery.min.js") ?>"></script>

  <script src="<?php echo base_url("src/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url("src/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url("src/js/sb-admin-2.min.js") ?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('src/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('src/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
  
  <!-- Page level custom scripts -->
  <script src="<?php echo base_url("src/js/demo/datatables-demo.js")?>"></script>
  <script src="<?php echo base_url('src/js/demo/image-preview.js') ?>"></script>
  <script src="<?php echo base_url('src/js/demo/custom-script.js') ?>"></script>

  <!-- Bootstrap select -->
  <script src="<?php echo base_url('src/js/bootstrap-select.min.js') ?>"></script>

  <!--  jquery ui -->
  <script src="<?php echo base_url('src/js/jquery-ui.min.js') ?>"></script>

  <?php if(!empty($members)): ?>
  <script>
    var members_json = <?php print_r($members) ?>;
    $('#search_member').autocomplete({
      source:members_json,
      select: function(event,ui) {
        var selectedObj = ui.item;
        $('#q_member').val(selectedObj.member_id);
        search_user(selectedObj.member_id);
      },
        autoFocus: true,
        appendTo: '#list',
        minLength: 0
      }).change(function(){
        $(this).autocomplete('search', $(this).val()
      );
    });

    var uac_id = "<?php echo $this->session->userdata('uac')  ?>";
    var search_url = "<?php echo base_url('user/q/') ?>";   
    function search_user(member_id) {
      window.location.href = search_url + member_id;
    }
  </script>
  <?php endif ?>

</body>

</html>