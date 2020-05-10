<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex mb-3">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">Work Settings</h1>
        </div>
        <div class="p-1">
            <a href="#" data-toggle="modal" data-target="#newWorkModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Work</a>
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
        <?php if(!empty($works)): ?>
        <div class="table-responsive">
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($works as $w): ?>
                        <tr>
                            <td><?php echo $w->work_title ?></td>
                            <td><?php echo $w->work_desc ?></td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#editWorkModal<?php echo $w->work_id ?>" class="btn btn-sm btn-info mb-2">
                                    <i class="fas fa-sm fa-pencil-alt"></i>
                                </a>
                                <!-- delete -->
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#dropWorkModal<?php echo $w->work_id ?>" class="btn btn-sm btn-danger mb-2">
                                    <i class="fas fa-sm fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="text-center mt-5 mb-5">
                <h4>No records found.</h4>
                <i class="fas fa-folder-open fa-4x"></i>
            </div>
        <?php endif ?>
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