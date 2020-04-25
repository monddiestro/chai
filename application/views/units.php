<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">Units</h1>
        </div>
        <div class="p-1">
            <div class="search">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" id="unit_number" value="<?php echo (empty($q_number)) ? '' : $q_number ?>" class="form-control" name="unit_number" placeholder="Search Unit Number" aria-label="Unit Number" aria-describedby="basic-addon1">
                    <input type="hidden" id="q_unit" value="<?php echo (empty($q_unit)) ? '' : $q_unit ?>"/>      
                </div>
                <div id="list" class="autocomplete"></div>
            </div>
        </div>
        <div class="p-1">
            <a href="#" data-toggle="modal" data-target="#unitModal" class="btn btn-sm btn-primary btn-block shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Unit</a>
        </div>
    </div>
    <?php 
        // check flash session for notification
        $session = $this->session->flashdata('result');
        // if not empty add values from session
        if(!empty($session)) {
           $display = "show";
           $class = $session["class"];
           $message = $session["message"];
        } else {
           $display = $class = $message = "";
        }
    ?>
    <?php if(!empty($display)): ?>
    <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if(empty($units)): // if empty units don't render tables ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <div class="text-center mt-5 mb-5">
                <h4>No records found.</h4>
                <i class="fas fa-folder-open fa-4x"></i>
            </div>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped" id="units" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($units as $u): ?>
                    <tr>
                        <td><?php echo $u->number ?></td>
                        <td><?php echo $u->type ?></td>
                        <td><?php echo $u->address ?></td>
                        <td><?php echo date("F d, Y h:i A",strtotime($u->date_created)); ?></td>
                        <td class="text-right">
                        <!-- edit -->
                            <a href="#" data-toggle="modal" data-target="#unitModal<?php echo $u->unit_id ?>" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-sm fa-pencil-alt"></i>
                            </a>
                            <!-- add -->
                            <a href="#" id="newMember" data-toggle="modal" data-target="#memberModal" class="btn btn-sm btn-primary mb-2">
                                <input type="hidden" class="unit_id" value="<?php echo $u->unit_id ?>">
                                <i class="fas fa-sm fa-user-plus"></i>
                            </a>
                            <!-- view -->
                            <a href="<?php echo base_url('admin/unit_member/'.$u->unit_id) ?>" class="btn btn-sm btn-success mb-2">
                                <i class="fas fa-sm fa-clipboard-list"></i>
                            </a> 
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php endif ?>
    </div>

    <div class="d-flex flex-row-reverse">
    <?php echo !empty($pagination) ? $pagination : '' ?>
    </div>
<!-- page content close tag -->
</div>
<!-- /.container-fluid -->

<?php foreach($units as $u): ?>
<!-- Unit Modal -->
<div class="modal fade" id="unitModal<?php echo $u->unit_id ?>" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/update_unit/')) ?>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modify Unit Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo $u->unit_id ?>">
            <div class="form-group">
                <label for="number">No. #</label>
                <input type="text" value="<?php echo $u->number ?>" name="number" class="form-control" aria-describedby="numberHelp" placeholder="Enter unit number" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" value="<?php echo $u->type ?>" name="type" class="form-control"  aria-describedby="typeHelp" placeholder="Enter unit type">
            </div>
            <div class="form-group">
                <label for="address">Type</label>
                <input type="text" value="<?php echo $u->address ?>" name="address" class="form-control" aria-describedby="addressHelp" placeholder="Enter unit address" required>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
  <?php endforeach ?>

  