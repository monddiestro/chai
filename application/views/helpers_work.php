<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Helpers Type of Work</h1>
        <a href="#" data-toggle="modal" data-target="#newWorkModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Work</a>
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
                <?php if(empty($works)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($works as $w): ?>
                            <tr>
                                <td><?php echo $w->work_title ?></td>
                                <td><?php echo $w->work_desc ?></td>
                                <th>
                                    <!-- edit -->
                                    <a href="#" data-toggle="modal" data-target="#editWorkModal<?php echo $w->work_id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <!-- delete -->
                                    <!-- edit -->
                                    <a href="#" data-toggle="modal" data-target="#dropWorkModal<?php echo $w->work_id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-fw fa-trash"></i>
                                        </span>
                                        <span class="text">Remove</span>
                                    </a>
                                </th>
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

<!-- modals -->
<?php foreach($works as $w): ?>
<div class="modal fade" id="editWorkModal<?php echo $w->work_id ?>" tabindex="-1" role="dialog" aria-labelledby="editWorkrModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/update_work/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">Edit Work Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="work_id" value="<?php echo $w->work_id ?>" name="work_id">
                <div class="form-group">
                  <label for="type">Work Title</label>
                  <input type="text" class="form-control" value="<?php echo $w->work_title ?>" placeholder="Ex. Cabin Cleaner" name="title" required/>
                </div>
                <div class="form-group">
                  <label for="type">Work Description</label>
                  <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Ex. Carry linens, towels, toilet items, and cleaning supplies, using wheeled carts."><?php echo $w->work_desc ?></textarea>
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

<div class="modal fade" id="dropWorkModal<?php echo $w->work_id ?>" tabindex="-1" role="dialog" aria-labelledby="dropWokModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/drop_work/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <strong class="modal-title text-danger" id="unitModalLabel"><i class="fas fa-fw fa-exclamation-circle"></i> Warning</strong>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="work_id" value="<?php echo $w->work_id ?>" name="work_id">
                <input type="hidden" value="<?php echo $w->work_title ?>" name="title">
                Are you sure you want to remove <strong><?php echo $w->work_title ?></strong> from work list?
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Yes</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?php endforeach ?>