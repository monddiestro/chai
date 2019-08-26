<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Units</h1>
        <a href="#" data-toggle="modal" data-target="#unitModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Unit</a>
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

    <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Information</h6>
            </div>
            <div class="card-body">
                <?php if(empty($units)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Number</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($units as $u): ?>
                        <tr>
                            <td><?php echo $u->number ?></td>
                            <td><?php echo $u->type ?></td>
                            <td><?php echo $u->address ?></td>
                            <td><?php echo date("F d, Y h:i A",strtotime($u->date_created)); ?></td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#unitModal<?php echo $u->id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-sm fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit Details</span>
                                </a>
                                <!-- add -->
                                <a href="#" id="newMember" data-toggle="modal" data-target="#memberModal" class="btn btn-sm btn-primary btn-icon-split mb-2">
                                    <input type="hidden" class="unit_id" value="<?php echo $u->id ?>">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-sm fa-user-plus"></i>
                                    </span>
                                    <span class="text">Add Members</span>
                                </a>
                                <!-- view -->
                                <a href="<?php echo base_url('admin/members/'.$u->id) ?>" class="btn btn-sm btn-success btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-sm fa-clipboard-list"></i>
                                    </span>
                                    <span class="text">View Members</span>
                                </a> 
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    </table>
                </div>
                <?php endif ?>
            </div>
          </div>

<!-- page content close tag -->
</div>
<!-- /.container-fluid -->

<?php foreach($units as $u): ?>
<!-- Unit Modal -->
<div class="modal fade" id="unitModal<?php echo $u->id ?>" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/update_unit/')) ?>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="unitModalLabel">Modify Unit Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo $u->id ?>">
            <div class="form-group">
                <label for="number">No. #</label>
                <input type="text" value="<?php echo $u->number ?>" name="number" class="form-control" id="number" aria-describedby="numberHelp" placeholder="Enter unit number" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" value="<?php echo $u->type ?>" name="type" class="form-control" id="type" aria-describedby="typeHelp" placeholder="Enter unit type">
            </div>
            <div class="form-group">
                <label for="address">Type</label>
                <input type="text" value="<?php echo $u->address ?>" name="address" class="form-control" id="address" aria-describedby="addressHelp" placeholder="Enter unit address" required>
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

  