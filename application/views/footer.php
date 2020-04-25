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
    var search_url = "";
    if(uac_id == "administrator") {
      search_url = "<?php echo base_url('admin/members_q/') ?>";
    } else if(uac_ud == "editor") {
      search_url = "<?php echo base_url('editor/members_q/') ?>";
    } else {
      search_url = "<?php echo base_url('user/q/') ?>";
    }
    function search_user(member_id) {
      window.location.href = search_url + member_id;
    }

    // script in clearing search bar
    $('#search_member').on('keyup' ,function() {
        var q = $(this).val();
        var uac_id = "<?php echo $this->session->userdata('uac')  ?>";
        if(q=="") {
            if(uac_id == "administrator") {
              window.location.href = "<?php echo base_url('admin/members/'); ?>";
            } else if(uac_id == "editor") {
              window.location.href = "<?php echo base_url('editor/members/'); ?>";
            } else {
              window.location.href = "<?php echo base_url('user/'); ?>";
            }
        }
    });
  </script>
  <?php endif ?>
  <?php if(!empty($units_list)): ?>
  <!--  script for searching units -->
  <script>
    var units_json = <?php print_r($units_list) ?>;
    $('#unit_number').autocomplete({
      source:units_json,
      select: function(event,ui) {
        var selectedObj = ui.item;
        $('#q_unit').val(selectedObj.number);
        search_unit(selectedObj.unit_id);
      },
        autoFocus: true,
        appendTo: '#list',
        minLength: 0
      }).change(function(){
        $(this).autocomplete('search', $(this).val()
      );
    });

    var uac_id = "<?php echo $this->session->userdata('uac')  ?>";
    var search_url = "<?php echo base_url('admin/unit_q/') ?>";   
    function search_unit(unit_id) {
      window.location.href = search_url + unit_id;
    }
    // script in clearing search bar
    $('#unit_number').on('keyup' ,function() {
        var q = $(this).val();
        if(q=="") {
            window.location.href = "<?php echo base_url('admin/units/'); ?>";
        }
    });
  </script>
  <?php endif ?>
  
  <?php if(!empty($car_list)): ?>
  <!--  script for searching cars -->
  <script>
    var cars_json = <?php print_r($car_list) ?>;
    $('#q_car').autocomplete({
      source:cars_json,
      select: function(event,ui) {
        var selectedObj = ui.item;
        $('#car_id').val(selectedObj.car_id);
        search_car(selectedObj.car_id);
      },
        autoFocus: true,
        appendTo: '#list',
        minLength: 0
      }).change(function(){
        $(this).autocomplete('search', $(this).val()
      );
    });

    var uac_id = "<?php echo $this->session->userdata('uac')  ?>";
    var search_url = "<?php echo base_url('admin/car_q/') ?>";   
    function search_car(car_id) {
      window.location.href = search_url + car_id;
    }
    // script in clearing search bar
    $('#q_car').on('keyup' ,function() {
        var q = $(this).val();
        if(q=="") {
            window.location.href = "<?php echo base_url('admin/cars/'); ?>";
        }
    });
  </script>

  <?php endif ?>
</body>

</html>