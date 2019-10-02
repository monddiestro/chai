<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pet Types</h1>
        <a href="#" data-toggle="modal" data-target="#newTypeModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Type</a>
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
                <?php if(empty($types)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Type</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($types as $t): ?>
                        <tr>
                            <td><?php echo $t->type_desc ?></td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#editTypeModal<?php echo $t->type_id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- delete -->
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#dropTypeModal<?php echo $t->type_id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-trash"></i>
                                    </span>
                                    <span class="text">Remove</span>
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

<!-- New Type Modal -->
<div class="modal fade" id="newTypeModal" tabindex="-1" role="dialog" aria-labelledby="newTypeLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/new_pet_type/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">New Pet Type</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="number">Pet Type</label>
                    <input type="text" name="type_desc" class="form-control" id="number" placeholder="Ex. Dog" required>
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

<!-- Modification modal -->
<?php foreach($types as $t): ?>
<div class="modal fade" id="editTypeModal<?php echo $t->type_id ?>" tabindex="-1" role="dialog" aria-labelledby="editTypeLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/update_pet_type/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">Update Pet Type</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <input type="hidden" value="<?php echo $t->type_id ?>" name="type_id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="number">Pet Type</label>
                    <input type="text" name="type_desc" class="form-control" value="<?php echo $t->type_desc ?>" id="number" placeholder="Ex. Dog" required>
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
<div class="modal fade" id="dropTypeModal<?php echo $t->type_id ?>" tabindex="-1" role="dialog" aria-labelledby="dropTypeLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/drop_pet_type/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">Remove Pet Type</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <input type="hidden" value="<?php echo $t->type_id ?>" name="type_id">
            <div class="modal-body">
                <input type="hidden" id="type_id" value="<?php echo $t->type_id ?>" name="type_id">
                <input type="hidden" value="<?php echo $t->type_desc ?>" name="type_desc">
                Are you sure you want to remove <strong><?php echo $t->type_desc ?></strong> from pet type?
                <hr>
                <small>Pets that classified for this type will be set to empty</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Remove</button>
            </div>
      </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?php endforeach; ?>