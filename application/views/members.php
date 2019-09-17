<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registered Members</h1>
        <a href="#" data-toggle="modal" data-target="#newMemberModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Member</a>
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
                <?php if(empty($members)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Unit #</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Unit #</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Mobile</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($members as $m): ?>
                        <tr>
                            <td><?php echo $m->number ?></td>
                            <td>
                                <img style="width:50px;height:auto;display:inline;" src="<?php echo base_url($m->image) ?>" alt="member_pic">
                                <span><?php echo $m->f_name . " " . $m->l_name ?></span>
                            </td>
                            <td><?php echo $m->address ?></td>
                            <td><?php echo $m->email ?></td>
                            <td><?php echo $m->phone ?></td>
                            <td><?php echo $m->mobile ?></td>
                            <td><?php echo $m->type == 1 ? 'Owner' : 'Member' ?></td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#memberModal<?php echo $m->member_id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- delete -->
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#dropMemberModal<?php echo $m->member_id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
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

<!-- Members Modal -->
<?php foreach($members as $m): ?>
<div class="modal fade" id="memberModal<?php echo $m->member_id ?>" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/update_member/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">Edit Member Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="member_id" value="<?php echo $m->member_id ?>" name="member_id">
                <div class="form-group">
                    <img style="width:200px; height:auto" src="<?php echo base_url($m->image) ?>" id="imagePreview" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="user_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="type">Member Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="1" <?php echo ($m->type == 1) ? 'selected' : '' ?>>Owner</option>
                        <option value="2" <?php echo ($m->type == 2) ? 'selected' : '' ?>>Member</option>
                        <option value="3" <?php echo ($m->type == 3) ? 'selected' : '' ?>>Helper</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unit_id">Unit Number</label>
                    <select name="unit_id" id="unit_id" class="form-control">
                        <?php foreach($units as $u): ?>
                        <option value="<?php echo $u->unit_id ?>" <?php echo $u->unit_id == $m->unit_id ? 'selected' : '' ?>><?php echo $u->number ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="l_name">Last Name</label>
                    <input type="text" value="<?php echo $m->l_name ?>" name="l_name" class="form-control" id="l_name" placeholder="Ex. Dela Cruz" required>
                </div>
                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" value="<?php echo $m->f_name ?>" name="f_name" class="form-control" id="f_name" placeholder="Ex. Juan" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" value="<?php echo $m->email ?>" name="email" class="form-control" id="email" placeholder="Ex. juandelacruz@email.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone #</label>
                    <input type="number" value="<?php echo $m->phone ?>" name="phone" class="form-control" id="phone" placeholder="Ex. 021234567">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile #</label>
                    <input type="number" value="<?php echo $m->mobile ?>" name="mobile" class="form-control" id="mobile" placeholder="Ex. 091234567890">
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

<div class="modal fade" id="dropMemberModal<?php echo $m->member_id ?>" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/drop_member/')) ?>
    <div class="modal-dialog role="document">
        <div class="modal-content">
            <div class="modal-header">
            <strong class="modal-title text-danger" id="unitModalLabel"><i class="fas fa-fw fa-exclamation-circle"></i> Warning</strong>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="member_id" value="<?php echo $m->member_id ?>" name="member_id">
                <input type="hidden" value="<?php echo $m->f_name . " " . $m->l_name ?>" name="member_name">
                Are you sure you want to remove <strong><?php echo $m->f_name . " " . $m->l_name ?></strong> from member list?
                <hr>
                <small>This will remove all data of the member</small>
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

<!-- New Member Modal -->
<div class="modal fade" id="newMemberModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/new_member/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">New Member Information</h5>
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
                        <input type="file" name="user_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="type">Member Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="1">Owner</option>
                        <option value="2">Member</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unit_id">Unit Number</label>
                    <select name="unit_id" id="unit_id" class="form-control">
                        <?php foreach($units as $u): ?>
                        <option value="<?php echo $u->unit_id ?>"><?php echo $u->number ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="l_name">Last Name</label>
                    <input type="text" name="l_name" class="form-control" id="l_name" placeholder="Ex. Dela Cruz" required>
                </div>
                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" name="f_name" class="form-control" id="f_name" placeholder="Ex. Juan" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Ex. juandelacruz@email.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone #</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Ex. 021234567">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile #</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Ex. 091234567890">
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