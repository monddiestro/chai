<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registered Pets</h1>
        <a href="#" data-toggle="modal" data-target="#newPetModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Pet</a>
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
                <?php if(empty($pets)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>House Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>House Number</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($pets as $p): ?>
                        <tr>
                            <td>
                                <img style="width:50px;height:auto;display:inline;" src="<?php echo empty($p->image) ? base_url('src/img/no-profile-image.png') : base_url($p->image) ?>" alt="">
                            </td>
                            <td>
                                <?php echo $p->type_desc ?>
                            </td>
                            <td>
                                <?php echo $p->breed ?>
                            </td>
                            <td>
                                <?php echo $p->number ?>
                            </td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#memberModal<?php echo $p->pet_id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- delete -->
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#dropMemberModal<?php echo $p->pet_id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
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

<!-- New Pet Modal -->
<div class="modal fade" id="newPetModal" tabindex="-1" role="dialog" aria-labelledby="newPetLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/new_pet/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">New Pet</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img style="width:200px; height:auto" src="<?php echo base_url('src/img/no-profile-image.png') ?>" id="imagePreview" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="pet_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Unit No</label>
                    <select name="unit_id" class="selectpicker form-control" id="" title="Ex. 2302">
                        <?php foreach($units as $u): ?>
                        <option value="<?php echo $u->unit_id ?>"><?php echo $u->number ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Pet Type</label>
                    <select name="type_id" id="" class="selectpicker form-control" title="Ex. Dog" required>
                        <?php foreach($types as $t): ?>
                        <option value="<?php echo $t->type_id ?>"><?php echo $t->type_desc ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Breed</label>
                    <input type="text" name="breed" class="form-control" placeholder="Ex. American Bully" required>
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